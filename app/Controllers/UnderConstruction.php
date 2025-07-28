<?php

namespace App\Controllers;

class UnderConstruction extends BaseController
{
    public function getIndex()
    {
        // Cek mode maintenance
        $maintenance = filter_var((string) session('site_maintenance'), FILTER_VALIDATE_BOOLEAN);
        $endDate = session('site_maintenance_end_date');
        $today = date('Y-m-d');

        // Kondisi pengecualian
        $allowAccess =
            !$maintenance ||
            !$endDate ||
            $endDate < $today;

        if ($allowAccess) {
            // Redirect manual karena berada di initController
            header("Location: " . base_url());
            exit();
        }
        return view('under-construction', [
            'title' => 'Under Construction',
        ]);
    }
}
