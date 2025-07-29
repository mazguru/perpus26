<?php

namespace App\Controllers;

use App\Libraries\Auth;
use App\Models\MenuModel;
use Config\AdminMenu;

class Menupublic extends PublicController
{
   public function getIndex()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Akses tidak diizinkan']);
        }
        $menuModel = new MenuModel();
        $rawMenus = $menuModel->getMenusWithSubmenus();

        $menus = [];
        foreach ($rawMenus as $row) {
            if (!isset($menus[$row['id']])) {
                $menus[$row['id']] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'url' => $row['url'],
                    'submenus' => []
                ];
            }

            if (!empty($row['submenu_id'])) {
                $menus[$row['id']]['submenus'][] = [
                    'id' => $row['submenu_id'],
                    'title' => $row['submenu_title'],
                    'url' => $row['submenu_url']
                ];
            }
        }

        return $this->response->setJSON(array_values($menus));
    }
}
