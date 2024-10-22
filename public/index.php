<?php

session_start();

use Core\Router;
use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    // Core\Database
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

$router = new Router();

require base_path('bootstrap.php');

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $validationException) {
    Session::flash('errors',$validationException->getErrors());
    Session::flash('old', [
        'email' => $validationException->getOld()['email'],
    ]);
    return redirect($router->previousUrl());
}

Session::unflash();
