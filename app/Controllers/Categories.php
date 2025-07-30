<?php

namespace App\Controllers;

use App\Models\PostCategoriesModel;
use App\Models\publik\PostsModel as PublikPostsModel;

class Categories extends PublicController
{

    public function getIndex($slug = null)
    {
        $model = new PostCategoriesModel();
        $categories = $model->where('category_slug', $slug)
                ->where('is_deleted', 'false') // atau whereNull('deleted_at')
                ->first();;

        if (!$categories) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel tidak ditemukan");
        }

        $data = [
            'title' => $categories['category_name'],
            'categorySlug' => $slug,
            'content' => 'frontend/categories/index'
        ];

        return view('layouts/master', $data);
    }
    public function postList()
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

        $perPage = (int) (session('post_per_page') ?? 6);
        $perPage = $perPage > 0 ? $perPage : 6;

        $offset = ($pageNumber - 1) * $perPage;

        // Validasi alpha_dash sederhana: huruf, angka, strip (-)
        $isValidSlug = (bool) preg_match('/^[a-z0-9-]+$/i', $categorySlug);

        $rows = [];
        
            $model = new PublikPostsModel();
            // get_post_categories() sudah kita konversi untuk mengembalikan array
            $rows = $model->get_post_categories($categorySlug, $perPage, $offset);
        

        return $this->response->setJSON([
            'rows' => $rows,
            'slug' => $categorySlug
        ]);
    }
}
