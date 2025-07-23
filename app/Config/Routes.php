<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('post/(:segment)', 'Home::detail/$1');

$routes->get('login', 'Login::index');
$routes->post('login/verify', 'Login::verify');
$routes->get('logout', 'Login::logout');

$routes->get('dashboard', 'Admin\Dashboard::index', ['filter' => 'auth']);

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('artikel', 'Admin\Artikel::index');
    $routes->get('artikel/tambah', 'Admin\Artikel::tambah');
    $routes->post('artikel/simpan', 'Admin\Artikel::simpan');
    $routes->get('artikel/edit/(:num)', 'Admin\Artikel::edit/$1');
    $routes->post('artikel/update/(:num)', 'Admin\Artikel::update/$1');
    $routes->get('artikel/delete/(:num)', 'Admin\Artikel::delete/$1');
    $routes->get('menu', 'AdminController::menu');
});
$routes->group('blog', ['filter' => 'auth'], function ($routes) {
    $routes->get('posts', 'Blog\Posts::index');
    $routes->get('posts/create', 'Blog\Posts::create');
    $routes->post('posts/save', 'Blog\Posts::save');
    $routes->get('posts/edit/(:num)', 'Blog\Posts::edit/$1');
    $routes->post('posts/update/(:num)', 'Blog\Posts::update/$1');
    $routes->post('posts/upload_image', 'Blog\Posts::imagesUploadHandler');
    $routes->get('posts/delete/(:num)', 'Blog\Posts::delete/$1');
    $routes->get('posts/getposts', 'Blog\Posts::getposts');
});



$routes->group('settings', ['filter' => 'auth'], function ($routes) {
    $groups = ['general', 'medsos', 'profil', 'writing', 'reading', 'media'];

    foreach ($groups as $group) {
        $controller = 'Settings\\' . ucfirst($group);
        $routes->get("$group", "$controller::index");
        $routes->get("$group/get_settings", "$controller::getSettings");
        $routes->post("$group/save", "$controller::save");
        $routes->post("$group/upload", "$controller::upload");
    }
});
