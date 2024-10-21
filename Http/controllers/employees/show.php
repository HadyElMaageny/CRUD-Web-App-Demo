<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$employee = $db->query("select * from employees where id = :id", [
    'id'=> $_GET['id']
])->findOrFail();

view('employees/show.view.php', [
    'heading' => 'Employees',
    'employee' => $employee
]);