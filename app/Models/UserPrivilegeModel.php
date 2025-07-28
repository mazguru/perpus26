<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPrivilegeModel extends Model
{
    protected $table            = 'user_privileges';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'user_group_id',
        'module_id',
        'is_deleted',
    ];

    /**
     * Get Data
     *
     * @param string  $keyword
     * @param string  $returnType ('count' or 'result')
     * @param integer $limit
     * @param integer $offset
     * @return mixed
     */
    public function getWhere($keyword = '', $returnType = 'count', $limit = 0, $offset = 0)
    {
        $builder = $this->db->table($this->table . ' x1')
            ->select('x1.id, x2.user_group, x3.module_name, x3.module_description, x3.module_url, x1.is_deleted')
            ->join('user_groups x2', 'x1.user_group_id = x2.id', 'left')
            ->join('modules x3', 'x1.module_id = x3.id', 'left');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('x2.user_group', $keyword)
                ->orLike('x3.module_name', $keyword)
                ->orLike('x3.module_description', $keyword)
                ->orLike('x3.module_url', $keyword)
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

    /**
     * Get user privileges by group and role
     *
     * @param integer $userGroupId
     * @param string  $role
     * @return array
     */
    public function getUserPrivileges(int $userGroupId, string $role): array
    {
        $userPrivileges = ['dashboard', 'change_password', 'add_attendance', 'add_violations', 'laporan', 'lapor', 'laporanku'];

        switch ($role) {
            case 'student':
                $userPrivileges[] = 'profile';
                break;
            case 'employee':
                $userPrivileges[] = 'references';
                $userPrivileges[] = 'attendance';
                break;
            case 'danton':
                $userPrivileges = array_merge($userPrivileges, [
                    'student_profile', 'scholarships', 'achievements', 'posts', 'student_presence'
                ]);
                break;
            default:
                $userPrivileges = array_merge($userPrivileges, [
                    'monitor', 'users', 'references', 'attendance', 'employees', 'students', 'plugins', 'reference', 'settings', 'profile', 'violations'
                ]);
                break;
        }

        return $userPrivileges;
    }
}
