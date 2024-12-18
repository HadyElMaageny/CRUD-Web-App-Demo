<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUser = $_SESSION['user']['id'];

$note = $db->query("SELECT * FROM notes where id = :id", ['id' => $_GET['id'],])->findOrFail();


authorize($note['user_id'] == $currentUser);


$db->query("DELETE FROM notes where id = :id", [
    'id' => $_POST['id']
]);

header('Location: /notes');
exit();
