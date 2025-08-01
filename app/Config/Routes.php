<?php

use App\Controllers\Categories;
use CodeIgniter\Router\RouteCollection;

$routes->set404Override(static function () {
    // If you want to get the URI segments.
    $segments = request()->getUri()->getSegments();

    return view('404');
});

$routes->get('kategori/(:segment)', 'Categories::index/$1');
