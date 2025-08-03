<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\MenusModel;
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

        $this->menuModel = new MenusModel();
        $this->submenuModel = new SubmenuModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'menus';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Manajemen Menu',
            'content' => 'admin/menu/index'
        ];

        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $data = [
            'menus' => $this->menuModel->getMenuWithChildren(),
            'submenus' => $this->menuModel->getMenusWithParent(),
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

        // Tangani sebagai menu utama
        if (!empty($data['id'])) {
            $this->menuModel->update($data['id'], $data);
        } else {
            $this->menuModel->insert($data);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function getDeleted($id)
    {
        // Default ke 'menu'
        $deleted = $this->menuModel->delete($id);

        return $this->response->setJSON([
            'success' => $deleted ? true : false
        ]);
    }
}
