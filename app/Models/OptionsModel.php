<?php

namespace App\Models;

use CodeIgniter\Model;

class OptionsModel extends Model
{
    protected $table            = 'options';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['option_group', 'option_name', 'is_deleted'];
    protected $useTimestamps    = false;

    /**
     * Get data by keyword and group
     *
     * @param string $keyword
     * @param string $optionGroup
     * @param string $returnType 'count' | 'result'
     * @param int $limit
     * @param int $offset
     * @return int|array
     */
    public function getWhereData(string $keyword = '', string $optionGroup = '', string $returnType = 'count', int $limit = 0, int $offset = 0)
    {
        $builder = $this->builder();

        $builder->select('id, option_group, option_name, is_deleted');
        $builder->where('option_group', $optionGroup);

        if (!empty($keyword)) {
            $builder->groupStart()
                    ->like('option_name', $keyword)
                    ->groupEnd();
        }

        if ($returnType === 'count') {
            return $builder->countAllResults();
        }

        if ($limit > 0) {
            $builder->limit($limit, $offset);
        }

        $query = $builder->get();
        return $query->getResult();
    }

    /**
     * Get options by group
     *
     * @param string $optionGroup
     * @return array
     */
    public function getOptions(string $optionGroup = 'student_status'): array
    {
        $result = $this->where('option_group', $optionGroup)
                       ->where('is_deleted', 'false')
                       ->orderBy('option_name', 'ASC')
                       ->findAll();

        $dataset = [];
        foreach ($result as $row) {
            $dataset[$row['id']] = $row['option_name'];
        }

        return $dataset;
    }

    /**
     * Get option ID by name and group
     *
     * @param string $optionGroup
     * @param string $optionName
     * @return int
     */
    public function getOptionId(string $optionGroup = '', string $optionName = ''): int
    {
        $row = $this->select('id')
                    ->where('option_group', $optionGroup)
                    ->where('LOWER(option_name)', strtolower(trim($optionName)))
                    ->first();

        return $row['id'] ?? 0;
    }
}
