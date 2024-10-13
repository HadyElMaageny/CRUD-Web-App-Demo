<?php

use Core\Database;
use Core\Validator;
use Core\App;

$email = $_POST['email'];
$password = $_POST['password'];


// validate the form inputs.

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// check if the account already exists
$db = APP::resolve(Database::class);

$user = $db->query("Select * from users where email = :email", [
    'email' => $email
])->find();
// If yes, redirect to o login page.
if ($user) {
    header('Location: /');
    exit();
} // If not, save one to the database, and then log the user in, and redirect.
else {
    $db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
        'email' => $email,
        'password' => $password
    ]);

    $_SESSION['user'] = [
        'email'=> $email,
    ];

    header('Location: /');
    exit();
}