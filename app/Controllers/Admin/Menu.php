<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\MenuModel;
use App\Models\SubmenuModel;

class Menu extends AdminController
{
    protected $menuModel;
    protected $submenuModel;
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'menu';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Manajemen Menu',
            'menus' => $this->menuModel->orderBy('order_num')->findAll(),
            'content' => 'admin/menu/index'
        ];

        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'menus' => $this->menuModel->orderBy('order_num')->findAll(),
            'submenus' => $this->submenuModel->orderBy('order_num')->findAll(),
        ];
        return $this->response->setJSON($data);
    }

    public function getSubmenus($menuId)
    {
        $menu = $this->menuModel->find($menuId);
        $submenus = $this->submenuModel->where('menu_id', $menuId)->orderBy('order_num')->findAll();
        return view('admin/menu/submenus', ['menu' => $menu, 'submenus' => $submenus]);
    }

    public function postSave()
    {
        $data = $this->request->getJSON(true);

        // Normalisasi nilai menu_id dan parent_id
        $isSubmenu = !empty($data['menu_id']) || !empty($data['parent_id']);
        $parentId = $data['menu_id'] ?? $data['parent_id'] ?? null;

        // Siapkan data umum
        $commonData = [
            'title'      => $data['title'] ?? '',
            'url'        => $data['url'] ?? '',
            'order_num'  => $data['order_num'] ?? 0,
            'is_active'  => isset($data['is_active']) ? (int) $data['is_active'] : 1,
        ];

        if ($isSubmenu) {
            // Tangani sebagai submenu
            $save = array_merge($commonData, [
                'menu_id' => $parentId,
            ]);

            if (!empty($data['id'])) {
                $this->submenuModel->update($data['id'], $save);
            } else {
                $this->submenuModel->insert($save);
            }
        } else {
            // Tangani sebagai menu utama
            if (!empty($data['id'])) {
                $this->menuModel->update($data['id'], $commonData);
            } else {
                $this->menuModel->insert($commonData);
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function getDeleted($id)
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
