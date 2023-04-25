<?php

include_once 'dbh.php';

class register extends  dbh
{
    protected function getUserInfoByUsername($email)
    {
        $sql = 'SELECT * FROM `user` WHERE `email` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function registerUser($userid, $email, $firstName, $lastName, $password)
    {
        $sql = 'INSERT INTO `user` (`userid`, `email`, `first_name`, `last_name`, `password`, `subscription_status`) VALUES (?, ?, ?, ?, ?, 0)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userid, $email, $firstName, $lastName, $password]);
    }
}