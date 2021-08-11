<?php

namespace Models;

use DB\DBConnection;

class ProductsModel
{

    private $connection;

    public function __construct()
    {
        $this->connection = DBConnection::getInstance()->connect();
    }

    public function getAll()
    {
        $result = $this->connection->query("SELECT * FROM products");
        $all = [];
        while ($row = $result->fetch()) {
            $all[] = $row;
        }
        return $all;
    }

    public function setProduct($name, $description, $price)
    {
        $sql = 'INSERT INTO products (name, description, price) VALUES(?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$name, $description, $price]);
    }

}