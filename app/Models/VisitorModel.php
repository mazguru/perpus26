<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitors';
    protected $useTimestamps = true;

    protected $primaryKey = 'id';
    protected $allowedFields = ['ip_address', 'user_agent', 'visit_date'];
    protected $updatedField = 'updated_at';
    protected $createdField = 'created_at';


    public function getDailyStats($limit = 30)
    {
        return $this->select("visit_date, COUNT(*) as total")
            ->groupBy("visit_date")
            ->orderBy("visit_date", 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getMonthlyVisitStats($year = null)
    {
        $year = $year ?? date('Y');

        return $this->select("DATE_FORMAT(visit_date, '%Y-%m') as month, COUNT(*) as total")
            ->where("YEAR(visit_date)", $year)
            ->groupBy("month")
            ->orderBy("month", 'ASC')
            ->findAll();
    }

    public function getYearlyVisitStats()
    {
        return $this->select("YEAR(visit_date) as year, COUNT(*) as total")
            ->groupBy("year")
            ->orderBy("year", 'ASC')
            ->findAll();
    }


    public function logVisit()
    {
        $visitorModel = new \App\Models\VisitorModel();

        $today = date('Y-m-d');
        $ip    = $_SERVER['REMOTE_ADDR'];
        $ua    = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        // Bisa juga abaikan semua URL yang diawali "admin"
        $uri = service('uri')->getPath();
        if (str_starts_with($uri, 'admin')) {
            return;
        }
        $existing = $visitorModel->where('ip_address', $ip)
            ->where('visit_date', $today)
            ->first();

        if (!$existing) {
            // Simpan kunjungan baru
            $visitorModel->insert([
                'ip_address'   => $ip,
                'user_agent'   => $ua,
                'visit_date'   => $today,
            ]);
        }
    }

    public function countToday()
    {
        return $this->where('visit_date', date('Y-m-d'))->countAllResults();
    }

    public function countThisMonth()
    {
        return $this->where('visit_date >=', date('Y-m-01'))
            ->where('visit_date <=', date('Y-m-t'))
            ->countAllResults();
    }

    public function countThisYear()
    {
        return $this->where('YEAR(visit_date)', date('Y'))->countAllResults();
    }

    public function countTotal()
    {
        return $this->countAllResults();
    }
}
