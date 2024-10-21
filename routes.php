<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php')->only('auth');
$router->get('/notes/create', 'notes/create.php')->only('auth');
$router->get('/note/edit', 'notes/edit.php')->only('auth');
$router->patch('/note', 'notes/update.php');
$router->delete('/note', 'notes/destroy.php');
$router->post('/notes', 'notes/store.php');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');
$router->get('/session', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');

$router->delete('/session', 'session/destroy.php')->only('auth');


$router->get('/employees', 'employees/index.php')->only('admin');
$router->get('/employees/create', 'employees/create.php')->only('admin');
$router->post('/employees', 'employees/store.php')->only('admin');
$router->get('/employee', 'employees/show.php')->only('admin');
$router->get('/employee/edit', 'employees/edit.php')->only('admin');
$router->patch('/employee', 'employees/update.php')->only('admin');
$router->delete('/employee', 'employees/destroy.php')->only('admin');
$router->post('/employees/search', 'employees/search.php')->only('admin');

$router->get('/users/create', 'users/create.php')->only('admin');
$router->post('/users', 'users/store.php')->only('admin');


//dd($router->routes);