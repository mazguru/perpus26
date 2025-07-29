<?php

namespace App\Controllers;

use App\Models\AlbumModel;
use App\Models\PhotoModel;

class Home extends PublicController
{
    public function getIndex()
    {
        $photos = new PhotoModel();
        $albumModel = new AlbumModel();

        $albums = $albumModel->where('is_deleted', 'false')->findAll();

        foreach ($albums as &$album) {
            $album['photos'] = $photos
                ->where('photo_album_id', $album['id'])
                ->where('is_deleted', 'false')
                ->findAll();
        }
        $data = [
            'title' => 'Daftar Artikel',
            'albums' => $albums,
            'content' => 'frontend/home/index'
        ];

        return view('layouts/master', $data);
    }
}
