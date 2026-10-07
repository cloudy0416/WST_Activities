<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('/tasks', 'MainController::tasks');
$routes->get('/profile', 'MainController::profile');
$routes->get('/about', 'MainController::about');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->post('/logout', 'AuthController::logout');
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/tasks/new', 'MainController::newTask');
    $routes->post('/tasks', 'MainController::createTask');
    $routes->get('/tasks/(:num)/edit', 'MainController::editTask/$1');
    $routes->post('/tasks/(:num)', 'MainController::updateTask/$1');
    $routes->post('/tasks/(:num)/delete', 'MainController::deleteTask/$1');
});
