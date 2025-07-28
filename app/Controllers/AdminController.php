<?php

namespace App\Controllers;

use App\Libraries\Auth;
use Config\AdminMenu;

class AdminController extends BaseController
{
    protected $session;
    protected $auth;
    protected $pk;
    protected $table;
    protected $model;

    


    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();
        // Inisialisasi library Auth
        $this->auth = new Auth();

        // Proteksi halaman admin: harus login
        $this->auth->restrict();
        

        // Cek login
        if (!$this->session->has('user_name')) {
            return redirect()->to(base_url('login'))->with('msg', 'Anda harus login.');
        }
    }

    /**
     * Hapus data (soft delete)
     */
    public function postDelete()
    {
        $response = [
            'status'  => 'warning',
            'message' => 'Tidak ada data yang dipilih',
        ];

        if ($this->request->isAJAX()) {
            $postData = $this->request->getJSON(true);
            $ids = $postData[$this->pk] ?? [];

            if (!empty($ids)) {
                if ($this->model->deleted($ids, $this->table)) {
                    $response = [
                        'status'  => 'success',
                        'message' => 'Data berhasil dihapus',
                        'id'      => $ids,
                    ];
                } else {
                    $response = [
                        'status'  => 'error',
                        'message' => 'Gagal menghapus data',
                    ];
                }
            }
        }

        return $this->response->setJSON($response);
    }

    /**
     * Hapus data permanen
     */
    public function postDeletepermanent()
    {
        $response = [
            'status'  => 'warning',
            'message' => 'Tidak ada data yang dipilih',
        ];

        if ($this->request->isAJAX()) {
            $postData = $this->request->getJSON(true);
            $ids = $postData[$this->pk] ?? [];

            if (!empty($ids)) {
                if ($this->model->deletePermanently($this->table, $this->pk, $ids)) {
                    $response = [
                        'status'  => 'success',
                        'message' => 'Data berhasil dihapus',
                        'id'      => $ids,
                    ];
                } else {
                    $response = [
                        'status'  => 'error',
                        'message' => 'Gagal menghapus data',
                    ];
                }
            }
        }

        return $this->response->setJSON($response);
    }

    /**
     * Restore data
     */
    public function postRestore()
    {
        $response = [
            'status'  => 'warning',
            'message' => 'Tidak ada data yang dipilih',
        ];

        if ($this->request->isAJAX()) {
            $postData = $this->request->getJSON(true);
            $ids = $postData[$this->pk] ?? [];

            if (!empty($ids)) {
                if ($this->model->restore($ids, $this->table)) {
                    $response = [
                        'status'  => 'success',
                        'message' => 'Data berhasil dikembalikan',
                        'id'      => $ids,
                    ];
                } else {
                    $response = [
                        'status'  => 'error',
                        'message' => 'Data gagal dikembalikan',
                    ];
                }
            }
        }

        return $this->response->setJSON($response);
    }

    /**
     * Cari data berdasarkan ID
     */
    public function findId()
    {
        if ($this->request->isAJAX()) {
            $id = _toInteger($this->request->getPost('id'));
            $data = _isNaturalNumber($id)
                ? $this->model->findRowObject($this->pk, $id, $this->table)
                : [];

            return $this->response->setJSON($data);
        }

        return $this->response->setStatusCode(403)->setBody('Forbidden');
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
