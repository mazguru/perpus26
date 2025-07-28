<?php

namespace App\Controllers;

use App\Libraries\Auth;
use Config\AdminMenu;

class Menu extends AdminController
{
    protected $userModel;
    protected $employeeModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        
        helper(['form', 'url', 'menu']);
    }
    public function getMenuadmin()
    {
        $role = session('user_role') ?? 'guest';
        $rawMenus = menuadmin();
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
