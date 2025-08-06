<?php

namespace App\Controllers\Blog;

use App\Controllers\AdminController;
use App\Models\BannerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Banner extends AdminController
{
    protected $bannerModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->bannerModel = new BannerModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'banners';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'Banner Slider',
            'content' => 'admin/tampilan/banner',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'data' => $this->bannerModel
                ->where('is_deleted', 'false')
                ->findAll(),
            'alldata' => $this->bannerModel
                ->findAll()
        ];

        return $this->response->setJSON($data);
    }

    public function postCreate()
    {
        helper(['form', 'text']);
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }
        $validation = \Config\Services::validation();

        $rules = [
            'title' => 'required|min_length[3]',
            'caption' => 'permit_empty|string',
            'image_cover' => 'uploaded[image_cover]|is_image[image_cover]|max_size[image_cover,2048]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $cover = $this->request->getFile('image_cover');
        $filename = $cover->getRandomName();
        $cover->move('media_library/images/', $filename);

        $slug = url_title($this->request->getPost('title'), '-', true);

        $this->bannerModel->insert([
            'title'       => $this->request->getPost('title'),
            'caption' => $this->request->getPost('caption'),
            'link' => $this->request->getPost('link'),
            'image_cover'       => $filename,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => session('user_id'),
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'banner berhasil ditambahkan.'
        ]);
    }


    public function postUpdate($id)
    {
        helper(['form', 'text']);
        $banner = $this->bannerModel->find($id);
        if (!$banner) {
            return $this->failNotFound('banner tidak ditemukan');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'caption' => $this->request->getPost('caption'),
            'link' => $this->request->getPost('link'),
            'updated_by' => session('user_id')
        ];

        $cover = $this->request->getFile('image_cover');
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $newName = $cover->getRandomName();
            $cover->move(FCPATH . 'media_library/images', $newName);
            $data['image_cover'] = $newName;

            // Hapus cover lama jika ada
            if ($banner['image_cover'] && file_exists(FCPATH . 'media_library/images/' . $banner['image_cover'])) {
                unlink(FCPATH . 'media_library/images/' . $banner['image_cover']);
            }
        }

        $this->bannerModel->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'banner berhasil diperbarui.'
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
