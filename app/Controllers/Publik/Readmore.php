<?php

namespace App\Controllers\Publik;

use App\Controllers\PublicController;
use App\Models\publik\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Readmore extends PublicController
{
    private function handlePostView(string $slug, string $viewPath): string
    {
        $model = new PostsModel();
        $artikel = $model->getPostsSlug($slug);

        if (!$artikel) {
            throw new PageNotFoundException("Artikel tidak ditemukan");
        }

        $session = session();
        $viewedKey = 'viewed_' . md5($viewPath . '_' . $slug);
        $expireSeconds = 3600; // 1 jam
        $lastViewed = $session->get($viewedKey);

        if ((!$lastViewed || time() - $lastViewed > $expireSeconds) && !session('logged_in')) {
            $model->set_post_counter($artikel['id']);
            $session->set($viewedKey, time());
        }

        $data = [
            'title'   => $artikel['post_title'],
            'artikel' => $artikel,
            'content' => $viewPath
        ];

        return view('layouts/master', $data);
    }

    public function article(string $slug)
    {
        return $this->handlePostView($slug, 'frontend/read/single-post');
    }

    public function page(string $slug)
    {
        return $this->handlePostView($slug, 'frontend/read/single-pages');
    }

    public function videos(string $slug)
    {
        return $this->handlePostView($slug, 'frontend/read/single-post');
    }
}
