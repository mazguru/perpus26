<?php

namespace App\Controllers;

use App\Models\VisitorModel;

class Visitor extends BaseController
{
    protected $visitorModel;

    public function __construct()
    {
        $this->visitorModel = new VisitorModel();
    }

    /**
     * Statistik harian untuk grafik
     */
    public function getIndex()
    {
        $stats = $this->visitorModel->getDailyStats(30);

        return $this->response->setJSON([
            'data' => array_reverse($stats) // data lama ke baru
        ]);
    }

    /**
     * Statistik ringkasan (hari ini, bulan ini, tahun ini, total)
     */
    public function getSummary()
    {
        $summary = $this->visitorModel->getSummaryStats();

        return $this->response->setJSON($summary);
    }
}
