<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUser = $_SESSION['user']['id'];

$note = $db->query("SELECT * FROM notes where id = :id", ['id' => $_GET['id'],])->findOrFail();

authorize($note['user_id'] == $currentUser);

view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note,
]);