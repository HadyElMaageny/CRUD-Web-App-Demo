<?php

// login the user if the credentials match.

use Core\Authenticator;
use Http\Forms\LoginForm;

const ADMIN_ROLE_ID = 1;
const USER_ROLE_ID = 2;


$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }
    $form->error('email', 'No matching account found for this email and password.');
}

return view('session/create.view.php', [
    'errors' => $form->errors()
]);



