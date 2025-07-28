<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;

class Dashboard extends AdminController
{
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
