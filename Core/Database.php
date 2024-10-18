<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public $params = [];
    public $pagesCount;
    public $currentPage;
    public $offset;

    public function __construct($config, $username = 'root', $password = '1234')
    {


        $sdn = "mysql:" . http_build_query($config, '', ';');
        $this->connection = new PDO($sdn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $parameters = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($parameters);

        return $this;
    }

//    public function queryPage($query, $limit, $offset)
//    {
//        $this->statement = $this->connection->prepare($query);
//        $this->statement->bindParam(':limit', $limit, PDO::PARAM_INT);
//        $this->statement->bindParam(':offset', $offset, PDO::PARAM_INT);
//        $this->statement->execute();
//        return $this;
//    }

    public function filterQuery($query, $filters)
    {
        // Step 1: Initial filtering
        if (!empty($filters['id'])) {
            $query .= " AND id LIKE :id";
            $this->params[':id'] = $filters['id'];
        }
        if (!empty($filters['name'])) {
            $query .= " AND name LIKE :name";
            $this->params[':name'] = $filters['name'];
        }
        if (!empty($filters['gender'])) {
            $query .= " AND gender LIKE :gender";
            $this->params[':gender'] = $filters['gender'];
        }
        if (!empty($filters['department'])) {
            $query .= " AND department LIKE :department";
            $this->params[':department'] = $filters['department'];
        }

        $this->statement = $this->connection->prepare($query);
//        $this->statement->execute($this->params);
        return $this;
    }

    public function paginationQuery($filters, $limit = 10)
    {
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $this->currentPage = $_GET['page'] - 1;
        } else {
            $this->currentPage = 0;
        }

        $this->offset = $this->currentPage * $limit;
        $filteredQueryString = $this->filterQuery("SELECT * FROM employees WHERE 1=1", $filters)->all();
        $count = count($filteredQueryString);
        $this->PagesCount = ceil($count / $limit);

        $filterResults = $this->statement->queryString;

        $query = "SELECT * FROM (" . $filterResults . ") AS filtered_results LIMIT :limit OFFSET :offset";
        $this->statement = $this->connection->prepare($query);
        foreach ($this->params as $key => $value) {
            $this->statement->bindValue($key, $value);
        }
        $this->statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $this->statement->bindValue(':offset', $this->offset, PDO::PARAM_INT);
        $this->statement->execute();
        return $this;
    }


    public function sortQuery($filters, $limit = 10, $sortColumn = 'id', $sortDirection = 'asc')
    {
        $sortQuery = "SELECT * FROM (SELECT * FROM employees WHERE 1=1";
        if (!empty($filters['id'])) {
            $sortQuery .= " AND id LIKE :id";
            $this->params[':id'] = $filters['id'];
        }
        if (!empty($filters['name'])) {
            $sortQuery .= " AND name LIKE :name";
            $this->params[':name'] = $filters['name'];
        }
        if (!empty($filters['gender'])) {
            $sortQuery .= " AND gender LIKE :gender";
            $this->params[':gender'] = $filters['gender'];
        }
        if (!empty($filters['department'])) {
            $sortQuery .= " AND department LIKE :department";
            $this->params[':department'] = $filters['department'];
        }
        $sortQuery .= " LIMIT :limit OFFSET :offset) AS sorted_results ORDER BY $sortColumn $sortDirection";
        $this->statement = $this->connection->prepare($sortQuery);
        foreach ($this->params as $key => $value) {
            $this->statement->bindValue($key, $value);
        }
        $this->statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $this->statement->bindValue(':offset', $this->offset, PDO::PARAM_INT);
        $this->statement->execute();
        return $this;
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();
        if (!$result) {
            abort();
        }
        return $result;
    }

    public function all()
    {
        return $this->statement->fetchAll();
    }
}