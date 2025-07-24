<?php
namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'url', 'icon', 'order_num', 'is_active'];

    public function getMenusWithSubmenus()
    {
        return $this->select('menus.*, submenus.id AS submenu_id, submenus.title AS submenu_title, submenus.url AS submenu_url')
            ->join('submenus', 'submenus.menu_id = menus.id', 'left')
            ->orderBy('menus.order_num ASC, submenus.order_num ASC')
            ->findAll();
    }
}
