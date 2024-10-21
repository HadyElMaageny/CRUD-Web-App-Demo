<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$currentUser = $_SESSION['user']['id'];

$notes = $db->query('SELECT * FROM notes where user_id = :user', [
    'user' => $currentUser
])->all();


view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes,
]);