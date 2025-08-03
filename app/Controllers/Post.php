<?php

namespace App\Controllers;

use App\Models\publik\PostsModel;

class Post extends PublicController
{

    public function getIndex($slug)
    {
        $model = new PostsModel();
        $artikel = $model->getPostsSlug($slug);

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel tidak ditemukan");
        }
        $session = session();
        $viewedKey = 'viewed_post_' . $slug;
        $expireSeconds = 3600; // 1 jam

        $lastViewed = $session->get($viewedKey);

        if ((!$lastViewed || time() - $lastViewed > $expireSeconds) && !session('logged_in')) {
            $model->set_post_counter($artikel['id']);
            $session->set($viewedKey, time());
        }




        $data = [
            'title' => $artikel['post_title'],
            'artikel' => $artikel,
            'content' => 'frontend/read/index'
        ];

        return view('layouts/master', $data);
    }
}
