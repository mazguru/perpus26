<?php

namespace App\Controllers\Publik;

use App\Controllers\PublicController;
use App\Models\publik\PostsModel;
use App\Models\TagsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tags extends PublicController
{

    public function index($slug = null)
    {
    
        $page = $this->request->getGet('page') ?? 1;
        if (!$slug) {
            throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
        }

        // Ambil kategori
        $tagsModel = new TagsModel();
        $tags = $tagsModel->where('slug', $slug)
            ->where('deleted_at', null) // atau ->where('is_deleted', 0)
            ->first();

        if (!$tags) {
            throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
        }
        $postModel = new PostsModel();
        $postModel->applyPostsTags($slug);

        // gunakan group 'search' agar param halaman jadi ?page_search=2
        $results = $postModel->paginate(6, 'default', $page);

        return view('layouts/master', [
            'title'    => 'Tags #'.$tags['tag'],
            'results' => $results,
            'pager'   => $postModel->pager,
            'content'  => 'frontend/categories/index',
        ]);
    }
}
