<?php

require_once 'dbh.php';

class login extends dbh
{
    protected function getUserInfoByUsername($email)
    {
        $sql = 'SELECT * FROM `user` WHERE `email` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function adminLogin($username)
    {
        $sql = 'SELECT * FROM `admin` WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function journalistLogin($username)
    {
        $sql = 'SELECT * FROM `journalist` WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
}