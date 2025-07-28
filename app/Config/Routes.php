<?php

use CodeIgniter\Router\RouteCollection;

$routes->set404Override(static function () {
    // If you want to get the URI segments.
    $segments = request()->getUri()->getSegments();

    return view('404');
});
