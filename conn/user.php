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

    public function checkSubscriptionStatus($userid) {
        $sql = "SELECT subscription_status FROM `user` WHERE `userid` = :userid";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    protected function updateSubscription($email) {
        $sql = "UPDATE `user` SET `subscription_status` = 1 WHERE `email` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
    }



}