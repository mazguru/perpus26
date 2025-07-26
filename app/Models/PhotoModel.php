<?php

namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['photo_album_id', 'photo_name', 'created_at', 'updated_at', 'deleted_at', 'restored_at', 'created_by', 'updated_by', 'deleted_by', 'restored_by', 'is_deleted'];
}
