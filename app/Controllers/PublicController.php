<?php

namespace App\Controllers;

use App\Libraries\Token;
use App\Models\MenusModel;
use App\Models\VisitorModel;

class PublicController extends BaseController
{
    /**
     * General variables
     * 
     * @var array
     */
    protected $vars = [];

    /**
     * CSRF token instance
     * 
     * @var Token
     */
    protected $token;

    /**
     * Class constructor
     */
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Load helper
        helper(['text', 'blog', 'url']);

        // Inisialisasi Token
        $this->token = new Token();

        // Set custom CSRF token ke session (opsional)
        session()->set('csrf_token', $this->token->getToken());

        // Cek mode maintenance
        $maintenance = filter_var((string) session('site_maintenance'), FILTER_VALIDATE_BOOLEAN);
        $endDate = session('site_maintenance_end_date');
        $today = date('Y-m-d');
        $segment = service('uri')->getSegment(1) ?? '';

        if (
            $maintenance &&
            $endDate &&
            $endDate >= $today &&
            !in_array($segment, ['login', 'under-construction'])
        ) {
            // Redirect manual pakai header karena redirect()->to() tidak jalan di initController
            header("Location: " . base_url('under-construction'));
            exit();
        }

        // Caching jika diset
        if (session('site_cache') === true && session('site_cache_time') > 0) {
            $this->response->setCache(['ttl' => (int) session('site_cache_time')]);
        }

        // --- NEW: prepare menu + visitor summary for all views ---
        $cache = \Config\Services::cache();

        // 1) Menu (cache 60 detik)
        $menuCacheKey = 'site_menu';
        $menus = $cache->get($menuCacheKey);

        if ($menus === null) {
            $menuModel = new MenusModel();
            $menus = $menuModel->getMenuWithChildren();
            $cache->save($menuCacheKey, $menus, 60);
        }

        // Cek URL sekarang
        $currentPath = trim(service('uri')->getPath(), '/');

        // Tandai menu yang aktif
        $menus = $this->setActiveMenu($menus, $currentPath);

        // 2) Visitor summary (ambil dari visitor_summary) (cache 10s)
        $summaryCacheKey = 'visitor_summary';
        $visitorSummary = $cache->get($summaryCacheKey);
        if ($visitorSummary === null) {
            $visitorModel = new VisitorModel();
            // pastikan VisitorModel punya method getSummaryStats() yang membaca visitor_summary
            $visitorSummary = $visitorModel->getSummaryStats();
            $cache->save($summaryCacheKey, $visitorSummary, 10); // cache 10 detik
        }

        // Simpan ke $this->vars agar tersedia di semua view
        $this->vars['site_menus'] = $menus;
        $this->vars['visitor_summary'] = $visitorSummary;

        $GLOBALS['CI_VARS'] = $this->vars;
    }

    protected function setActiveMenu(array $menus, string $currentPath): array
    {
        foreach ($menus as &$menu) {
            // Normalisasi URL (hapus trailing slash)
            $menuUrl = trim($menu['menu_url'], '/');

            // Tandai active jika URL sekarang sama dengan menu_url
            $menu['active'] = ($currentPath === $menuUrl);

            // Jika menu punya children, cek mereka juga
            if (!empty($menu['children'])) {
                $menu['children'] = $this->setActiveMenu($menu['children'], $currentPath);

                // Jika salah satu child aktif, parent juga dianggap aktif
                foreach ($menu['children'] as $child) {
                    if (!empty($child['active']) && $child['active'] === true) {
                        $menu['active'] = true;
                        break;
                    }
                }
            }
        }

        return $menus;
    }
}
