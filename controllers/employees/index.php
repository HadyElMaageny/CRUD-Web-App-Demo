<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$count = $db->query("SELECT count(id) FROM employees")->findOrFail()['count(id)'];


if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
    $currentPage = $_GET['page'] - 1;
}
else {
    $currentPage = 0;
}

$limit = 10;
$offset = $currentPage * $limit;
$pagesCount = ceil($count / $limit);

$employees = $db->queryPage("SELECT * FROM employees LIMIT :limit OFFSET :offset", $limit, $offset)->all();


view('employees\index.view.php', [
    'heading' => "Employees List",
    'employees' => $employees,
    'pagesCount' => $pagesCount,
    'currentPage' => $currentPage + 1,
]);