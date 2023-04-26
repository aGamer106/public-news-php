<?php
include_once 'dbh.php';

class journalist extends dbh
{
    protected function getJournalistInfoByUsername($email)
    {
        $sql = 'SELECT * FROM `journalist` WHERE `email` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function registerJournalist($authorid, $email, $firstName, $lastName, $password)
    {
        $sql = 'INSERT INTO `journalist` (`authorid`, `email`, `first_name`, `last_name`, `password`, `no_of_articles`) VALUES (?, ?, ?, ?, ?, 0)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$authorid, $email, $firstName, $lastName, $password]);
    }
}