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
        $data = [
            'title' => $id ? 'Edit Tulisan' : 'Tambah Tulisan',
        ];
        return view('admin/posts/create', $data);
    }
    public function store()
    {
        $data = [
            'post_title' => $this->request->getPost('post_title'),
            'post_slug' => $this->request->getPost('post_slug'),
            'post_content' => $this->request->getPost('post_content'),
            'post_categories' => $this->request->getPost('post_categories'),
            'post_status' => $this->request->getPost('post_status'),
            'post_type' => 'post',
            'created_at' => date('Y-m-d H:i:s'),
            'post_image' => null,
        ];
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Request bukan AJAX.']);
        }

        $data = $this->request->getJSON(true);

        // Cek apakah ada gambar yang diupload
        $postImage = $this->request->getFile('post_image');
        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $newName = $postImage->getRandomName();

            // Path direktori penyimpanan
            $originalPath = WRITEPATH . 'media_library/posts/original/';
            $thumbPath    = WRITEPATH . 'media_library/posts/thumbs/';
            $headerPath   = WRITEPATH . 'media_library/posts/headers/';

            // Pastikan folder ada
            if (!is_dir($originalPath)) mkdir($originalPath, 0777, true);
            if (!is_dir($thumbPath)) mkdir($thumbPath, 0777, true);
            if (!is_dir($headerPath)) mkdir($headerPath, 0777, true);

            // Pindahkan ke folder original
            $postImage->move($originalPath, $newName);

            // Simpan nama file ke database
            $data['post_image'] = $newName;

            // Resize Thumbnail (300x200)
            \Config\Services::image()
                ->withFile($originalPath . $newName)
                ->resize(300, 200, true)
                ->save($thumbPath . $newName);

            // Resize Header (1200x400)
            \Config\Services::image()
                ->withFile($originalPath . $newName)
                ->resize(1200, 400, true)
                ->save($headerPath . $newName);
        }

        if ($this->m_posts->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Post berhasil disimpan.',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan post.',
            ]);
        }
    }
}
