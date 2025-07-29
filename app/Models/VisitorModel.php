<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = ['ip_address', 'user_agent', 'visited_at'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Statistik harian: kunjungan per tanggal
    public function getDailyStats($limit = 30)
    {
        return $this->select("DATE(visited_at) as visit_date, COUNT(*) as total")
                    ->groupBy("visit_date")
                    ->orderBy("visit_date", 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // Statistik bulanan: kunjungan per bulan
    public function getMonthlyVisitStats($year = null)
    {
        $year = $year ?? date('Y');

        return $this->select("DATE_FORMAT(visited_at, '%Y-%m') as month, COUNT(*) as total")
                    ->where("YEAR(visited_at)", $year)
                    ->groupBy("month")
                    ->orderBy("month", 'ASC')
                    ->findAll();
    }

    // Statistik tahunan
    public function getYearlyVisitStats()
    {
        return $this->select("YEAR(visited_at) as year, COUNT(*) as total")
                    ->groupBy("year")
                    ->orderBy("year", 'ASC')
                    ->findAll();
    }

    // Mencatat kunjungan
    public function logVisit()
    {
        $ip  = $_SERVER['REMOTE_ADDR'];
        $ua  = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $uri = service('uri')->getPath();

        // Abaikan akses ke halaman admin
        if (str_starts_with($uri, 'admin')) {
            return;
        }

        $today = date('Y-m-d');

        $existing = $this->where('ip_address', $ip)
                         ->where('DATE(visited_at)', $today)
                         ->first();

        if (! $existing) {
            $this->insert([
                'ip_address' => $ip,
                'user_agent' => $ua,
                'visited_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function countToday()
    {
        return $this->where('DATE(visited_at)', date('Y-m-d'))->countAllResults();
    }

    public function countThisMonth()
    {
        return $this->where('visited_at >=', date('Y-m-01'))
                    ->where('visited_at <=', date('Y-m-t 23:59:59'))
                    ->countAllResults();
    }

    public function countThisYear()
    {
        return $this->where('YEAR(visited_at)', date('Y'))->countAllResults();
    }

    public function countTotal()
    {
        return $this->countAllResults();
    }
}
