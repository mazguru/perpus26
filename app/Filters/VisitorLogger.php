<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\VisitorModel;

class VisitorLogger implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jangan log jika request dari CLI atau AJAX
        if (is_cli() || $request->isAJAX()) {
            return;
        }

        $session = session();

        // Abaikan jika user sedang login sebagai admin
        if ($session->get('logged_in')) {
            return;
        }

        // Abaikan halaman admin
        $uri = service('uri')->getPath();
        if (str_starts_with($uri, 'admin')) {
            return;
        }

        $visitorModel = new VisitorModel();
        $visitorModel->logVisit();
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak digunakan
    }
}
