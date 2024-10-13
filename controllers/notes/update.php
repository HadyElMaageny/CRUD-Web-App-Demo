<?php


// find the corresponding note

// authorize that the current user can edit the note

// validate the form

// if no validation errors, update the record in the database table

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUser = 1;

$note = $db->query("SELECT * FROM notes where id = :id", ['id' => $_POST['id'],])->findOrFail();

authorize($note['user_id'] == $currentUser);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (!empty($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Create a note',
        'errors' => $errors,
        'note' => $note,
    ]);
}

if (empty($errors)) {
    $db->query("update notes set body = :body where id = :id", [
        'id' => $_POST['id'],
        'body' => $_POST['body'],
    ]);
}

header('Location: /notes');
exit();