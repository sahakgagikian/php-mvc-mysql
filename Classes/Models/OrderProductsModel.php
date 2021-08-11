<?php

namespace Models;

use DB\DBConnection;

class OrderProductsModel
{

    private $connection;

    public function __construct()
    {
        $this->connection = DBConnection::getInstance()->connect();
    }

    public function setProductOrder($order_id, $product_id, $qty)
    {
        $sql = 'INSERT INTO order_products (order_id, product_id, qty) VALUES(?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$order_id, $product_id, $qty]);
    }

}