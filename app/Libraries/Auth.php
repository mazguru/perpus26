<?php

namespace App\Libraries;

use App\Models\UserModel;
use App\Models\LoginAttemptModel;
use Config\Services;

class Auth
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var UserModel
     */
    protected $userModel;

    /**
     * Class Constructor
     */
    public function __construct()
    {
        $this->session = Services::session();
        $this->userModel = model('UserModel');
    }

    public function logged_in($user_name, $user_password, $ip)
    {
        if ($this->ip_banned($ip)) {
            return ['success' => false, 'reason' => 'ip_banned'];
        }

        $userModel = new UserModel();
        $user = $userModel->getByUsername($user_name);

        if (!$user) {
            $this->log_ip_attempt($ip, $user_name, 'fail');
            return ['success' => false, 'reason' => 'user_not_found'];
        }

        if (!password_verify($user_password, $user['user_password'])) {
            $this->log_ip_attempt($ip, $user_name, 'fail');
            return ['success' => false, 'reason' => 'wrong_password'];
        }

        // Login sukses
        session()->set([
            'logged_in'      => true,
            'user_id'        => $user['id'],
            'user_name'      => $user['user_name'],
            'user_email'     => $user['user_email'],
            'user_full_name' => $user['user_full_name'],
            'user_group_id'  => $user['user_group_id'],
            'user_role'  => $user['user_type']
        ]);

        $userModel->update($user['id'], [
            'has_login'      => 1,
            'last_logged_in' => date('Y-m-d H:i:s'),
            'ip_address'     => $ip
        ]);

        $this->log_ip_attempt($ip, $user_name, 'success');

        return ['success' => true];
    }


    public function ip_banned($ip)
    {
        $log = session()->get("ip_$ip") ?? ['count' => 0, 'time' => time()];
        return ($log['count'] >= 5 && (time() - $log['time']) < 600);
    }

    protected function log_ip_attempt($ip, $username = null, $status = 'fail')
    {
        // Log ke session untuk pemblokiran IP
        $log = session()->get("ip_$ip") ?? ['count' => 0, 'time' => time()];
        if ((time() - $log['time']) > 600) {
            $log = ['count' => 1, 'time' => time()];
        } else {
            $log['count']++;
        }
        session()->set("ip_$ip", $log);

        // Simpan ke database
        $model = new LoginAttemptModel();
        $model->insert([
            'user_name'  => $username,
            'ip_address' => $ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'status'     => $status
        ]);
    }

    public function has_login()
    {
        return (bool) $this->session->get('logged_in');
    }

    public function restrict(): void
    {
        if (! $this->has_login()) {
            redirect()->to(base_url('login'))->send();
            exit;
        }
    }
}