<?php

namespace App\Controllers;

class PublicController extends BaseController
{
    protected $session;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();
        // Di sini tidak perlu cek login
    }

    public function getMenu()
    {
        $menuModel = new \App\Models\MenuModel();
        $rawMenus = $menuModel->getMenusWithSubmenus();

        // Format menjadi array nested
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
            if ($row['submenu_id']) {
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
