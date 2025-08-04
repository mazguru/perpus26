<?php

namespace App\Controllers\Publik;

use App\Controllers\PublicController;
use App\Models\PostCategoriesModel;
use App\Models\publik\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Categories extends PublicController
{

    public function index($slug = null)
    {
    
        $page = $this->request->getGet('page') ?? 1;
        if (!$slug) {
            throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
        }

        // Ambil kategori
        $catModel = new PostCategoriesModel();
        $category = $catModel->where('category_slug', $slug)
            ->where('deleted_at', null) // atau ->where('is_deleted', 0)
            ->first();

        if (!$category) {
            throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
        }
        $postModel = new PostsModel();
        $postModel->applyPostsCategoriesId($category['id']);

        // gunakan group 'search' agar param halaman jadi ?page_search=2
        $results = $postModel->paginate(6, 'default', $page);

        return view('layouts/master', [
            'title'    => $category['category_name'],
            'category' => $category,
            'results' => $results,
            'pager'   => $postModel->pager,
            'content'  => 'frontend/categories/index',
        ]);
    }
}
