<?php

namespace App\Controllers\Blog;

use App\Controllers\AdminController;
use App\Models\PostCategoriesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Category extends AdminController
{
    protected $m_category;

    public function __construct()
    {
        $this->m_category = new PostCategoriesModel();
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'category Media',
            'media' => true,
            'categorys' => true,
            'content' => 'admin/posts/category',
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
            ->orderBy('category_type','ASC')
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

    public function edit($id)
    {
        $category = $this->m_category->find($id);
        if (!$category) {
            return $this->failNotFound('category tidak ditemukan');
        }

        return $this->response->setJSON($category);
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

        $cover = $this->request->getFile('image_cover');
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $newName = $cover->getRandomName();
            $cover->move(FCPATH . 'upload/image', $newName);
            $data['image_cover'] = $newName;

            // Hapus cover lama jika ada
            if ($category['image_cover'] && file_exists(FCPATH . 'upload/image/' . $category['image_cover'])) {
                unlink(FCPATH . 'upload/image/' . $category['image_cover']);
            }
        }

        $this->m_category->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'category berhasil diperbarui.'
        ]);
    }

    public function postDelete()
    {

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }
        $json = $this->request->getJSON();
        $id = $json->id ?? null;



        if (!$id) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'ID tidak ditemukan dalam permintaan.'
            ]);
        }

        $this->m_category->update($id, [
            'is_deleted' => 'true',
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => session('user_id')
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'category berhasil dihapus.'
        ]);
    }
    public function postDeletepermanent()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }

        $json = $this->request->getJSON();
        $ids = $json->id ?? [];

        if (!is_array($ids) || empty($ids)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Data ID tidak valid.'
            ]);
        }

        foreach ($ids as $id) {
            $category = $this->m_category->find($id);
            if (!$category) continue;

            // Hapus file cover category
            if (!empty($category['image_cover'])) {
                $coverPath = FCPATH . 'upload/image/' . $category['image_cover'];
                if (file_exists($coverPath)) {
                    unlink($coverPath);
                }
            }

            // Ambil dan hapus semua foto dari category
            $photos = $this->photoModel->where('photo_category_id', $id)->findAll();
            foreach ($photos as $photo) {
                if (!empty($photo['photo_name'])) {
                    $photoPath = FCPATH . 'uploads/photos/' . $photo['photo_name'];
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }

                $this->photoModel->delete($photo['id']);
            }

            // Hapus category
            $this->m_category->delete($id);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Semua category dan foto berhasil dihapus.'
        ]);
    }


    public function postRestore()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan bukan AJAX.'
            ]);
        }
        $json = $this->request->getJSON();
        $id = $json->id ?? null;


        if (!$id) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'ID tidak ditemukan dalam permintaan.'
            ]);
        }
        $this->m_category->update($id, [
            'is_deleted' => 'false',
            'restored_at' => date('Y-m-d H:i:s'),
            'restored_by' => session('user_id')
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'category berhasil dipulihkan.'
        ]);
    }

    public function postUploadImage($id)
    {
        $category = $this->m_category->find($id);
        if (!$category) {
            return $this->failNotFound('category tidak ditemukan');
        }

        $files = $this->request->getFiles();
        if (!$files || !isset($files['photos'])) {
            return $this->failValidationErrors(['photos' => 'Foto tidak ditemukan']);
        }

        $photos = $files['photos'];
        foreach ($photos as $photo) {
            if ($photo->isValid() && !$photo->hasMoved()) {
                $filename = $photo->getRandomName();
                $photo->move('upload/image/', $filename);

                $this->photoModel->insert([
                    'photo_category_id' => $id,
                    'photo_name'     => $filename,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'created_by'     => session('user_id'),
                    'is_deleted'     => 'false'
                ]);
            }
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Foto berhasil diunggah.'
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
