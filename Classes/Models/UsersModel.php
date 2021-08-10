<?php

namespace Models;

use DB\DBConnection;

class UsersModel
{

    public static function setUser($firstName, $lastName, $email)
    {
        $sql = 'INSERT INTO users (first_name, last_name, email) VALUES(?, ?, ?)';
        $stmt = DBConnection::getInstance()->connect()->prepare($sql);
        $stmt->execute([$firstName, $lastName, $email]);
    }

}