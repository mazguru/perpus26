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

    public function __construct()
    {
        $this->m_posts = new PostsModel();
        $this->m_categories = new PostCategoriesModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Tulisan',
        ];
        return view('admin/posts/index', $data);
    }

    public function getposts()
    {
        $posts = $this->m_posts->getAllPosts();
        $results = [];

        foreach ($posts as $post) {
            $results[] = [
                'id' => $post['id'],
                'title' => $post['post_title'],
                'author' => $post['post_author'],
                'status' => $post['post_status'],
                'created_at' => $post['created_at'],
            ];
        }

        return $this->response->setJSON($results);
    }
    public function getcategories()
    {
        $categories = $this->m_categories->getCategories('post');
        $data = [
            'categories' => $categories,
        ];
        return $this->response->setJSON($data);
    }


    public function create($id = null): string
    {
        $data = [
            'title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan',
        ];
        return view('admin/posts/create', $data);
    }
    public function edit($id = null): string
    {
        $data = [
            'title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan',
            'post_id' => $id
        ];
        return view('admin/posts/create', $data);
    }

    public function getPostById($id){
        $posts = $this->m_posts->getPostsId($id);

        return $this->response->setJSON($posts);
    }
    public function store()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }

        // Validasi input wajib
        $validationRules = [
            'post_title' => 'required',
            'post_slug' => 'required|alpha_dash',
            'post_content' => 'required',
            'post_status' => 'required|in_list[draft,publish]',
            'post_categories' => 'required',
        ];

        $postId = $this->request->getPost('id'); // Jika ada berarti update
        $postImage = $this->request->getFile('post_image');
        $slug = url_title($this->request->getPost('post_slug'), '-', true);
        $isEdit = $postId ? true : false;

        // Tambah aturan validasi file jika ada yang diunggah
        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $validationRules['post_image'] = [
                'uploaded[post_image]',
                'is_image[post_image]',
                'max_size[post_image,2048]',
                'mime_in[post_image,image/jpg,image/jpeg,image/png]',
            ];
        }

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        // Data dari input
        $data = [
            'post_title' => $this->request->getPost('post_title'),
            'post_slug' => $this->request->getPost('post_slug'),
            'post_content' => $this->request->getPost('post_content'),
            'post_categories' => $this->request->getPost('post_categories'),
            'post_status' => $this->request->getPost('post_status'),
            'post_type' => 'post',
            'post_author' => session('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
        ];


        // Proses upload gambar jika ada
        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $slug = url_title($this->request->getPost('post_slug'), '-', true);
            $extension = $postImage->getExtension(); // jpg, png, etc
            $newName = $slug . '.' . $extension;
            $data['post_image'] = $newName;

            // Folder
            $originalPath = FCPATH . 'media_library/posts/original/';
            $thumbPath    = FCPATH . 'media_library/posts/thumbs/';
            $headerPath   = FCPATH . 'media_library/posts/headers/';

            helper('filesystem');
            foreach ([$originalPath, $thumbPath, $headerPath] as $dir) {
                if (!is_dir($dir)) {
                    if (!mkdir($dir, 0755, true)) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Gagal membuat folder: $dir"
                        ]);
                    }
                }
            }

            // Simpan original
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

            $data['post_image'] = $newName;
        }
        // Cek apakah slug sudah ada dan bukan milik post yang sedang diedit
        $post = $this->m_posts->getIdBySlug($slug);

        if ($post) {
            // UPDATE
            $postId = $post['id'];
            $data['updated_at'] = date('Y-m-d H:i:s');
            $post_create = $this->m_posts->update($postId, $data);
            $action = 'diperbarui';
        } else {
            // INSERT
            $data['created_at'] = date('Y-m-d H:i:s');
            $post_create = $this->m_posts->insert($data);
            $action = 'ditambahkan';
        }

        if ($post_create) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Post berhasil ' . $action,
                'image' => $data['post_image'] ?? null
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Post gagal ' . $action
            ]);
        }
    }

    public function imagesUploadHandler()
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
