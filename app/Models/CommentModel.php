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
            ->whereIn('comment_status', ['approved', 'unapproved'])
            ->orderBy('created_at', 'DESC')
            ->findAll($limit, $offset);
    }

    public function getReplies($postId)
    {
        return $this->where('comment_post_id', $postId)
            ->where('comment_parent_id !=', null)
            ->whereIn('comment_status', ['approved', 'unapproved'])
            ->where('is_deleted', 'false')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
    /**
     * Get Data (list atau hitung total)
     * @param string  $keyword
     * @param string  $return_type 'count' | 'rows'
     * @param integer $limit
     * @param integer $offset
     * @return int|array
     */
    public function get_where( string $keyword = '', string $return_type = 'count', string $type = 'post', int $limit = 0, int $offset = 0)
    {
        $b = $this->db->table($this->table . ' x1')
            ->select('
                x1.id,
                x1.comment_author,
                x1.comment_email,
                x1.comment_url,
                x1.created_at,
                x1.comment_content,
                x1.comment_reply,
                x1.comment_status,
                x2.post_title,
                x2.id AS comment_post_id,
                x2.post_slug,
                x1.is_deleted
            ', false)
            ->join('posts x2', 'x1.comment_post_id = x2.id', 'left')
            ->where('x1.comment_type', $type);

        if ($keyword !== '') {
            $b->groupStart()
                ->like('x1.comment_author', $keyword)
                ->orLike('x1.comment_email', $keyword)
                ->orLike('x1.comment_url', $keyword)
                ->orLike('x2.post_title', $keyword)
                ->orLike('x1.created_at', $keyword)
                ->orLike('x1.comment_content', $keyword)
              ->groupEnd();
        }

        if ($return_type === 'count') {
            return (int) $b->countAllResults();
        }

        if ($limit > 0) {
            $b->limit($limit, $offset);
        }

        return $b->get()->getResultArray();
    }

    /**
     * Komentar terbaru (approved & tidak terhapus)
     * @param int $limit
     * @return array
     */
    public function get_recent_comments(int $limit = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select('
                x1.id,
                x1.comment_author,
                x1.comment_url,
                x1.comment_content,
                x1.comment_reply,
                x1.comment_type,
                x1.comment_status,
                x2.id AS comment_post_id,
                x2.post_title,
                x2.post_slug,
                x1.created_at
            ', false)
            ->join('posts x2', 'x1.comment_post_id = x2.id', 'left')
            ->whereIn('x1.comment_type', ['post', 'message'])
            ->whereIn('x1.comment_status', ['approved', 'unapproved'])
            ->where('x1.is_deleted', 'false')
            ->orderBy('x1.created_at', 'DESC');

        if ($limit > 0) {
            $b->limit($limit);
        }

        return $b->get()->getResultArray();
    }

    /**
     * Komentar per posting (approved & tidak terhapus)
     * @param int $comment_post_id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get_post_comments(int $comment_post_id = 0, int $limit = 0, int $offset = 0): array
    {
        $b = $this->db->table($this->table . ' x1')
            ->select('
                x1.id,
                x1.comment_author,
                x1.comment_url,
                x1.created_at,
                x1.comment_content,
                x1.comment_reply
            ', false)
            ->join('posts x2', 'x1.comment_post_id = x2.id', 'left')
            ->where('x1.comment_type', 'post')
            ->where('x1.comment_status', 'approved')
            ->where('x1.is_deleted', 'false')
            ->where('x1.comment_post_id', $comment_post_id)
            ->orderBy('x1.created_at', 'DESC');

        if ($limit > 0) {
            $b->limit($limit, $offset);
        }

        return $b->get()->getResultArray();
    }
}
