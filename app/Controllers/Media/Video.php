<?php

namespace App\Controllers\Media;

use App\Controllers\AdminController;
use App\Models\PostsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Video extends AdminController
{
    protected $m_videos;
    protected $photoModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->m_videos = new PostsModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'posts';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'Galeri Video',
            'content' => 'admin/media/video',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        // Ambil data video yang belum dihapus (untuk ditampilkan)
        $activeVideos = $this->m_videos
            ->where('is_deleted', 'false')
            ->where('post_type', 'video')
            ->findAll();

        // Ambil semua data termasuk yang dihapus (untuk keperluan statistik/admin)
        $allVideos = $this->m_videos
            ->withDeleted()
            ->where('post_type', 'video')
            ->findAll();

        return $this->response->setJSON([
            'data'    => $activeVideos,
            'alldata' => $allVideos
        ]);
    }


    public function postCreate()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }

        // Ambil slug dari input dan buat versi URL-friendly
        $slugInput = $this->request->getPost('post_title');
        $slug = url_title($slugInput, '-', true);

        // Validasi input
        $validationRules = [
            'post_title' => 'required|max_length[120]',
            'post_content' => 'required'
        ];

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
            'post_categories' => 'video',
            'post_status' => $this->request->getPost('post_status'),
            'post_visibility' => $this->request->getPost('post_visibility'),
            'post_comment_status' => $this->request->getPost('post_comment_status'),
            'post_type' => 'video',
            'post_author' => session('user_id'),
            'created_by' => session('user_id'),
        ];

        // Cek slug jika duplikat (kecuali sedang edit dirinya sendiri)

        $cekin = $this->m_videos->getIdBySlug($slug);
        if ($cekin) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Slug sudah digunakan oleh post lain.'
            ]);
        }

        $success = $this->m_videos->insert($data);
        $action = 'ditambahkan';
        return $this->response->setJSON([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? "Post berhasil $action." : "Post gagal $action.",
        ]);
    }

    public function postUpdate($id)
    {
        helper(['form', 'text']);
        $album = $this->m_videos->find($id);
        if (!$album) {
            return $this->failNotFound('Album tidak ditemukan');
        }

        $data = [
            'post_title' => $this->request->getPost('post_title'),
            'post_content' => $this->request->getPost('post_content'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => session('user_id'),
        ];

        $this->m_videos->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil diperbarui.'
        ]);
    }
    // Helper
    private function failValidationErrors($errors)
    {
        return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
            ->setJSON([
                'status' => 'error',
                'message' => $errors
            ]);
    }
    private function failNotFound()
    {
        return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON([
            'status' => 'error',
            'message' => 'Data tidak ditemukan.'
        ]);
    }
}
