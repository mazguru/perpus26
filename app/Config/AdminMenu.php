<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class AdminMenu extends BaseConfig
{
    public $menu;

    public function __construct()
    {
        $this->menu = include(APPPATH . 'Config/Menu/admin_menu.php');
    }
}
