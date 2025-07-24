<?php

namespace App\Controllers;

use App\Models\PostsModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new PostsModel();
        $data = [
            'title' => 'Daftar Artikel',
            'artikel' => $model->getAllPosts(),
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
