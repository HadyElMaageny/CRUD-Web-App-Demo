<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query("DELETE FROM employees where id = :id", [
    'id' => $_POST['id']
]);

header('Location: /employees');
exit();
