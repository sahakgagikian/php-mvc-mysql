<?php

namespace Models;

use DB\DBConnection;

class UsersModel
{

    private $connection;

    public function __construct()
    {
        $this->connection = DBConnection::getInstance()->connect();
    }

    public function setUser($firstName, $lastName, $email)
    {
        $sql = 'INSERT INTO users (first_name, last_name, email) VALUES(?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$firstName, $lastName, $email]);
    }

}