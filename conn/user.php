<?php

include_once 'dbh.php';

class user extends dbh
{
    public function getUserByID($userID)
    {
        $sql = 'SELECT * FROM `user` WHERE `userid` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function updateMyProfile($email)
    {
        $sql = 'UPDATE `user` SET `email` = ?, `password` = ? WHERE `userid` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $_SESSION['userID']]);
    }
}