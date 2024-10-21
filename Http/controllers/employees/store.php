<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$errors = [];

if (!Validator::string($_POST['name'], 1, 255)) {
    $errors['name'] = 'A name is required less than 255 characters';
}

if (!Validator::string($_POST['department'], 1, 255)) {
    $errors['department'] = 'A department is required less than 255 characters';
}

if (!Validator::select($_POST['gender'], ['male', 'female', 'other'])) {
    $errors['gender'] = 'A gender is required';
}

if (!empty($errors))
{
    return view('employees/create.view.php', [
        'heading' => 'Create Employee',
        'errors' => $errors
    ]);
}

if (empty($errors)) {
    $db->query("INSERT INTO employees (name, gender, department) VALUES(:name, :gender, :department)", [
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'department' => $_POST['department']
    ]);
}

header('Location: /employees?page=1');
exit;