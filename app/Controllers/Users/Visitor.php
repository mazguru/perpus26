<?php

namespace App\Controllers\Users;

use App\Controllers\AdminController;
use App\Models\VisitorModel;

class Visitor extends AdminController
{
    protected $visitorModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->visitorModel = new VisitorModel();
        // 🔑 Inisialisasi Primary Key & Table
        $this->pk = 'id';            // Ganti dengan nama kolom PK sebenarnya
        $this->table = 'visitors';      // Nama tabel
        $this->model = new \App\Models\GenericModel($this->table, $this->pk);
        helper(['form', 'url']);
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Daftar Visitor',
            'content' => 'admin/users/visitor'
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $visitor = $this->visitorModel->findAll();
        $allVisitor = $this->visitorModel->findAll();
        return $this->response->setJSON(['data' => $visitor, 'alldata' => $allVisitor]);
    }

}
