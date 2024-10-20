<?php

namespace Core;

use mysqli;

class DatabaseProcedures
{
    public $mysqli;
    public $stmt;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $config = require base_path('config.php');
        $this->mysqli = new mysqli($config['mysqliConfig']['host'], $config['mysqliConfig']['username'], $config['mysqliConfig']['password'], $config['mysqliConfig']['dbname']);
    }

    public function createProcedure($procedureName, $procedureQuery)
    {
        $this->mysqli->query("DROP PROCEDURE IF EXISTS {$procedureName}");
        $this->mysqli->query($procedureQuery);
    }

    public function getPaginatedEmployees($currentPage, $filters, $limit, $sortColumn = 'id', $sortDirection = 'asc')
    {

        $offset = $currentPage * $limit;

        $id = isset($filters['id']) ? $filters['id'] : null;
        $name = isset($filters['name']) ? $filters['name'] : null;
        $gender = isset($filters['gender']) ? $filters['gender'] : null;
        $department = isset($filters['department']) ? $filters['department'] : null;
        $this->stmt = $this->mysqli->prepare("CALL p(?, ?, ?, ?, ?, ?, ?, ?)");
        $this->stmt->bind_param("isssisss", $id, $name, $gender, $department, $limit, $offset, $sortColumn, $sortDirection);
        $this->stmt->execute();

        $result = $this->stmt->get_result();
        $count  = $result->fetch_row()[0];
        $result->free();
        if ($this->stmt->next_result())
        {
            $result = $this->stmt->get_result();
            $data  = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }

        $this->stmt->close();
        $this->mysqli->close();

        return [
            'count' => $count,
            'data' => $data
        ];
    }
}