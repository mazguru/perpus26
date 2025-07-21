<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAttemptModel extends Model
{
    protected $table      = 'login_attempts';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    protected $allowedFields = [
        'user_name', 'ip_address', 'user_agent', 'status'
    ];
}
