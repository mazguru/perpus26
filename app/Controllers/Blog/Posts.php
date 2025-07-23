<?php

namespace App\Controllers\Blog;

use App\Controllers\AdminController;
use App\Models\PostCategoriesModel;
use App\Models\PostsModel;
use CodeIgniter\HTTP\ResponseInterface;

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
                'id' => $post->id,
                'title' => $post->post_title,
                'author' => $post->post_author,
                'status' => $post->post_status,
                'created_at' => $post->created_at
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
        helper('form');
        $query = null;
        $postImage = '';

        if ($id && is_numeric($id)) {
            $query = $this->m_posts->find($id);
            if ($query && file_exists(FCPATH . 'media_library/posts/medium/' . $query['post_image'])) {
                $postImage = base_url('media_library/posts/medium/' . $query['post_image']);
            }
        }

        $data = [
            'query' => $query,
            'post_image' => $postImage,
            'option_categories' => $this->m_categories->getCategories('post'),
            'title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan',
            'blog' => true,
            'posts' => true,
            'post_create' => true,
            'action' => site_url('blog/posts/save/' . ($id ?? '')),
            'content' => 'blog/posts_create',
        ];

        return view('admin/posts/create', $data);
    }

    public function save($id = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response
                ->setStatusCode(403)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Forbidden: Invalid request'
                ]);
        }

        $id = (int) $id;
        $response = ['status' => 'error', 'message' => ''];

        // Validasi input
        $validationRules = [
            'post_title' => 'required|min_length[3]',
            'post_content' => 'required',
            'post_author' => 'permit_empty',
            'post_tags' => 'permit_empty',
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->listErrors()
            ]);
        }

        $dataset = [
            'post_title' => $this->request->getPost('post_title'),
            'post_content' => $this->request->getPost('post_content'),
            'post_author' => $this->request->getPost('post_author'),
            'post_tags' => $this->request->getPost('post_tags'),
        ];

        // Upload gambar jika ada
        $errorMessage = '';
        $file = $this->request->getFile('post_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $upload = $this->uploadImage($id);
            if ($upload['status'] === 'success') {
                $dataset['post_image'] = $upload['file_name'];
            } else {
                $errorMessage = $upload['message'];
            }
        }

        if (!empty($errorMessage)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $errorMessage
            ]);
        }

        // Tambahkan info user
        $userID = session('user_id');
        if (!$id) {
            $dataset['created_by'] = $userID;
            $dataset['created_at'] = date('Y-m-d H:i:s');
        } else {
            $dataset['updated_by'] = $userID;
            unset($dataset['post_author']); // jangan ubah penulis saat update
        }

        // Simpan data
        $model = new PostsModel();
        $success = $id ? $model->update($id, $dataset) : $model->insert($dataset);
        $action = $id ? 'update' : 'insert';

        if (!$success) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam menyimpan data.'
            ]);
        }


        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil disimpan.',
            'action' => $action
        ]);
    }


    public function imagesUploadHandler()
    {
        $this->response->setContentType('application/json');

        $file = $this->request->getFile('file');
        if (! $file->isValid()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $file->getErrorString()
            ]);
        }

        $fileName = $file->getRandomName();
        $uploadPath = FCPATH . 'media_library/posts/';
        $file->move($uploadPath, $fileName);

        return $this->response->setJSON([
            'status' => 'success',
            'location' => base_url('media_library/posts/' . $fileName)
        ]);
    }

    private function uploadImage(int $id = 0): array
    {
        $response = ['status' => 'error', 'message' => ''];

        $file = $this->request->getFile('post_image');

        if (!$file || !$file->isValid()) {
            $response['message'] = $file->getErrorString();
            return $response;
        }

        $newName = $file->getRandomName();
        $uploadPath = FCPATH . 'media_library/images/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if (!$file->move($uploadPath, $newName)) {
            $response['message'] = 'Gagal memindahkan file.';
            return $response;
        }

        // Set permission file
        chmod($uploadPath . $newName, 0777);

        // Resize ke thumbnail, medium, large
        $this->resizeImage($uploadPath, $newName);

        // Set hasil upload
        $response['status'] = 'success';
        $response['file_name'] = $newName;

        // Jika ID diberikan, hapus gambar lama
        if ($id > 0) {
            $model = new PostsModel(); // Ganti sesuai model kamu
            $post = $model->find($id);
            if ($post && !empty($post['post_image'])) {
                $oldName = $post['post_image'];
                foreach (['thumbnail', 'medium', 'large'] as $size) {
                    $oldFile = FCPATH . "media_library/posts/{$size}/{$oldName}";
                    if (file_exists($oldFile)) {
                        chmod($oldFile, 0777);
                        unlink($oldFile);
                    }
                }
            }
        }

        return $response;
    }


    private function resizeImage($filePath, $fileName)
    {
        $image = \Config\Services::image();
        $targetSizes = [
            'thumbnail' => [__session('post_image_thumbnail_width'), __session('post_image_thumbnail_height')],
            'medium'    => [__session('post_image_medium_width'), __session('post_image_medium_height')],
            'large'     => [__session('post_image_large_width'), __session('post_image_large_height')],
        ];

        foreach ($targetSizes as $folder => [$width, $height]) {
            $image->withFile($filePath . $fileName)
                ->resize($width, $height, false)
                ->save(FCPATH . "media_library/posts/{$folder}/" . $fileName);
        }

        // Optional: delete original
        unlink($filePath . $fileName);
    }
}
