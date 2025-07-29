<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Auth;

class Logout extends BaseController
{
    
    public function getIndex()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Kamu telah logout');
    }
}
