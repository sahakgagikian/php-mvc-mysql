<?php

namespace Models;

use DB\DBConnection;

class OrdersModel
{

    private $connection;

    public function __construct()
    {
        $this->connection = DBConnection::getInstance()->connect();
    }

    public function getAll()
    {
        $result = $this->connection->query("SELECT * FROM orders");
        $all = [];
        while ($row = $result->fetch()) {
            $all[] = $row;
        }
        return $all;
    }

    public function setOrder($userId, $sum, $orderDate)
    {
        $sql = 'INSERT INTO orders (user_id, sum, order_date) VALUES(?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId, $sum, $orderDate]);
    }

}