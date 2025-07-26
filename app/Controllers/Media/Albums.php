<?php

namespace App\Controllers\Media;

use App\Controllers\AdminController;
use App\Models\AlbumModel;
use App\Models\PhotoModel;
use CodeIgniter\HTTP\ResponseInterface;

class Albums extends AdminController
{
    protected $albumModel;
    protected $photoModel;

    public function __construct()
    {
        $this->albumModel = new AlbumModel();
        $this->photoModel = new PhotoModel();
    }

    public function getIndex(): string
    {
        $data = [
            'title' => 'Album Media',
            'media' => true,
            'albums' => true,
            'content' => 'admin/media/albums',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = ['data' => $this->albumModel
            ->where('is_deleted', 0)
            ->findAll()];

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
            'album_title' => 'required|min_length[3]',
            'album_description' => 'permit_empty|string',
            'image_cover' => 'uploaded[image_cover]|is_image[image_cover]|max_size[image_cover,2048]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $cover = $this->request->getFile('image_cover');
        $filename = $cover->getRandomName();
        $cover->move('upload/image/', $filename);

        $slug = url_title($this->request->getPost('album_title'), '-', true);

        $this->albumModel->insert([
            'album_title'       => $this->request->getPost('album_title'),
            'album_description' => $this->request->getPost('album_description'),
            'album_slug'        => $slug,
            'image_cover'       => $filename,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => session('user_id'),
            'is_deleted'        => 0
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil ditambahkan.'
        ]);
    }

    public function edit($id)
    {
        $album = $this->albumModel->find($id);
        if (!$album) {
            return $this->failNotFound('Album tidak ditemukan');
        }

        return $this->response->setJSON($album);
    }

    public function postUpdate($id)
    {
        helper(['form', 'text']);
        $album = $this->albumModel->find($id);
        if (!$album) {
            return $this->failNotFound('Album tidak ditemukan');
        }

        $data = [
            'album_title'       => $this->request->getPost('album_title'),
            'album_description' => $this->request->getPost('album_description'),
            'album_slug'        => url_title($this->request->getPost('album_title'), '-', true),
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => session('user_id'),
        ];

        $cover = $this->request->getFile('image_cover');
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $newName = $cover->getRandomName();
            $cover->move(FCPATH . 'upload/image', $newName);
            $data['image_cover'] = $newName;

            // Hapus cover lama jika ada
            if ($album['image_cover'] && file_exists(FCPATH . 'upload/image/' . $album['image_cover'])) {
                unlink(FCPATH . 'upload/image/' . $album['image_cover']);
            }
        }

        $this->albumModel->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil diperbarui.'
        ]);
    }

    public function delete($id)
    {
        $this->albumModel->update($id, [
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => user_id()
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil dihapus.'
        ]);
    }

    public function restore($id)
    {
        $this->albumModel->update($id, [
            'is_deleted' => 0,
            'restored_at' => date('Y-m-d H:i:s'),
            'restored_by' => user_id()
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil dipulihkan.'
        ]);
    }

    public function uploadPhotos($id)
    {
        $album = $this->albumModel->find($id);
        if (!$album) {
            return $this->failNotFound('Album tidak ditemukan');
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
                    'photo_album_id' => $id,
                    'photo_name'     => $filename,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'created_by'     => user_id(),
                    'is_deleted'     => 0
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
