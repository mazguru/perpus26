<?php

namespace App\Controllers;

use App\Libraries\Auth;
use App\Models\MenusModel;
use Config\AdminMenu;

class Menupublic extends PublicController
{
   public function getIndex()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Akses tidak diizinkan']);
        }
        $menuModel = new MenusModel();
        $rawMenus = $menuModel->getMenuWithChildren();

        

        return $this->response->setJSON($rawMenus); 
    }
}
