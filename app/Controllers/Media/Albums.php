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

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->albumModel = new AlbumModel();
        $this->photoModel = new PhotoModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'albums';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex(): string
    {
        $breadcrumbs = [
            ['title' => 'Beranda', 'url' => base_url()],
            ['title' => 'Kelola Album']
        ];
        $data = [
            'title' => 'Kelola Album',
            'breadcrumbs' => $breadcrumbs,
            'content' => 'admin/media/albums',
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'data' => $this->albumModel
                ->where('is_deleted', 'false')
                ->findAll(),
            'alldata' => $this->albumModel
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
            'album_title' => 'required|min_length[3]',
            'album_description' => 'permit_empty|string',
            'image_cover' => 'uploaded[image_cover]|is_image[image_cover]|max_size[image_cover,2048]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $cover = $this->request->getFile('image_cover');
        $filename = $cover->getRandomName();
        $cover->move('media_library/images/', $filename);

        $slug = url_title($this->request->getPost('album_title'), '-', true);

        $this->albumModel->insert([
            'album_title'       => $this->request->getPost('album_title'),
            'album_description' => $this->request->getPost('album_description'),
            'album_slug'        => $slug,
            'image_cover'       => $filename,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => session('user_id'),
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil ditambahkan.'
        ]);
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
            $cover->move(FCPATH . 'media_library/images', $newName);
            $data['image_cover'] = $newName;

            // Hapus cover lama jika ada
            if ($album['image_cover'] && file_exists(FCPATH . 'media_library/images/' . $album['image_cover'])) {
                unlink(FCPATH . 'media_library/images/' . $album['image_cover']);
            }
        }

        $this->albumModel->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Album berhasil diperbarui.'
        ]);
    }

    public function getUpload($albumId = null)
    {
        if (!$albumId) {
            return redirect()->to('media/albums')->with('error', 'Album tidak ditemukan.');
        }

        $album = $this->albumModel->find($albumId);
        if (!$album) {
            return redirect()->to('media/albums')->with('error', 'Album tidak valid.');
        }
        $breadcrumbs = [
            ['title' => 'Beranda', 'url' => base_url()],
            ['title' => 'Kelola Album', 'url' => base_url('media/albums')],
            ['title' => 'Foto Album']
        ];
        $data = [
            'title' => 'Album '.$album['album_title'],
            'album'  => $album,
            'breadcrumbs' => $breadcrumbs,
            'content' => 'admin/media/photos',
        ];
        return view('layouts/master_admin', $data);
    }
    public function getPhotos($albumId = null)
    {
        if (!$albumId) {
            return redirect()->to('media/albums')->with('error', 'Album tidak ditemukan.');
        }

        $album = $this->albumModel->find($albumId);
        if (!$album) {
            return redirect()->to('media/albums')->with('error', 'Album tidak valid.');
        }

        $photos = $this->photoModel
            ->where('photo_album_id', $albumId)
            ->orderBy('id', 'DESC')
            ->findAll();
        $data = [
            'photos' => $photos,
        ];
        return $this->response->setJSON($data);
    }

    public function postUploadImage()
    {
        $albumId = $this->request->getPost('photo_album_id');
        if (!$albumId) {
            return redirect()->back()->with('error', 'Album tidak ditemukan.');
        }

        $files = $this->request->getFiles()['photos'] ?? null;
        if (!$files) {
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
        }

        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('media_library/photos', $newName);

                $this->photoModel->save([
                    'photo_album_id' => $albumId,
                    'photo_name'     => $newName,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'created_by'     => session('user_id') ?? null,
                ]);
            }
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Foto berhasil diunggah.'
        ]);
    }

    public function postDeletePhotos($id = null)
    {
        $photo = $this->photoModel->find($id);
        if (!$photo) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan.');
        }

        // Hapus file dari sistem
        $path = FCPATH . 'media_library/photos/' . $photo['photo_name'];
        if (file_exists($path)) {
            unlink($path);
        }

        // Hapus dari database
        $this->photoModel->delete($id);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Foto berhasil dihapus.'
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
