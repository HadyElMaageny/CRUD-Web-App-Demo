<?php

// login the user if the credentials match.

use Core\App;
use Core\Database;
use Core\Validator;

const ADMIN_ROLE_ID = 1;
const USER_ROLE_ID = 2;


$email = $_POST['email'];
$password = $_POST['password'];


$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

if (!empty($errors)) {
    return view('session/create.view.php', [
        'errors' => $errors
    ]);
}

$db = APP::resolve(Database::class);

$user = $db->query("SELECT * FROM users WHERE email = :email", [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login($user);
        header('location: /');
        exit();
    }
}

view('session/create.view.php',[
    'errors' => [
        'email' => 'No matching account found for this email and password.',
    ]
]);