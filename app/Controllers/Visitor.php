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

    public function getIndex()
    {
        $this->visitorModel->logVisit(); // log otomatis

        $stats = $this->visitorModel->getDailyStats();

        return $this->response->setJSON(['data' => array_reverse($stats)]);
    }
    public function getSummary()
{

    return $this->response->setJSON([
        'today' => $this->visitorModel ->countToday(),
        'month' => $this->visitorModel->countThisMonth(),
        'year'  => $this->visitorModel->countThisYear(),
        'total' => $this->visitorModel->countTotal(),
    ]);
}
}
