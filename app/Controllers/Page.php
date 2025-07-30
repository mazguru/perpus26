<?php

namespace App\Controllers;

use App\Models\PostsModel;

class Page extends PublicController
{

    public function getIndex($slug)
    {
        $model = new PostsModel();
        $artikel = $model->getPostsSlug($slug);

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel tidak ditemukan");
        }

        $data = [
            'title' => $artikel['post_title'],
            'artikel' => $artikel,
            'content' => 'frontend/page/index'
        ];

        return view('layouts/master', $data);
    }
}
