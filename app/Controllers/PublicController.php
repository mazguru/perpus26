<?php

namespace App\Controllers;

use App\Libraries\Token;

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
    )
    {
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
    }

}
