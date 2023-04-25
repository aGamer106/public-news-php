<?php

class dbh
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbName = 'public-news';

    protected function connect()
    {
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dns, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}