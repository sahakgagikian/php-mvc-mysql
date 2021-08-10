<?php

namespace Models;

use DB\DBConnection;

class OrdersModel
{

    public static function getAll()
    {
        $result = DBConnection::getInstance()::connect()->query("SELECT * FROM orders");
        $all = [];
        while ($row = $result->fetch()) {
            $all[] = $row;
        }
        return $all;
    }

    public static function setOrder($userId, $sum, $orderDate)
    {
        $sql = 'INSERT INTO orders (user_id, sum, order_date) VALUES(?, ?, ?)';
        $stmt = DBConnection::getInstance()->connect()->prepare($sql);
        $stmt->execute([$userId, $sum, $orderDate]);
    }

}