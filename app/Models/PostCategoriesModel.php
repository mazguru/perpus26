<?php

namespace App\Models;

use CodeIgniter\Model;

class PostCategoriesModel extends Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $useSoftDeletes   = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'category_name',
        'category_description',
        'category_slug',
        'category_type',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
        'restored_at',
        'is_deleted',
    ];

    /**
     * Get filtered data for posts
     *
     * @param string $keyword
     * @param string $returnType
     * @param int $limit
     * @param int $offset
     * @return int|array
     */
    public function getWhere(string $keyword = '', string $returnType = 'count', int $limit = 0, int $offset = 0)
    {
        $builder = $this->builder();
        $builder->select('id, category_name, category_description, category_slug, is_deleted');
        $builder->where('category_type', 'post');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('category_name', $keyword)
                ->orLike('category_description', $keyword)
                ->orLike('category_slug', $keyword)
                ->groupEnd();
        }

        if ($returnType === 'count') {
            return $builder->countAllResults();
        }

        if ($limit > 0) {
            $builder->limit($limit, $offset);
        }

        return $builder->get()->getResult();
    }
    public function getCategories($type = null)
    {
        $builder = $this->builder();
        $builder->select('id, category_name');
        if ($type) {
            $builder->where('category_type', $type);
        }
        return $builder->get()->getResultArray();
    }

    /**
     * Get dropdown options (id => category_name)
     *
     * @return array
     */
    public function dropdown(): array
    {
        $builder = $this->builder();
        $builder->select('id, category_name');
        $builder->where('category_type', 'post');
        $builder->orderBy('category_name', 'ASC');

        $query = $builder->get();
        $result = [];

        foreach ($query->getResult() as $row) {
            $result[$row->id] = $row->category_name;
        }

        return $result;
    }

    /**
     * Save custom data
     *
     * @param array $data
     * @return int
     */
    public function saveCategory(array $data): int
    {
        $this->insert($data);
        return $this->insertID();
    }
}
