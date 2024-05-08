<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('/addTask', 'TaskController::add_task');

$routes->post('getTaskDetails', 'TaskController::view');

$routes->post('editTaskDetails', 'TaskController::edit');

$routes->post('/editTask', 'TaskController::edit_save');

$routes->post('/deleteTask', 'TaskController::delete');

//$route['add-task'] = 'TaskController/add_task';
