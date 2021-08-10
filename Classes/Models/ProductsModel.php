<?php

namespace Models;

use DB\DBConnection;

class ProductsModel
{

    public static function getAll()
    {
        $result = DBConnection::getInstance()::connect()->query("SELECT * FROM products");
        $all = [];
        while ($row = $result->fetch()) {
            $all[] = $row;
        }
        return $all;
    }

    public static function setProduct($name, $description, $price)
    {
        $sql = 'INSERT INTO products (name, description, price) VALUES(?, ?, ?)';
        $stmt = DBConnection::getInstance()->connect()->prepare($sql);
        $stmt->execute([$name, $description, $price]);
    }

}