<?php

require_once 'dbh.php';

class login extends dbh
{
    protected function getUserInfoByUsername($email)
    {
        // Check for user in `user` table
        $sql = 'SELECT first_name, email, password, "user" as user_type FROM `user` WHERE `email` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        // If user not found in `user` table, check for user in `journalist` table
        if (!$result) {
            $sql = 'SELECT first_name, email, password, "journalist" as user_type FROM `journalist` WHERE `email` = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();
        }

        // If user not found in `journalist` table, check for user in `admin` table
        if (!$result) {
            $sql = 'SELECT first_name, email, password, "admin" as user_type FROM `admin` WHERE `email` = ?';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();
        }

        return $result;
    }
}