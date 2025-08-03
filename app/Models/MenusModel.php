<?php

namespace App\Models;

use CodeIgniter\Model;

class MenusModel extends Model
{
    protected $table      = 'menus';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'menu_title',
        'menu_url',
        'menu_target',
        'menu_type',
        'menu_parent_id',
        'menu_position',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
        'restored_at',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getTopLevelMenus()
    {
        return $this->where('is_deleted', 'false')
            ->groupStart()
            ->where('menu_parent_id', null)
            ->orWhere('menu_parent_id', 0)
            ->groupEnd()
            ->orderBy('menu_position', 'ASC')
            ->findAll();
    }
    public function getMenusWithParent()
    {
        return $this->where('is_deleted', 'false')
            ->where('menu_parent_id !=', 0)
            ->orderBy('menu_position', 'ASC')
            ->findAll();
    }


    public function getActiveMenus()
    {
        return $this->where('is_deleted', 'false')
            ->orderBy('menu_position', 'ASC')
            ->findAll();
    }

    public function getMenuWithChildren()
    {
        $menus = $this->getActiveMenus();
        $tree = [];

        foreach ($menus as $menu) {
            if (!$menu['menu_parent_id']) {
                $menu['children'] = $this->getChildren($menus, $menu['id']);
                $tree[] = $menu;
            }
        }

        return $tree;
    }

    private function getChildren($menus, $parentId)
    {
        $children = [];
        foreach ($menus as $menu) {
            if ($menu['menu_parent_id'] == $parentId) {
                $menu['children'] = $this->getChildren($menus, $menu['id']);
                $children[] = $menu;
            }
        }
        return $children;
    }
}
