<?php

namespace App\Controllers;

use App\Models\MenusModel;

class Home extends PublicController
{
    public function index()
    {
        $data = [
            'content' => 'frontend/home/index'
        ];
        
        return render('layouts/master', $data);
    }
    public function contact()
    {
        return render('layouts/master', [
            'title'    => 'Contact Us',
            'content'  => 'frontend/hubungi-kami',
        ]);
    }
    public function galeriVideos()
    {
        return render('layouts/master', [
            'title'    => 'Galeri Foto',
            'content'  => 'frontend/galery/videos',
        ]);
    }
    public function galeriPhotos()
    {
        return render('layouts/master', [
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
