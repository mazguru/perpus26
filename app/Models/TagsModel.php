<?php

namespace App\Models;

use CodeIgniter\Model;

class TagsModel extends Model
{
    protected $table            = 'tags';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $allowedFields    = [
        'tag',
        'slug',
        'created_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
        'restored_at',
        'is_deleted',
    ];


    protected $useTimestamps = true;
    protected $useSoftDeletes   = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
}
