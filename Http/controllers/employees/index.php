<?php

use Core\DatabaseProcedures;

$db = new DatabaseProcedures();

$filters = [];

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
    $currentPage = $_GET['page'] - 1;
} else {
    $currentPage = 0;
}

$limit = $_GET['pageSize'] ?? 10;


$result = $db->getPaginatedEmployees($currentPage, $filters, $limit, $sortColumn, $sortDirection);


$count = $result['count'];
$PagesCount = ceil($count / $limit);
$employees = $result['data'];





view('employees\index.view.php', [
    'heading' => "Employees List",
    'employees' => $employees,
    'pagesCount' => $PagesCount,
    'currentPage' => $currentPage + 1,
    'sortColumn' => $sortColumn,
    'sortDirection' => $sortDirection,
    'limit' => $limit,
    'filters' => $filters,
]);
