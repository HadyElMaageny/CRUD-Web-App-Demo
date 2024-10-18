<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$filters = [];

// Apply filters if present
if (isset($_GET['filter_id']) && !empty($_GET['filter_id'])) {
    $filters['id'] = $_GET['filter_id'];
}

if (isset($_GET['filter-name']) && !empty($_GET['filter-name'])) {
    $filters['name'] = $_GET['filter-name'];
}

if (isset($_GET['filter-gender']) && !empty($_GET['filter-gender'])) {
    $filters['gender'] = $_GET['filter-gender'];
}

if (isset($_GET['filter-department']) && !empty($_GET['filter-department'])) {
    $filters['department'] = $_GET['filter-department'];
}

$paginatedQuery = $db->paginationQuery($filters);

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

if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
    $this->currentPage = $_GET['page'] - 1;
} else {
    $this->currentPage = 0;
}

$employees = $db->sortQuery($filters, 10,$sortColumn, $sortDirection)->all();

//$employees = $db->queryPage($limit, $offset, $filters, $sortColumn, $sortDirection)->all();

view('employees\index.view.php', [
    'heading' => "Employees List",
    'employees' => $employees,
    'pagesCount' => $db->PagesCount,
    'currentPage' => $db->currentPage + 1,
    'sortColumn' => $sortColumn,
    'sortDirection' => $sortDirection,
    'filters' => $filters,
]);
