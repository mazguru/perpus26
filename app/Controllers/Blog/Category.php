<?php

namespace App\Controllers\Blog;

use App\Controllers\AdminController;
use App\Models\PostCategoriesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Category extends AdminController
{
    protected $m_category;
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->m_category = new PostCategoriesModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'categories';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'Kategori',
            'media' => true,
            'categorys' => true,
            'content' => 'admin/categories/index',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'data' => $this->m_category
                ->where('is_deleted', 'false')
                ->findAll(),
            'alldata' => $this->m_category
                ->withDeleted()
                ->orderBy('category_type', 'ASC')
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
            'category_name' => 'required|min_length[3]',
            'category_description' => 'permit_empty|string'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $slug = url_title($this->request->getPost('category_name'), '-', true);

        $this->m_category->insert([
            'category_name'       => $this->request->getPost('category_name'),
            'category_description' => $this->request->getPost('category_description'),
            'category_type' => $this->request->getPost('category_type'),
            'category_slug'        => $slug,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => session('user_id'),
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'category berhasil ditambahkan.'
        ]);
    }

    public function postUpdate($id)
    {
        helper(['form', 'text']);
        $category = $this->m_category->find($id);
        if (!$category) {
            return $this->failNotFound('category tidak ditemukan');
        }

        $data = [
            'category_name'       => $this->request->getPost('category_name'),
            'category_description' => $this->request->getPost('category_description'),
            'category_type' => $this->request->getPost('category_type'),
            'category_slug'        => url_title($this->request->getPost('category_name'), '-', true),
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => session('user_id'),
        ];

        $this->m_category->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'category berhasil diperbarui.'
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
