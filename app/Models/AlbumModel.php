<?php

namespace App\Models;

use CodeIgniter\Model;

class AlbumModel extends Model
{
    protected $table = 'albums';
    protected $primaryKey = 'id';
    protected $allowedFields = ['album_title', 'album_description', 'album_slug', 'image_cover', 'created_at', 'updated_at', 'deleted_at', 'restored_at', 'created_by', 'updated_by', 'deleted_by', 'restored_by', 'is_deleted'];
}
