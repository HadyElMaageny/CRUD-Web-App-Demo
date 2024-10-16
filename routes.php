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
$router->get('/note', 'controllers/notes/show.php')->only('auth');
$router->get('/notes/create', 'controllers/notes/create.php')->only('auth');
$router->get('/note/edit', 'controllers/notes/edit.php')->only('auth');
$router->patch('/note', 'controllers/notes/update.php');
$router->delete('/note', 'controllers/notes/destroy.php');
$router->post('/notes', 'controllers/notes/store.php');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php')->only('guest');
$router->get('/session', 'controllers/session/create.php')->only('guest');
$router->post('/session', 'controllers/session/store.php')->only('guest');

$router->delete('/session', 'controllers/session/destroy.php')->only('auth');


$router->get('/employees', 'controllers/employees/index.php')->only('admin');
$router->get('/employees/create', 'controllers/employees/create.php')->only('admin');
$router->post('/employees', 'controllers/employees/store.php')->only('admin');
$router->get('/employee', 'controllers/employees/show.php')->only('admin');
$router->get('/employee/edit', 'controllers/employees/edit.php')->only('admin');
$router->patch('/employee', 'controllers/employees/update.php')->only('admin');
$router->delete('/employee', 'controllers/employees/destroy.php')->only('admin');
$router->post('/employees/search', 'controllers/employees/search.php')->only('admin');

$router->get('/users/create', 'controllers/users/create.php')->only('admin');
$router->post('/users', 'controllers/users/store.php')->only('admin');


//dd($router->routes);