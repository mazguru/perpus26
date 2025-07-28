<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Auth;

class Login extends BaseController
{
    protected $auth;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->auth = new Auth();
    }

    public function getIndex()
    {
        if (session()->get('logged_in')) {
            header("Location: " . base_url('dashboard'));
            exit;
        }

        $ip = $this->request->getIPAddress();
        $data = [
            'page_title' => 'Login to Our Site',
            'ip_banned' => $this->auth->ip_banned($ip),
            'login_info' => $this->auth->ip_banned($ip)
                ? 'The login page has been blocked for 10 minutes'
                : 'Enter your username and password to log on'
        ];
        return view('admin/login', $data);
    }

    public function postVerify()
    {

        if ($this->request->isAJAX()) {
            try {
                $json = $this->request->getJSON(true); // true = array
                // Validasi
                $validation = \Config\Services::validation();
                $validation->setRules([
                    'user_name'     => ['label' => 'Nama Akun', 'rules' => 'required|trim'],
                    'user_password'      => ['label' => 'Kata Sandi', 'rules' => 'required|trim'],
                ]);


                if (!$validation->run($json)) {
                    $errorMessages = implode("\n", $validation->getErrors());

                    return $this->response->setJSON([
                        'status'    => 'error',
                        'message'   => $errorMessages,
                        'ip_banned' => false,
                    ]);
                }

                // Data valid
                $user_name     = $json['user_name'];
                $user_password = $json['user_password'];
                $ip            = $this->request->getIPAddress();

                $loginResult = $this->auth->logged_in($user_name, $user_password, $ip);

                if ($loginResult['success']) {
                    return $this->response->setJSON([
                        'status'     => 'success',
                        'message'    => 'Login Berhasil',
                        'redirect'   => base_url('dashboard'),
                        'ip_banned'  => false,
                    ]);
                }

                $message = match ($loginResult['reason']) {
                    'user_not_found' => 'Akun tidak ditemukan.',
                    'wrong_password' => 'Kata sandi salah.',
                    'ip_banned'      => 'Alamat IP Anda diblokir selama 10 menit.',
                    default          => 'Login gagal.',
                };

                return $this->response->setJSON([
                    'status'     => 'error',
                    'message'    => $message,
                    'ip_banned'  => $this->auth->ip_banned($ip),
                    'login_info' => $this->auth->ip_banned($ip)
                        ? 'The login page has been blocked for 10 minutes'
                        : 'Enter your username and password to log on',
                ]);
            } catch (\Throwable $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Server Error: ' . $e->getMessage()
                ]);
            }
        }

        return redirect()->to('/login');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Kamu telah logout');
    }
}
