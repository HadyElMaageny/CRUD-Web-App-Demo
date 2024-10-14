<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$employee = $db->query("SELECT * FROM employees where id = :id", [
    'id' => $_GET['id']
    ])->findOrFail();


view('employees/edit.view.php', [
    'heading' => 'Edit Employee Data',
    'employee' => $employee,
    'errors' => []
]);