<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'user_name',
        'user_password',
        'user_full_name',
        'user_email',
        'user_url',
        'user_group_id',
        'user_type',
        'user_profile_id',
        'user_bio',
        'user_contact',
        'user_jabatan',
        'user_forgot_password_key',
        'user_forgot_password_request_date',
        'has_login',
        'last_logged_in',
        'ip_address',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'restored_by',
        'restored_at',
        'is_deleted',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes   = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Tambahan: Ambil user berdasarkan username (untuk login)
    public function getByUsername($username)
    {
        return $this->where('user_name', $username)
            ->first();
    }

    public function getUsers()
    {
        return $this->where('is_deleted', 0)->findAll(); // contoh filter
    }

    public function getAllUsers()
    {
        return $this->select('id, user_name, user_full_name, user_type, user_email, user_bio, user_jabatan, user_contact, last_logged_in, is_deleted')->where('user_group_id !=','77')->findAll();
    }
    public function loggedIn(string $userName)
    {
        return $this->where('user_name', $userName)
            ->where('is_deleted', 'false')
            ->first();
    }

    public function lastLoggedIn(int $id)
    {
        return $this->update($id, [
            'last_logged_in' => date('Y-m-d H:i:s'),
            'ip_address'     => request()->getIPAddress(),
            'has_login'      => 'true'
        ]);
    }

    public function resetLoggedIn(int $id)
    {
        return $this->update($id, ['has_login' => 'false']);
    }

    public function getAttempts(string $ipAddress)
    {
        return db_connect()->table('login_attempts')
            ->where('ip_address', $ipAddress)
            ->get()->getRow();
    }

    public function increaseLoginAttempts(string $ipAddress)
    {
        $db = db_connect();
        $builder = $db->table('login_attempts');

        $row = $builder->where('ip_address', $ipAddress)->get()->getRow();
        if ($row) {
            $builder->where('ip_address', $ipAddress)
                ->update(['counter' => $row->counter + 1]);
        } else {
            $builder->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'ip_address' => $ipAddress,
                'counter'    => 1
            ]);
        }
    }

    public function resetAttempts(string $ipAddress)
    {
        return db_connect()->table('login_attempts')
            ->where('ip_address', $ipAddress)
            ->delete();
    }

    public function getLastLogin()
    {
        return $this->db->table('users')
            ->where('user_type !=', 'super_user')
            ->where('last_logged_in IS NOT NULL')
            ->orderBy('last_logged_in', 'DESC')
            ->limit(10)
            ->get()->getResult();
    }

    public function resetUserName(string $userName): bool
    {
        $userId = session('user_id');
        $count = $this->where('user_name', $userName)
            ->where('id !=', $userId)
            ->countAllResults();

        if ($count === 0) {
            return $this->update($userId, ['user_name' => $userName]);
        }

        return false;
    }

    public function resetUserEmail(string $userEmail): bool
    {
        $userId = session('user_id');
        $count = $this->where('user_email', $userEmail)
            ->where('id !=', $userId)
            ->countAllResults();

        if ($count === 0) {
            return $this->update($userId, ['user_email' => $userEmail]);
        }

        return false;
    }

    public function setForgotPasswordKey(string $email, string $key): bool
    {
        return $this->where('user_email', $email)
            ->set([
                'user_forgot_password_key' => $key,
                'user_forgot_password_request_date' => date('Y-m-d H:i:s')
            ])->update();
    }

    public function removeForgotPasswordKey(int $id): bool
    {
        return $this->update($id, [
            'user_forgot_password_key' => null,
            'user_forgot_password_request_date' => null
        ]);
    }

    public function resetPassword(int $id, string $password): bool
    {
        return $this->update($id, [
            'user_password' => password_hash($password, PASSWORD_BCRYPT),
            'user_forgot_password_key' => null,
            'user_forgot_password_request_date' => null
        ]);
    }

    public function getUserByEmail(string $email)
    {
        $user = $this->where('user_email', $email)->first();

        if ($user) {
            return [
                'user_email' => $user['user_email'],
                'user_full_name' => $user['user_full_name'] ?? null
            ];
        }

        return null;
    }

    public function getUserId(string $userType = 'student', int $profileId = 0): int
    {
        $user = $this->where('user_type', $userType)
            ->where('user_profile_id', $profileId)
            ->first();

        return $user ? (int) $user['id'] : 0;
    }

    public function emailExists(string $email, int $excludeId = 0): bool
    {
        $builder = $this->where('user_email', $email)
            ->where('is_deleted', 'false');

        if ($excludeId > 0) {
            $builder->where('id !=', $excludeId);
        }

        return $builder->countAllResults() > 0;
    }
}
