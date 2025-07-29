<?php

namespace App\Controllers\Users;

use App\Controllers\AdminController;
use App\Models\UserModel;

class Users extends AdminController
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
        $data = [
            'title' => 'Daftar Pengguna',
            'halaman' => 'users',
            'breadcrumb' => 'Daftar Pengguna',
            'content' => 'admin/users/list'
        ];
        return view('layouts/master_admin', $data);
    }

    public function getList()
    {
        $users = $this->userModel->getUsers();
        $allUsers = $this->userModel->getAllUsers();
        return $this->response->setJSON(['data' => $users, 'alldata' => $allUsers]);
    }

    public function postCreate()
    {
        $input = $this->request->getJSON(true);

        if (!$this->validate($this->_rules($input))) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'data salah',
                'errors' => $this->validator->getErrors()
            ]);
        }

        if ($this->userModel->where('user_name', $input['user_name'])->countAllResults() > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Username already exists.'
            ]);
        }

        $input['user_password'] = password_hash($input['user_password'], PASSWORD_BCRYPT);
        unset($input['user_password2']);
        $input['created_by'] = session('user_id');

        if ($this->userModel->insert($input)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User has been successfully created.'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to create user.'
        ]);
    }

    public function postEdit($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pengguna tidak ditemukan']);
        }

        $input = $this->request->getJSON(true);
        if (!$this->validate($this->_rules($input, 'edit'))) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ]);
        }

        if (!empty($input['user_password'])) {
            $input['user_password'] = password_hash($input['user_password'], PASSWORD_BCRYPT);
        } else {
            unset($input['user_password']);
        }

        unset($input['user_password2']);

        $this->userModel->update($id, $input);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pengguna berhasil diperbarui.'
        ]);
    }

    public function resetPassword()
    {
        $id = $this->request->getGet('id');
        if (!$id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID pengguna tidak ditemukan.']);
        }

        $defaultPassword = '123456789';
        $this->userModel->update($id, [
            'user_password' => password_hash($defaultPassword, PASSWORD_BCRYPT)
        ]);

        // Simpan log (buat fungsi sendiri jika perlu)
        // save_log('reset password', 'Mereset password ' . $id, session('user_id'));

        return $this->response->setJSON(['status' => 'success', 'message' => 'Password telah direset ke default.']);
    }

    private function _rules($data, $type = 'create')
    {
        $id = $data['id'] ?? '';

        $rules = [
            'user_name' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.user_name,id,' . $id . ']'
            ],
            'user_email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.user_email,id,' . $id . ']'
            ],
            'user_type' => [
                'label' => 'Role',
                'rules' => 'required|in_list[super_admin,administrator,employee,student]'
            ]
        ];

        if ($type === 'create') {
            $rules['user_password'] = [
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ];
            $rules['user_password2'] = [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[user_password]'
            ];
        }

        return $rules;
    }

}
