<?php

//return [
//    '/' => 'controllers/index.php',
//    '/about' => 'controllers/about.php',
//    '/notes' => 'controllers/notes/index.php',
//    '/notes/create' => 'controllers/notes/create.php',
//    '/note' => 'controllers/notes/show.php',
//    '/contact' => 'controllers/contact.php',
//];

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php');
$router->get('/notes/create', 'controllers/notes/create.php');
$router->get('/note/edit', 'controllers/notes/edit.php');

$router->patch('/note', 'controllers/notes/update.php');

$router->delete('/note', 'controllers/notes/destroy.php');

$router->post('/notes', 'controllers/notes/store.php');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php');
$router->get('/login', 'controllers/session/create.php')->only('guest');
$router->post('/session', 'controllers/session/store.php')->only('guest');
$router->delete('/session', 'controllers/session/destroy.php')->only('auth');


$router->get('/employees', 'controllers/employees/index.php')->only('auth');
$router->get('/employees/create', 'controllers/employees/create.php');
$router->post('/employees', 'controllers/employees/store.php');
$router->get('/employee', 'controllers/employees/show.php');
$router->get('/employee/edit', 'controllers/employees/edit.php');
$router->patch('/employee', 'controllers/employees/update.php');
$router->delete('/employee', 'controllers/employees/destroy.php');

//$router->get('/admin', 'controllers/admin/create.php');

//dd($router->routes);