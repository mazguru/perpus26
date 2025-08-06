<?php

namespace App\Controllers\Media;

use App\Controllers\BaseController;
use App\Models\PhotoModel;
use App\Models\AlbumModel;

class Photos extends BaseController
{
    protected $photoModel;
    protected $albumModel;

    public function __construct()
    {
        $this->photoModel = new PhotoModel();
        $this->albumModel = new AlbumModel();
    }

    public function getIndex($albumId = null)
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
            'title' => 'ALBUM',
            'album'  => $album,
            'photos' => $photos,
            'content' => 'admin/media/photos',
        ];
        return view('layouts/master_admin', $data);
    }

    public function postUpload()
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

        return redirect()->back()->with('success', 'Foto berhasil diunggah.');
    }

    public function getDelete($id = null)
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

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}
