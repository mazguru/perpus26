<?php

namespace App\Controllers;

use Config\AdminMenu;

class AdminController extends BaseController
{
    protected $session;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();

        // Cek login
        if (!$this->session->has('user_name')) {
            return redirect()->to(base_url('login'))->with('msg', 'Anda harus login.');
        }
    }

    public function menu()
    {
        $role = session('user_role') ?? 'guest';

        $rawMenus = (new AdminMenu())->menu;
        $filtered = array_filter($rawMenus, function ($item) use ($role) {
            return in_array($role, $item['roles'] ?? []);
        });

        foreach ($filtered as &$item) {
            if (isset($item['submenu'])) {
                $item['submenu'] = array_filter($item['submenu'], function ($sub) use ($role) {
                    return in_array($role, $sub['roles'] ?? []);
                });
            }
        }

        return $this->response->setJSON(array_values($filtered));
    }
}
