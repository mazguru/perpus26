<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table            = 'comments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $useSoftDeletes   = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'comment_post_id',
        'comment_author',
        'comment_email',
        'comment_url',
        'comment_ip_address',
        'comment_content',
        'comment_subject',
        'comment_reply',
        'comment_status',
        'comment_agent',
        'comment_parent_id',
        'comment_type',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getTopLevelComments($postId, $limit = 5, $offset = 0)
    {
        return $this->where('comment_post_id', $postId)
            ->where('comment_parent_id', null)
            ->where('is_deleted', 'false')
            ->where('comment_status', 'approved')
            ->orderBy('created_at', 'DESC')
            ->findAll($limit, $offset);
    }

    public function getReplies($postId)
    {
        return $this->where('comment_post_id', $postId)
            ->where('comment_parent_id !=', null)
            ->where('is_deleted', 'false')
            ->where('comment_status', 'approved')
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }
}
