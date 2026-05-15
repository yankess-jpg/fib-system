<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes
$routes->get('/', 'Public\Home::index');
$routes->get('home', 'Public\Home::index');
$routes->get('recruitment', 'Public\Home::recruitment');
$routes->post('recruitment/apply', 'Public\Home::apply');
$routes->get('informant', 'Public\Home::informant');
$routes->post('informant/submit', 'Public\Home::submit');

// Auth Routes
$routes->match(['get', 'post'], 'auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');

// Dashboard Routes (Chronione)
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'authFilter']);

// Admin Routes (Tylko dla adminów)
$routes->group('admin', ['filter' => 'adminAuthFilter'], static function($routes) {
    $routes->get('members', 'Admin\Members::index');
    $routes->match(['get', 'post'], 'members/create', 'Admin\Members::create');
    $routes->get('members/view/(:num)', 'Admin\Members::view/$1');
});