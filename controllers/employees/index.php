<?php

use Core\App;
use Core\Database;

//dd($_GET);
$filters = [];

if (isset($_GET['id'])) {
    $filters[] = "id LIKE :id";
}
if (isset($_GET['name'])) {
    $filters[] = "name LIKE :name";
}
if (isset($_GET['gender'])) {
    $filters[] = "gender LIKE :gender";
}
if (isset($_GET['department'])) {
    $filters[] = "department LIKE :department";
}

$filterQuery = implode(' AND ', $filters);
$query = "SELECT * FROM employees";

if (!empty($filterQuery)) {
    $query .= " WHERE " . $filterQuery;
}
//dd($query);



$db = App::resolve(Database::class);
$sortColumn = $_GET['sort'] ?? 'id';
$sortDirection = $_GET['direction'] ?? 'asc';

$allowedColumns = ['id', 'name', 'gender', 'department'];
if (!in_array($sortColumn, $allowedColumns)) {
    $sortColumn = 'id';
}

$allowedDirections = ['asc', 'desc'];
if (!in_array($sortDirection, $allowedDirections)) {
    $sortDirection = 'asc'; // Fallback to 'asc' if invalid direction
}

$count = $db->query("SELECT count(id) FROM employees")->findOrFail()['count(id)'];


if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
    $currentPage = $_GET['page'] - 1;
} else {
    $currentPage = 0;
}

$limit = 10;
$offset = $currentPage * $limit;
$pagesCount = ceil($count / $limit);

$employees = $db->queryPage("SELECT * FROM (SELECT * FROM employees LIMIT :limit OFFSET :offset) AS limited_results ORDER BY $sortColumn $sortDirection", $limit, $offset)->all();



view('employees\index.view.php', [
    'heading' => "Employees List",
    'employees' => $employees,
    'pagesCount' => $pagesCount,
    'currentPage' => $currentPage + 1,
    'sortColumn' => $sortColumn,
    'sortDirection' => $sortDirection,
]);