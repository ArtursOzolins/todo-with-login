<?php

require_once 'vendor/autoload.php';

session_start();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controllers\UsersController@index');
    $r->addRoute('POST', '/', 'App\Controllers\UsersController@register');
    $r->addRoute('GET', '/register', 'App\Controllers\UsersController@registrationForm');
    $r->addRoute('GET', '/login', 'App\Controllers\UsersController@loginForm');
    $r->addRoute('POST', '/login', 'App\Controllers\UsersController@loginValidate');

    $r->addRoute('GET', '/tasks', 'App\Controllers\AssignmentController@index');
    $r->addRoute('GET', '/tasks/add', 'App\Controllers\AssignmentController@add');
    $r->addRoute('POST', '/tasks', 'App\Controllers\AssignmentController@storeNew');
    $r->addRoute('POST', '/tasks/delete/{id}', 'App\Controllers\AssignmentController@delete');
    $r->addRoute('POST', '/tasks/edit/{id}', 'App\Controllers\AssignmentController@editTask');
    $r->addRoute('POST', '/tasks/{id}', 'App\Controllers\AssignmentController@storeEdited');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        var_dump('NOT FOUND');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump('NOT ALLOWED');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode('@', $handler);
        $controller = new $controller();
        $controller->$method($vars['id']);
        break;
}