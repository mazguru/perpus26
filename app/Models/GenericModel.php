<?php

namespace App\Models;

use CodeIgniter\Model;

class GenericModel extends Model
{
    protected $table;
    protected $primaryKey;

    public function __construct($table = null, $primaryKey = null)
    {
        parent::__construct();

        if ($table) {
            $this->table = $table;
        }

        if ($primaryKey) {
            $this->primaryKey = $primaryKey;
        }
    }

    public function deleted($ids, $table = null)
    {
        $builder = $this->db->table($table ?? $this->table);
        return $builder->whereIn($this->primaryKey, $ids)
            ->update(['deleted_at' => date('Y-m-d H:i:s'), 'is_deleted' => 'true']);
    }

    public function deletePermanently($table, $pk, $ids)
    {
        return $this->db->table($table)
            ->whereIn($pk, $ids)
            ->delete();
    }

    public function restore($ids, $table = null)
    {
        return $this->db->table($table ?? $this->table)
            ->whereIn($this->primaryKey, $ids)
            ->update(['deleted_at' => null]);
    }

    public function findRowObject($pk, $id, $table = null)
    {
        return $this->db->table($table ?? $this->table)
            ->where($pk, $id)
            ->get()
            ->getRowObject();
    }
}
