<?php

namespace Models;

use DB\DBConnection;

class OrderProductsModel
{

    public static function setProductOrder($order_id, $product_id, $qty)
    {
        $sql = 'INSERT INTO order_products (order_id, product_id, qty) VALUES(?, ?, ?)';
        $stmt = DBConnection::getInstance()->connect()->prepare($sql);
        $stmt->execute([$order_id, $product_id, $qty]);
    }

}