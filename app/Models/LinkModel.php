<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table            = 'links';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'link_title', 'link_url', 'link_target', 'image_cover', 'link_type',
        'created_at', 'updated_at', 'deleted_at', 'restored_at',
        'created_by', 'updated_by', 'deleted_by', 'restored_by', 'is_deleted'
    ];

    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    // Auto filter non-deleted data
    protected $beforeFind = ['filterDeleted'];

    protected function filterDeleted(array $data)
    {
        if (!isset($data['where']['is_deleted'])) {
            $data['where']['is_deleted'] = false;
        }
        return $data;
    }
}
