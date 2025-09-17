<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Session instance
     *
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * List of helpers that will be autoloaded
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Initialize controller
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Jangan edit baris ini
        parent::initController($request, $response, $logger);

        // Set default timezone
        date_default_timezone_set(session('timezone') ?: 'Asia/Jakarta');

        // Start session
        $this->session = \Config\Services::session();
    }
}
