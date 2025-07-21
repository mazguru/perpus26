<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Blog extends BaseController
{
    public function index()
    {
        $model = new ArtikelModel();
        return view('blog/index', [
            'title' => 'Daftar Artikel',
            'artikel' => $model->orderBy('created_at', 'DESC')->findAll()
        ]);
    }


    public function detail($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where('slug', $slug)->first();

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel tidak ditemukan");
        }

        return view('blog/detail', [
            'title' => $artikel['judul'],
            'artikel' => $artikel
        ]);
    }
}
