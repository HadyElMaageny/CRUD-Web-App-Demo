<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$employees  = $db->query("Select * from employees")->all();


view('employees\index.view.php', [
    'heading' => "Employees List",
    'employees' => $employees,
]);