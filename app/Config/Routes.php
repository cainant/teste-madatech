<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('tasks', function ($routes) {
    $routes->get('/', 'Task::index');

    $routes->get('create', 'Task::create');
    $routes->post('create', 'Task::create');

    $routes->get('edit/(:num)', 'Task::edit/$1');
    $routes->post('edit/(:num)', 'Task::edit/$1');

    $routes->get('delete/(:num)', 'Task::delete/$1');
});

$routes->group('api/tasks', function ($routes) {
    $routes->get('/', 'ApiTask::index');

    $routes->post('create', 'ApiTask::create');

    $routes->put('edit/(:num)', 'ApiTask::edit/$1');

    $routes->delete('delete/(:num)', 'ApiTask::delete/$1');
});

