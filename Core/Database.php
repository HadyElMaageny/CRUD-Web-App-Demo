<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

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

    public function queryPage($query, $limit, $offset)
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $this->statement->bindParam(':offset', $offset, PDO::PARAM_INT);
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