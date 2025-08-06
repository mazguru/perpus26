<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table = 'banners';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title', 'caption', 'link', 'image_cover',
        'created_by', 'updated_by', 'deleted_by', 'restored_by',
        'deleted_at', 'restored_at', 'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
