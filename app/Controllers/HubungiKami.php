<?php

namespace App\Controllers;

use App\Models\PostCategoriesModel;
use App\Models\publik\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class HubungiKami extends PublicController
{

    public function getIndex($slug = null)
    {
        return view('layouts/master', [
            'title'    => 'Contact Us',
            'content'  => 'frontend/hubungi-kami',
        ]);
    }
}
