<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Models\CommentModel;
use App\Models\PostsModel;
use App\Models\UserModel;
use App\Models\VisitorModel;

class Dashboard extends AdminController
{
    protected $userModel;
    protected $visitorModel;
    protected $commentModel;
    protected $postModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->userModel = new UserModel();
        $this->visitorModel = new VisitorModel();
        $this->commentModel = new CommentModel();
        $this->postModel = new PostsModel();
        helper(['form', 'url']);
    }

    /**
     * Halaman utama dashboard
     */
    public function getIndex()
    {
        if (!session()->has('user_name')) {
            return redirect()->to(base_url('login'))->with('msg', 'Silakan login terlebih dahulu.');
        }
        $today = date('Y-m-d');

        // Data aplikasi
        $dataapp = [
            'role' => session('user_role'),
            'school_name' => session('school_name'),
            'npsn' => session('npsn'),
            'user_name' => session('user_name'),
            'user_full_name' => session('user_full_name'),
            'meta_description' => session('meta_description'),
            'server_time' => date('H:i:s'),
            'tanggal_java' => date_java($today),
            'tanggal' => $today,
        ];

        // Cek hari libur
        $day_of_week = date('w');
        $dataapp['is_holiday'] = ($day_of_week == 0 || $day_of_week == 6);
        $dataapp['holiday_message'] = $day_of_week == 0
            ? "Minggu adalah hari libur. Waktunya untuk keluarga."
            : ($day_of_week == 6
                ? "Sabtu adalah hari libur. Waktunya untuk keluarga."
                : "Semangat");
        // Data post dan kategori
        $latestPost = get_latest_posts(5);
        $categories = count_post_categories();

        $labelct = [];
        $datact = [];
        // Statistik posting dan komentar
        $stats = [
            'articles' => $this->postModel->where('post_type', 'post')->countAllResults(),
            'comments' => $this->commentModel->where('comment_type', 'post')->countAllResults(),
            'messages' => $this->commentModel->where('comment_type', 'message')->countAllResults(),
        ];
        // Ambil data langsung dari summary
        $summary = $this->visitorModel->getSummaryStats();

        $daily   = $this->visitorModel->getDailyVisitor();
        $weekly  = $this->visitorModel->getWeeklyStats();
        $monthly = $this->visitorModel->getMonthlyStats();
        $yearly  = $this->visitorModel->getYearlyStats();

        $data = [
            'title'   => 'Dashboard Statistik Pengunjung',
            'summary' => $summary,
            'daily'   => $daily,
            'weekly'  => $weekly,
            'monthly' => $monthly,
            'yearly'  => $yearly,
            'title'    => 'Dashboard',
            'username' => session()->get('user_name'),
            'app' => $dataapp,
            'stats' => $stats,
            'latest' => $latestPost,
            'categories' => $categories,
            'comments' => $this->commentModel->get_recent_comments(5),
            'content' => 'admin/dashboard/index',
        ];

        return view('layouts/master_admin', $data);
    }

    /**
     * API statistik dashboard
     */
    public function getStats()
    {
        $today = date('Y-m-d');

        // Data aplikasi
        $dataapp = [
            'role' => session('user_role'),
            'school_name' => session('school_name'),
            'npsn' => session('npsn'),
            'user_name' => session('user_name'),
            'user_full_name' => session('user_full_name'),
            'meta_description' => session('meta_description'),
            'server_time' => date('H:i:s'),
            'tanggal_java' => date_java($today),
            'tanggal' => $today,
        ];

        // Cek hari libur
        $day_of_week = date('w');
        $dataapp['is_holiday'] = ($day_of_week == 0 || $day_of_week == 6);
        $dataapp['holiday_message'] = $day_of_week == 0
            ? "Minggu adalah hari libur. Waktunya untuk keluarga."
            : ($day_of_week == 6
                ? "Sabtu adalah hari libur. Waktunya untuk keluarga."
                : "Semangat");

        // Statistik posting dan komentar
        $stats = [
            'articles' => $this->postModel->where('post_type', 'post')->countAllResults(),
            'comments' => $this->commentModel->where('comment_type', 'post')->countAllResults(),
            'messages' => $this->commentModel->where('comment_type', 'message')->countAllResults(),
        ];

        // Data pengunjung
        $result = $this->visitorModel->getWeeklyVisitors();

        $days = ['Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab', 'Sun' => 'Min'];
        $vis = [];
        $label = [];
        $datachart = [];

        // Inisialisasi array 7 hari terakhir dengan 0
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $dayCode = date('D', strtotime($date));
            $dayName = $days[$dayCode];
            $vis[$dayName] = 0;
        }

        // Isi data dari database
        foreach ($result as $row) {
            $dayName = $days[date('D', strtotime($row['day']))];
            $vis[$dayName] = (int) $row['total'];
            $label[] = $dayName;
            $datachart[] = (int) $row['total'];
        }

        $visitor = [
            'today' => $this->visitorModel->countToday(),
            'month' => $this->visitorModel->countThisMonth(),
            'year'  => $this->visitorModel->countThisYear(),
            'chart' => $vis,
            'label' => $label,
            'data'  => $datachart,
        ];

        // Data post dan kategori
        $latestPost = get_latest_posts(5);
        $postCategories = count_post_categories();

        $labelct = [];
        $datact = [];
        foreach ($postCategories as $pc) {
            $labelct[] = $pc['category_name'];
            $datact[] = $pc['post_count'];
        }

        $data = [
            'app' => $dataapp,
            'stats' => $stats,
            'visitor' => $visitor,
            'post' => $latestPost,
            'categories' => [
                'label' => $labelct,
                'data' => $datact,
            ],
            'comment' => $this->commentModel->get_recent_comments(5)
        ];

        return $this->response->setJSON($data);
    }
}
