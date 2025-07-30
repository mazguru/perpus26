<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\publik\PostsModel;

class Search extends BaseController
{
    public function getIndex()
    {
        $q       = trim((string) $this->request->getGet('q'));
        $perPage = (int) ($this->request->getGet('per_page') ?? 6);
        $page    = (int) ($this->request->getGet('page') ?? 1);

        $model = new PostsModel();
        $model->search_index($q); // siapkan query di model

        $results = $model->paginate($perPage, 'default', $page); // tetap pakai paginate() dari Model

        $data = [
            'title' => 'Pencarian',
            'q'       => $q,
            'results' => $results,
            'pager'   => $model->pager,
            'content' => 'frontend/search'
        ];

        return view('layouts/master', $data);
    }
}
