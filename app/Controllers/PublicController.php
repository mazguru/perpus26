<?php

namespace App\Controllers;

class PublicController extends BaseController
{
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, 
                                    \CodeIgniter\HTTP\ResponseInterface $response, 
                                    \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();
        // Di sini tidak perlu cek login
    }
}
