<?php

namespace App\Controllers;

use App\Models\PostCategoriesModel;
use App\Models\publik\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GaleriFoto extends PublicController
{

    public function getIndex($slug = null)
    {
        return view('layouts/master', [
            'title'    => 'Galeri Video',
            'content'  => 'frontend/galery/videos',
        ]);
    }
}
