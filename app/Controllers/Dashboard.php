<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Models\UserModel;

class Dashboard extends AdminController
{
    protected $userModel;
    protected $employeeModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->userModel = new UserModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'users';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }
    public function getIndex()
    {
        // Cek apakah user sudah login
        if (!session()->has('user_name')) {
            return redirect()->to(base_url('login'))->with('msg', 'Silakan login terlebih dahulu.');
        }

        $data = [
            'title'    => 'Dashboard',
            'username' => session()->get('user_name'),
            'content' => 'admin/dashboard/index',
        ];

        return view('layouts/master_admin', $data);
    }
}
