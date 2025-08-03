<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $allowedFields    = [
        'post_title',
        'post_content',
        'post_image',
        'post_author',
        'post_categories',
        'post_type',
        'post_status',
        'post_visibility',
        'post_comment_status',
        'post_slug',
        'post_tags',
        'post_counter',
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

    public function getAllPosts($type = 'post')
    {
        $builder = $this->db->table($this->table . ' x1');
        $builder->select('
        x1.id,
        x1.post_title,
        x1.post_slug,
        x1.post_status,
        x1.created_at,
        x1.updated_at,
        x1.is_deleted,
        x1.post_image,
        x1.post_type,
        x2.user_full_name AS post_author,
        x3.category_name
    ');
        $builder->join('users x2', 'x1.post_author = x2.id', 'left');
        $builder->join('categories x3', 'x1.post_categories = x3.id', 'left');
        $builder->where('x1.post_type', $type);

        $builder->orderBy('x1.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }
    public function getAllPostsPublic($type = 'post')
    {
        $builder = $this->db->table($this->table . ' x1');
        $builder->select('
        x1.id,
        x1.post_title,
        x1.post_slug,
        x1.post_content,
        x1.post_image,
        x2.user_full_name AS post_author,
        x3.category_name
    ');
        $builder->join('users x2', 'x1.post_author = x2.id', 'left');
        $builder->join('categories x3', 'x1.post_categories = x3.id', 'left');
        $builder->where('x1.post_type', $type);
        $builder->where('x1.post_status', 'publish');
        $builder->where('x1.post_visibility', 'public');

        $builder->orderBy('x1.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function getIdBySlug($slug)
    {
        return $this->where('post_slug', $slug)
            ->where('post_type', 'post')
            ->where('is_deleted', 'false')
            ->select('id')
            ->first(); // mengembalikan satu row (bisa null)
    }

    public function getPostsSlug($slug)
    {
        $builder = $this->db->table($this->table . ' x1');
        $builder->select('
        x1.id,
        x1.post_title,
        x1.post_slug,
        x1.post_content,
        x1.post_image,
        x1.post_status,
        x1.created_at,
        x1.updated_at,
        x1.is_deleted,
        x1.post_type,
        x2.user_full_name AS post_author,
        x2.user_jabatan AS author_jabatan,
        x2.user_bio AS author_bio,
        x2.user_contact AS post_contact,
        x3.category_name
    ');
        $builder->join('users x2', 'x1.post_author = x2.id', 'left');
        $builder->join('categories x3', 'x1.post_categories = x3.id', 'left');
        $builder->where('x1.is_deleted', 'false');
        $builder->where('x1.post_slug', $slug);

        return $builder->get()->getRowArray();
    }
    public function getPostsId($id)
    {
        $builder = $this->db->table($this->table . ' x1');
        $builder->select('
        x1.id,
        x1.post_title,
        x1.post_slug,
        x1.post_content,
        x1.post_image,
        x1.post_status,
        x1.post_categories,
        x1.created_at,
        x1.updated_at,
        x1.is_deleted,
        x1.post_type,
        x2.user_full_name AS post_author,
        x3.category_name
    ');
        $builder->join('users x2', 'x1.post_author = x2.id', 'left');
        $builder->join('categories x3', 'x1.post_categories = x3.id', 'left');
        $builder->where('x1.is_deleted', 'false');
        $builder->where('x1.id', $id);

        return $builder->get()->getRowArray();
    }

    public function getWhere($keyword = '', $returnType = 'count', $limit = 0, $offset = 0)
    {
        $builder = $this->db->table($this->table . ' x1');
        $builder->select("
            x1.id,
            x1.post_title,
            x2.user_full_name AS post_author,
            x1.post_status,
            x1.created_at,
            x1.is_deleted
        ");
        $builder->join('users x2', 'x1.post_author = x2.id', 'left');
        $builder->where('x1.post_type', 'post');

        $session = session();
        $userType = $session->get('user_type');
        $userId = $session->get('user_id');

        if (in_array($userType, ['student', 'employee'])) {
            $builder->where('x1.post_author', $userId);
        }

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('x1.post_title', $keyword)
                ->orLike('x2.user_full_name', $keyword)
                ->orLike('x1.post_status', $keyword)
                ->orLike('x1.created_at', $keyword)
                ->groupEnd();
        }

        if ($returnType === 'count') {
            return $builder->countAllResults();
        }

        if ($limit > 0) {
            $builder->limit($limit, $offset);
        }

        $builder->orderBy('x1.created_at', 'DESC');

        return $builder->get()->getResult();
    }

    public function getOpeningSpeech()
    {
        return $this->where('post_type', 'opening_speech')
            ->select('post_content')
            ->first()['post_content'] ?? '';
    }

    public function updateOpeningSpeech(array $data)
    {
        $exists = $this->where('post_type', 'opening_speech')->countAllResults();

        if ($exists === 0) {
            return $this->insert($data);
        }

        return $this->where('post_type', 'opening_speech')->set($data)->update();
    }
}
