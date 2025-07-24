<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\SubmenuModel;

class Menu extends BaseController
{
    protected $menuModel;
    protected $submenuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Menu',
            'menus' => $this->menuModel->orderBy('order_num')->findAll(),
            'content' => 'admin/menu/index'
        ];

        return view('layouts/master_admin', $data);
    }

    public function list()
    {
        $data = [
            'menus' => $this->menuModel->orderBy('order_num')->findAll(),
            'submenus' => $this->submenuModel->orderBy('order_num')->findAll(),
        ];
        return $this->response->setJSON($data);
    }

    public function submenus($menuId)
    {
        $menu = $this->menuModel->find($menuId);
        $submenus = $this->submenuModel->where('menu_id', $menuId)->orderBy('order_num')->findAll();
        return view('admin/menu/submenus', ['menu' => $menu, 'submenus' => $submenus]);
    }

    public function save()
    {
        $data = $this->request->getJSON(true);

        if (isset($data['menu_id']) || isset($data['parent_id'])) {
            // Tangani sebagai submenu
            $save = [
                'title' => $data['title'],
                'url' => $data['url'],
                'menu_id' => $data['menu_id'] ?? $data['parent_id'],
                'order_num' => $data['order_num'],
                'is_active' => $data['is_active']
            ];

            if (!empty($data['id'])) {
                $this->submenuModel->update($data['id'], $save);
            } else {
                $this->submenuModel->insert($save);
            }
        } else {
            // Tangani sebagai menu utama
            $save = [
                'title' => $data['title'],
                'url' => $data['url'],
                'is_active' => $data['is_active'],
                'order_num' => $data['order_num']
            ];

            if (!empty($data['id'])) {
                $this->menuModel->update($data['id'], $save);
            } else {
                $this->menuModel->insert($save);
            }
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'data tersimpan']);
    }

    public function delete($id)
    {
        $type = $this->request->getGet('type');

        if ($type === 'submenu') {
            $deleted = $this->submenuModel->delete($id);
        } else {
            // Default ke 'menu'
            $deleted = $this->menuModel->delete($id);
        }

        return $this->response->setJSON([
            'success' => $deleted ? true : false
        ]);
    }
}
