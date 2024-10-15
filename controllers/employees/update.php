<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$employee = $db->query("Select * from employees where id = :id", [
    'id' => $_POST['id']
])->findOrFail();

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

if (!empty($errors)) {
    return view('employees/edit.view.php', [
        'heading' => 'Edit Employee Data',
        'errors' => $errors,
        'employee' => $employee
    ]);
}

if (empty($errors)) {
    $db->query("UPDATE employees SET name = :name, gender = :gender, department = :department WHERE id = :id", [
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'department' => $_POST['department'],
        'id' => $_POST['id']
    ]);
}

header('location: /employees?page=1');
exit();