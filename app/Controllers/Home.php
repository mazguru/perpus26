<?php

namespace App\Controllers;

use App\Models\PostsModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new PostsModel();
        return view('blog/index', [
            'title' => 'Daftar Artikel',
            'artikel' => $model->orderBy('created_at', 'DESC')->findAll()
        ]);
    }


    public function detail($slug)
    {
        $model = new PostsModel();
        $artikel = $model->where('post_slug', $slug)->first();

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel tidak ditemukan");
        }

        return view('blog/detail', [
            'title' => $artikel['post_title'],
            'artikel' => $artikel
        ]);
    }
}