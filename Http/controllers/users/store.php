<?php

// login the user if the credentials match.

use Core\App;
use Core\Database;
use Core\Validator;

const ADMIN_ROLE_ID = 1;
const USER_ROLE_ID = 2;


$email = $_POST['email'];
$password = $_POST['password'];
$isAdmin = isset($_POST['is_admin']) ? true : false;

$db = APP::resolve(Database::class);

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

$user = $db->query("Select * from users where email = :email", [
    'email' => $email
])->find();

if ($user) {
    $errors['email'] = 'This email already exists.';
}

if (!empty($errors)) {
    return view('users/create.view.php', [
        'errors' => $errors
    ]);
}

if (empty($errors)) {
    $db->query("INSERT INTO users (email, password, role_id) VALUES (:email, :password, :role_id)", [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'role_id' => ($isAdmin ? 1 : 2)
    ]);
}
header('Location: /');
die();