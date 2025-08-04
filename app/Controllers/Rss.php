<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\publik\PostsModel;
use CodeIgniter\I18n\Time;

class Rss extends BaseController
{
    public function getIndex()
    {
        $postModel = new PostsModel();
        $posts = $postModel->feed(); // Ambil 10 terbaru

        $data = [
            'encoding'         => 'UTF-8',
            'feed_name'        => 'Berita Terbaru',
            'feed_url'         => site_url(),
            'page_description' => 'Kumpulan berita dan artikel terbaru',
            'page_language'    => 'id-ID',
            'creator_email'    => 'info@sekolahku.web.id',
            'posts'            => $posts
        ];

        return response()
            ->setContentType('application/rss+xml')
            ->setBody(view('frontend/feed', $data));
    }
}
