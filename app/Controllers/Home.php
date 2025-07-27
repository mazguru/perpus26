<?php

namespace App\Controllers;

use App\Models\AlbumModel;
use App\Models\PhotoModel;
use App\Models\PostsModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new PostsModel();
        $photos = new PhotoModel();
        $albumModel = new AlbumModel();

        $albums = $albumModel->where('is_deleted', 0)->findAll();

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


    public function detail($slug)
    {
        $model = new PostsModel();
        $artikel = $model->getPostsSlug($slug);

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel tidak ditemukan");
        }

        return view('blog/detail', [
            'title' => $artikel['post_title'],
            'artikel' => $artikel
        ]);
    }
}
