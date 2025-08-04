<?php

namespace App\Controllers\Publik;

use App\Controllers\PublicController;
use App\Models\publik\PostsModel;

class Search extends PublicController
{
    public function index()
    {
        $q       = trim((string) $this->request->getGet('q'));
        $perPage = (int) ($this->request->getGet('per_page') ?? 6);
        $page    = (int) ($this->request->getGet('page') ?? 1); // pakai nama param sesuai group

        $model = new PostsModel();
        $model->applySearch($q);

        // gunakan group 'search' agar param halaman jadi ?page_search=2
        $results = $model->paginate($perPage, 'default', $page);

        $data = [
            'title'   => 'Pencarian',
            'q'       => $q,
            'results' => $results,
            'pager'   => $model->pager,
            'content' => 'frontend/search',
        ];

        return view('layouts/master', $data);
    }
}
