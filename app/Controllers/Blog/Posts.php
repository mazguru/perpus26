<?php

namespace App\Controllers\Blog;

use App\Controllers\AdminController;
use App\Models\PostCategoriesModel;
use App\Models\PostsModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Posts extends AdminController
{
    protected $m_posts;
    protected $m_categories;
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->m_posts = new PostsModel();
        $this->m_categories = new PostCategoriesModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'posts';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $breadcrumbs = [
            ['title' => 'Beranda', 'url' => base_url()],
            ['title' => 'Kelola Postingan']
        ];
        $data = [
            'title' => 'Kelola Postingan',
            'content' => 'admin/posts/index',
            'breadcrumbs' => $breadcrumbs

        ];
        return view('layouts/master_admin', $data);
    }

    public function getCreate($id = null): string
    {
        $breadcrumbs = [
            ['title' => 'Beranda', 'url' => base_url()],
            ['title' => 'Kelola Postingan', 'url' => base_url('blog/posts')],
            ['title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan']
        ];
        $data = [
            'title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan',
            'type' => 'create',
            'content' => 'admin/posts/create',
            'breadcrumbs' => $breadcrumbs
        ];
        return view('layouts/master_admin', $data);
    }
    public function getEdit($id = null): string
    {
        $breadcrumbs = [
            ['title' => 'Beranda', 'url' => base_url()],
            ['title' => 'Kelola Postingan', 'url' => base_url('blog/posts')],
            ['title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan']
        ];
        $data = [
            'title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan',
            'post_id' => $id,
            'content' => 'admin/posts/create',
            'breadcrumbs' => $breadcrumbs
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $posts = $this->m_posts->withDeleted()->getAllPosts();
        $results = [];

        foreach ($posts as $post) {
            $results[] = [
                'id' => $post['id'],
                'title' => $post['post_title'],
                'author' => $post['post_author'],
                'status' => $post['post_status'],
                'created_at' => $post['created_at'],
                'is_deleted' => $post['is_deleted'],
            ];
        }

        $data = [
            'alldata' => $results
        ];

        return $this->response->setJSON($data);
    }
    public function getCategories()
    {
        $categories = $this->m_categories->getCategories('post');
        $data = [
            'categories' => $categories,
        ];
        return $this->response->setJSON($data);
    }


    public function getPostid($id)
    {
        $posts =  $this->m_posts
            ->where('id', $id)
            ->first();

        return $this->response->setJSON($posts);
    }
    public function postStore()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }

        $postId = $this->request->getPost('id');
        $isEdit = $postId ? true : false;

        // Ambil slug dari input dan buat versi URL-friendly
        $slugInput = $this->request->getPost('post_slug');
        $slug = url_title($slugInput, '-', true);

        $postImage = $this->request->getFile('post_image');

        // Validasi input
        $validationRules = [
            'post_title' => 'required|max_length[120]',
            'post_slug' => 'required|alpha_dash',
            'post_content' => 'required',
            'post_status' => 'required|in_list[draft,publish]',
            'post_categories' => 'required',
        ];

        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $validationRules['post_image'] = [
                'uploaded[post_image]',
                'is_image[post_image]',
                'max_size[post_image,2048]',
                'mime_in[post_image,image/jpg,image/jpeg,image/png]'
            ];
        }

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Ambil data
        $data = [
            'post_title' => $this->request->getPost('post_title'),
            'post_slug' => $slug,
            'post_content' => $this->request->getPost('post_content'),
            'post_categories' => $this->request->getPost('post_categories'),
            'post_status' => $this->request->getPost('post_status'),
            'post_visibility' => $this->request->getPost('post_visibility'),
            'post_comment_status' => $this->request->getPost('post_comment_status'),
            'post_type' => 'post',
            'post_author' => session('user_id'),
        ];

        // Upload dan resize image
        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $newName = $slug . '.' . $postImage->getExtension();
            $data['post_image'] = $newName;

            $originalPath = FCPATH . 'media_library/posts/original/';
            $thumbPath = FCPATH . 'media_library/posts/thumbs/';
            $headerPath = FCPATH . 'media_library/posts/headers/';

            helper('filesystem');
            foreach ([$originalPath, $thumbPath, $headerPath] as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
            }

            $postImage->move($originalPath, $newName, true);

            // Resize thumbnail
            \Config\Services::image()
                ->withFile($originalPath . $newName)
                ->resize(session('post_image_thumbnail_width'), session('post_image_thumbnail_height'), false)
                ->save($thumbPath . $newName);

            // Resize header
            \Config\Services::image()
                ->withFile($originalPath . $newName)
                ->resize(1200, 400, true)
                ->save($headerPath . $newName);
        }

        // Cek slug jika duplikat (kecuali sedang edit dirinya sendiri)

        if (!$isEdit) {
            $cekin = $this->m_posts->getIdBySlug($slug);
            if ($cekin) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Slug sudah digunakan oleh post lain.'
                ]);
            }
        }

        if ($isEdit) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = session('user_id');
            $success = $this->m_posts->update($postId, $data);
            $action = 'diperbarui';
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = session('user_id');
            $success = $this->m_posts->insert($data);
            $action = 'ditambahkan';
        }
        $cekin = $this->m_posts->getIdBySlug($slug);
        return $this->response->setJSON([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? "Post berhasil $action." : "Post gagal $action.",
            'id' => $cekin['id'],
            'image' => $data['post_image'] ?? null
        ]);
    }


    public function postUploadimageeditor()
    {
        helper(['filesystem', 'url']);

        $this->response->setContentType('application/json');

        $file = $this->request->getFile('file');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $file ? $file->getErrorString() : 'No file uploaded.'
            ]);
        }

        // Validasi tipe & ukuran
        $validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file->getMimeType(), $validTypes)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Tipe file tidak diizinkan. Hanya jpg, jpeg, png.'
            ]);
        }

        $uploadPath = FCPATH . 'media_library/posts/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true); // Buat folder jika belum ada
        }

        // Simpan file
        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        return $this->response->setJSON([
            'status' => 'success',
            'location' => base_url('media_library/posts/' . $newName),
        ]);
    }
}
