<?php

namespace App\Controllers;

use App\Models\PostCategoriesModel;
use App\Models\publik\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GaleriVideo extends PublicController
{

    public function getIndex($slug = null)
    {
        return view('layouts/master', [
            'title'    => 'Galeri Foto',
            'content'  => 'frontend/galery/videos',
        ]);
    }
}
