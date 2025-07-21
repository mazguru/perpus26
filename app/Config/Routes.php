<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Blog::index');
$routes->get('blog/(:segment)', 'Blog::detail/$1');

$routes->get('login', 'Login::index');
$routes->post('login/verify', 'Login::verify');
$routes->get('logout', 'Login::logout');

$routes->get('dashboard', 'Admin\Dashboard::index', ['filter' => 'auth']);

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Admin\Artikel::index');
    $routes->get('artikel/tambah', 'Admin\Artikel::tambah');
    $routes->post('artikel/simpan', 'Admin\Artikel::simpan');
    $routes->get('artikel/edit/(:num)', 'Admin\Artikel::edit/$1');
    $routes->post('artikel/update/(:num)', 'Admin\Artikel::update/$1');
    $routes->get('artikel/delete/(:num)', 'Admin\Artikel::delete/$1');
    $routes->get('menu', 'AdminController::menu');

});

$routes->group('settings', ['filter' => 'auth'], function($routes) {
    $routes->get('general', 'Settings\General::index');
    $routes->get('general/get_settings', 'Settings\General::getSettings');
    $routes->post('general/save', 'Settings\General::save');
    $routes->post('general/upload', 'Settings\General::upload');
});

