<?php

namespace App\Controllers;

use App\Models\AlbumModel;
use App\Models\MenusModel;
use App\Models\PhotoModel;

class Home extends PublicController
{
    public function index()
    {
        $data = [
            'content' => 'frontend/home/index'
        ];
        return view('layouts/master', $data);
    }
    public function contact()
    {
        return view('layouts/master', [
            'title'    => 'Contact Us',
            'content'  => 'frontend/hubungi-kami',
        ]);
    }
    public function galeriVideos()
    {
        return view('layouts/master', [
            'title'    => 'Galeri Foto',
            'content'  => 'frontend/galery/videos',
        ]);
    }
    public function galeriPhotos()
    {
        return view('layouts/master', [
            'title'    => 'Galeri Foto',
            'content'  => 'frontend/galery/albums',
        ]);
    }



    //menu
    public function menus()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Akses tidak diizinkan']);
        }
        $menuModel = new MenusModel();
        $rawMenus = $menuModel->getMenuWithChildren();
        return $this->response->setJSON($rawMenus); 
    }
}
