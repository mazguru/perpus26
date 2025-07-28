<?php

namespace App\Controllers;

use App\Models\AlbumModel;
use App\Models\PhotoModel;
use App\Models\PostsModel;

class Home extends PublicController
{
    public function getIndex()
    {
        $model = new PostsModel();
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
            'artikel' => $model->getAllPosts(),
            'albums' => $albums,
            'content' => 'frontend/home/index'
        ];

        return view('layouts/master', $data);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Kamu telah logout');
    }
}
