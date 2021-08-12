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

    public function getOrdersData()
    {
        $resultSQL = "
            SELECT 
                orders.id as order_id,
                orders.sum,
                orders.order_date,
                orders.user_id,
                users.first_name,
                users.last_name,
                users.email,
                order_products.product_id,
                order_products.qty,
                products.name,
                products.description,
                products.price
            FROM orders
            INNER JOIN order_products
            ON order_products.order_id = orders.id
            INNER JOIN products
            ON order_products.product_id = products.id
            INNER JOIN users
            ON orders.user_id = users.id
        ";
        $resultStmt = $this->connection->prepare($resultSQL);
        $resultStmt->execute();
        $all = [];
        while ($row = $resultStmt->fetch()) {
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