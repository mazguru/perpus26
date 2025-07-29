<?php

namespace App\Controllers;

use App\Models\PostsModel;

class Categories extends PublicController
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
            'content' => 'frontend/read/index'
        ];

        return view('layouts/master', $data);
    }
    public function getList()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'Bad request (bukan AJAX).'
            ]);
        }

        $categorySlug = (string) $this->request->getPost('category_slug');
        $pageNumber   = (int) ($this->request->getPost('page_number') ?? 1);
        $pageNumber   = max(1, $pageNumber);

        $perPage = (int) (session('post_per_page') ?? 10);
        $perPage = $perPage > 0 ? $perPage : 10;

        $offset = ($pageNumber - 1) * $perPage;

        // Validasi alpha_dash sederhana: huruf, angka, strip (-)
        $isValidSlug = (bool) preg_match('/^[a-z0-9-]+$/i', $categorySlug);

        $rows = [];
        if ($isValidSlug) {
            $model = new PostsModel();
            // get_post_categories() sudah kita konversi untuk mengembalikan array
            $rows = $model->get_post_categories($categorySlug, $perPage, $offset);
        }

        return $this->response->setJSON([
            'rows' => $rows
        ]);
    }
}
