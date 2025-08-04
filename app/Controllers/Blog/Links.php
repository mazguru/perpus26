<?php

namespace App\Controllers\Blog;

use App\Controllers\AdminController;
use App\Models\LinkModel;
use App\Models\PostsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Links extends AdminController
{
    protected $m_link;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->m_link = new LinkModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'links';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'Tautan Terkait',
            'content' => 'admin/blog/link',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'data' => $this->m_link
                ->where('is_deleted', 'true')
                ->findAll(),
            'alldata' => $this->m_link
                ->findAll()
        ];

        return $this->response->setJSON($data);
    }

    public function postCreate()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }
        $postImage = $this->request->getFile('image_cover');

        // Validasi input
        $validationRules = [
            'link_title' => 'required|max_length[120]',
            'link_url' => 'required',
            'link_target' => 'required'
        ];

        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $validationRules['image_cover'] = [
                'uploaded[image_cover]',
                'is_image[image_cover]',
                'max_size[image_cover,2048]',
                'mime_in[image_cover,image/jpg,image/jpeg,image/png]'
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
            'link_title' => $this->request->getPost('link_title'),
            'link_url' => $this->request->getPost('link_url'),
            'link_target' => $this->request->getPost('link_target'),
            'link_type' => $this->request->getPost('link_type'),
            'created_by' => session('user_id'),
        ];

        // Upload dan resize image
        if ($postImage && $postImage->isValid() && !$postImage->hasMoved()) {
            $newName = $postImage->getRandomName();
            $data['image_cover'] = $newName;

            $originalPath = FCPATH . 'media_library/images/';

            helper('filesystem');
            if (!is_dir($originalPath)) {
                mkdir($originalPath, 0755, true);
            }

            $postImage->move($originalPath, $newName, true);
        }

        // Cek slug jika duplikat (kecuali sedang edit dirinya sendiri)

        $success = $this->m_link->insert($data);
        $action = 'ditambahkan';
        return $this->response->setJSON([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? "Post berhasil $action." : "Post gagal $action.",
        ]);
    }

    public function postUpdate($id)
    {
        helper(['form', 'text']);
        $link = $this->m_link->find($id);
        if (!$link) {
            return $this->failNotFound('link tidak ditemukan');
        }

        $data = [
            'link_title' => $this->request->getPost('link_title'),
            'link_url' => $this->request->getPost('link_url'),
            'link_target' => $this->request->getPost('link_target'),
            'link_type' => $this->request->getPost('link_type'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => session('user_id'),
        ];

        $cover = $this->request->getFile('image_cover');
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $newName = $cover->getRandomName();
            $cover->move(FCPATH . 'upload/image', $newName);
            $data['image_cover'] = $newName;

            // Hapus cover lama jika ada
            if ($link['image_cover'] && file_exists(FCPATH . 'media_library/images/' . $link['image_cover'])) {
                unlink(FCPATH . 'upload/image/' . $link['image_cover']);
            }
        }

        $this->m_link->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'link berhasil diperbarui.'
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
