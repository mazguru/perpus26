<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['ip_address', 'user_agent', 'visitor_key', 'visited_at'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mencatat kunjungan ke database
     */
    public function logVisit()
    {
        $session = session();
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $ua      = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $today   = date('Y-m-d');

        // 1. Filter bot agar tidak dihitung
        if (stripos($ua, 'bot') !== false || stripos($ua, 'crawler') !== false || stripos($ua, 'spider') !== false) {
            return;
        }

        // 2. Generate session ID untuk pengunjung
        if (!$session->has('visitor_session_id')) {
            $session->set('visitor_session_id', bin2hex(random_bytes(16))); // Unik
        }
        $sessionId = $session->get('visitor_session_id');

        // 3. Buat visitor key (gabungan session + ip + ua)
        $visitorKey = hash('sha256', $sessionId . $ip . $ua);

        // 4. Cek apakah pengunjung ini sudah tercatat hari ini
        $existing = $this->where('visitor_key', $visitorKey)
                         ->where('DATE(visited_at)', $today)
                         ->first();

        $isUnique = false;

        if (!$existing) {
            // Jika belum ada, simpan di tabel visitors
            $this->insert([
                'ip_address'  => $ip,
                'user_agent'  => $ua,
                'visitor_key' => $visitorKey,
                'visited_at'  => date('Y-m-d H:i:s'),
            ]);

            $isUnique = true;
        }

        // 5. Update atau insert ke tabel visitor_summary
        $db      = \Config\Database::connect();
        $builder = $db->table('visitor_summary');

        // Pastikan record untuk hari ini sudah ada
        $builder->ignore(true)->insert([
            'visit_date'      => $today,
            'total_visitors'  => 0,
            'unique_visitors' => 0
        ]);

        // Update total dan unique visitor
        $builder->set('total_visitors', 'total_visitors + 1', false);

        if ($isUnique) {
            $builder->set('unique_visitors', 'unique_visitors + 1', false);
        }

        $builder->where('visit_date', $today)->update();
    }

    /**
     * Bersihkan data lama (> 30 hari)
     */
    public function cleanOldVisitors()
    {
        $thresholdDate = date('Y-m-d H:i:s', strtotime('-30 days'));
        return $this->where('visited_at <', $thresholdDate)->delete();
    }

    /**
     * Ambil data ringkasan harian (30 hari terakhir)
     */
    public function getDailyStats($limit = 30)
    {
        $db = \Config\Database::connect();
        return $db->table('visitor_summary')
            ->select('visit_date, total_visitors, unique_visitors')
            ->orderBy('visit_date', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Ambil data visitor 7 hari terakhir untuk chart
     */
    public function getWeeklyVisitors()
    {
        $db = \Config\Database::connect();

        return $db->table('visitor_summary')
            ->select('visit_date as day, SUM(total_visitors) as total, SUM(unique_visitors) as unique_count')
            ->where('visit_date >=', date('Y-m-d', strtotime('-6 days')))
            ->groupBy('visit_date')
            ->orderBy('visit_date', 'ASC')
            ->get()
            ->getResultArray();
    }
    
    /**
     * Statistik harian (7 hari terakhir)
     */
    public function getDailyVisitor($days = 7)
    {
        $db = \Config\Database::connect();

        return $db->table('visitor_summary')
        ->select("visit_date, DATE_FORMAT(visit_date, '%W') as label,  total_visitors, unique_visitors")
        
            ->where('visit_date >=', date('Y-m-d', strtotime("-{$days} days")))
            ->orderBy('visit_date', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Statistik mingguan (4 minggu terakhir)
     */
    public function getWeeklyStats($weeks = 4)
    {
        $db = \Config\Database::connect();

        return $db->table('visitor_summary')
        ->select("YEARWEEK(visit_date, 1) as week, CONCAT('M', WEEK(visit_date, 1)) as label, SUM(total_visitors) as total, SUM(unique_visitors) as unique_count")
            ->where('visit_date >=', date('Y-m-d', strtotime("-{$weeks} weeks")))
            ->groupBy('week')
            ->orderBy('week', 'ASC')
            ->get()
            ->getResultArray();;
    }

    /**
     * Statistik bulanan (12 bulan terakhir)
     */
    public function getMonthlyStats($months = 12)
    {
        $db = \Config\Database::connect();

        return $db->table('visitor_summary')
        ->select("DATE_FORMAT(visit_date, '%Y-%m') as month, DATE_FORMAT(visit_date, '%b %y') as label, SUM(total_visitors) as total, SUM(unique_visitors) as unique_count")
            ->where('visit_date >=', date('Y-m-01', strtotime("-{$months} months")))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Statistik tahunan (5 tahun terakhir)
     */
    public function getYearlyStats($years = 5)
    {
        $db = \Config\Database::connect();

        return $db->table('visitor_summary')
        ->select("YEAR(visit_date) as year, YEAR(visit_date) as label, SUM(total_visitors) as total, SUM(unique_visitors) as unique_count")
            ->where('visit_date >=', date('Y-01-01', strtotime("-{$years} years")))
            ->groupBy('year')
            ->orderBy('year', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Statistik total
     */
    public function getSummaryStats()
    {
        $db = \Config\Database::connect();
        $today = date('Y-m-d');
        $startMonth = date('Y-m-01');
        $startYear = date('Y-01-01');

        // Hari ini
        $todayData = $db->table('visitor_summary')
            ->select('total_visitors, unique_visitors')
            ->where('visit_date', $today)
            ->get()
            ->getRowArray();

        // Bulan ini
        $monthData = $db->table('visitor_summary')
            ->select('SUM(total_visitors) as total, SUM(unique_visitors) as unique_count')
            ->where('visit_date >=', $startMonth)
            ->get()
            ->getRowArray();

        // Tahun ini
        $yearData = $db->table('visitor_summary')
            ->select('SUM(total_visitors) as total, SUM(unique_visitors) as unique_count')
            ->where('visit_date >=', $startYear)
            ->get()
            ->getRowArray();

        // Total semua
        $totalData = $db->table('visitor_summary')
            ->select('SUM(total_visitors) as total, SUM(unique_visitors) as unique_count')
            ->get()
            ->getRowArray();

        return [
            'today' => [
                'total' => $todayData['total_visitors'] ?? 0,
                'unique' => $todayData['unique_visitors'] ?? 0,
            ],
            'month' => [
                'total' => $monthData['total'] ?? 0,
                'unique' => $monthData['unique_count'] ?? 0,
            ],
            'year' => [
                'total' => $yearData['total'] ?? 0,
                'unique' => $yearData['unique_count'] ?? 0,
            ],
            'all_time' => [
                'total' => $totalData['total'] ?? 0,
                'unique' => $totalData['unique_count'] ?? 0,
            ]
        ];
    }

    /**
     * Hitung visitor hari ini
     */
    public function countToday()
    {
        $today = date('Y-m-d');
        return $this->db->table('visitor_summary')
            ->select('SUM(total_visitors) as total')
            ->where('visit_date', $today)
            ->get()
            ->getRow('total') ?? 0;
    }

    /**
     * Hitung visitor bulan ini
     */
    public function countThisMonth()
    {
        $startMonth = date('Y-m-01');
        return $this->db->table('visitor_summary')
            ->select('SUM(total_visitors) as total')
            ->where('visit_date >=', $startMonth)
            ->get()
            ->getRow('total') ?? 0;
    }

    /**
     * Hitung visitor tahun ini
     */
    public function countThisYear()
    {
        $startYear = date('Y-01-01');
        return $this->db->table('visitor_summary')
            ->select('SUM(total_visitors) as total')
            ->where('visit_date >=', $startYear)
            ->get()
            ->getRow('total') ?? 0;
    }
}
