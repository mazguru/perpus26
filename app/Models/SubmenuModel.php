<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table = 'submenus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_id', 'title', 'url', 'order_num', 'is_active'];
}
