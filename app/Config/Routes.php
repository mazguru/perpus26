<?php

use CodeIgniter\Router\RouteCollection;
use Config\Services;

// Wajib: buat instance RouteCollection
$routes = Services::routes();

// Nonaktifkan legacy auto routing (TIDAK aman)
$routes->setAutoRoute(false);

// Aktifkan Improved Auto Routing (LEBIH aman)
$routes->setAutoRoute(true);

// Set default controller & namespace
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');

// Custom 404
$routes->set404Override(static function () {
    return view('layouts/master', ['content' => 'layouts/partials/404']); // app/Views/404.php
});

// --- RUTE MANUAL ---

// Halaman Umum
$routes->get('/', 'Home::index');
$routes->get('hubungi-kami', 'Home::contact');
$routes->get('galeri-foto', 'Home::galeriPhotos');
$routes->get('galeri-video', 'Home::galeriVideos');
$routes->get('menupublic', 'Home::menus');
$routes->get('feed', 'Publik\Feed::index');
$routes->get('search', 'Publik\Search::index');

// Login
$routes->get('login', 'Login::index');
$routes->post('login/verify', 'Login::verify');
$routes->get('logout', 'Login::logout');

// Komentar
$routes->group('comment', ['namespace' => 'App\Controllers\Publik'], function ($routes) {
    $routes->get('list/(:num)', 'Comment::list/$1');
    $routes->get('replies/(:num)', 'Comment::replies/$1');
    $routes->post('save', 'Comment::save');
    $routes->post('sendmessage', 'Comment::sendmessage');
});

// Postingan & Konten
$routes->get('post/(:segment)', 'Publik\Readmore::article/$1');
$routes->get('page/(:segment)', 'Publik\Readmore::page/$1');
$routes->get('video/(:segment)', 'Publik\Readmore::videos/$1');
$routes->get('categories/(:segment)', 'Publik\Categories::index/$1');
$routes->get('kategori/(:segment)', 'Publik\Categories::index/$1');
$routes->get('tags/(:segment)', 'Publik\Tags::index/$1');
