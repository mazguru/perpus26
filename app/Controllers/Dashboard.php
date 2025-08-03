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
    protected $employeeModel;
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
    public function getIndex()
    {
        // Cek apakah user sudah login
        if (!session()->has('user_name')) {
            return redirect()->to(base_url('login'))->with('msg', 'Silakan login terlebih dahulu.');
        }

        $data = [
            'title'    => 'Dashboard',
            'username' => session()->get('user_name'),
            'content' => 'admin/dashboard/index',
        ];

        return view('layouts/master_admin', $data);
    }
    public function getStats()
    {
        $today = date('Y-m-d');

        $dataapp = [
            'role' => session('user_role'),
            'school_name' => session('school_name'),
            'npsn' => session('npsn'),
            'user_name' => session('user_name'),
            'user_full_name' => session('user_full_name'),
            'meta_description' => session('meta_description'),
        ];
        $dataapp['server_time'] = date('H:i:s'); // Format 24 jam
        $dataapp['tanggal_java'] = date_java(date('Y-m-d')); // Tanggal hari ini
        $dataapp['tanggal'] = date('Y-m-d'); // Tanggal hari ini
        $day_of_week = date('w'); // 0 (Minggu) - 6 (Sabtu)
        // Jika hari Sabtu atau Minggu, tampilkan pesan libur
        if ($day_of_week == 0 || $day_of_week == 6) {
            $dataapp['is_holiday'] = true;
            $dataapp['holiday_message'] = ($day_of_week == 0) ? "Minggu adalah hari libur. Waktunya untuk keluarga." : "Sabtu adalah hari libur. Waktunya untuk keluarga.";
        } else {
            $dataapp['is_holiday'] = false;
            $dataapp['holiday_message'] = "Semangat";
        }

        $stats = [
            'articles' => $this->postModel->where('post_type', 'post')->countAllResults(),
            'comments' => $this->commentModel->where('comment_type', 'post')->countAllResults(),
            'messages' => $this->commentModel->where('comment_type', 'message')->countAllResults(),
        ];

        $result = $this->visitorModel->getWeeklyVisitors();

        $days = ['Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab', 'Sun' => 'Min'];
        $vis = [];
        $label = [];
        $datachart = [];
        // Init default 7 days with 0

        // Inisialisasi array dengan 0
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $dayCode = date('D', strtotime($date));
            $dayName = $days[$dayCode];
            $vis[$dayName] = 0;
        }

        // Isi data dari DB
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
            'data' => $datachart,
        ];

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
