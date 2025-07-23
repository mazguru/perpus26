<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    // Aktifkan soft deletes
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'user_name',
        'user_password',
        'user_full_name',
        'user_email',
        'user_url',
        'user_group_id',
        'user_type',
        'user_profile_id',
        'user_biography',
        'user_forgot_password_key',
        'user_forgot_password_request_date',
        'has_login',
        'last_logged_in',
        'ip_address',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
        'restored_at',
        'is_deleted',
    ];

    protected $useTimestamps = true;
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
        return $this->where('is_deleted', 'false')->findAll(); // contoh filter
    }

    public function getAllUsers()
    {
        return $this->findAll();
    }
}
