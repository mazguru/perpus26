<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('profil/(:segment)', 'Posts::getPage/$1');
$routes->get('post/(:segment)', 'Posts::getPage/$1');
$routes->get('menu_public', 'PublicController::getMenu');

$routes->get('login', 'Login::index');
$routes->post('login/verify', 'Login::verify');
$routes->get('logout', 'Login::logout');

$routes->get('dashboard', 'Admin\Dashboard::index', ['filter' => 'auth']);

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $groups = ['users', 'medsos', 'profil', 'writing', 'reading', 'media', 'menu'];

    foreach ($groups as $group) {
        $controller = 'Admin\\' . ucfirst($group);
        $routes->get("$group", "$controller::index");
        $routes->get("$group/list", "$controller::list");
        $routes->get("$group/create", "$controller::create");
        $routes->get("$group/edit/(:num)", "$controller::edit/$1");
        $routes->get("$group/delete/(:num)", "$controller::delete/$1");
        $routes->post("$group/save", "$controller::save");
        $routes->post("$group/upload", "$controller::upload");
    }

    $routes->get('menu_admin', 'AdminController::menu');
});
$routes->group('blog', ['filter' => 'auth'], function ($routes) {
    $groups = ['posts', 'page'];
    foreach ($groups as $group) {
        $controller = 'Blog\\' . ucfirst($group);
        $routes->get("$group", "$controller::index");
        $routes->get("$group/create", "$controller::create");
        $routes->post("$group/store", "$controller::store");
        $routes->get("$group/edit/(:num)", "$controller::edit/$1");
        $routes->get("$group/getpostid/(:num)", "$controller::getPostById/$1");
        $routes->post("$group/upload_image", "$controller::imagesUploadHandler");
        $routes->get("$group/delete/(:num)", "$controller::delete/$1");
        $routes->get("$group/getposts", "$controller::getposts");
        $routes->get("$group/getcategories", "$controller::getcategories");
    }
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
