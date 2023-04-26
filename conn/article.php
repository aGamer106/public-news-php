<?php

require_once 'dbh.php';

class article extends dbh
{
    protected function getAllArticles()
    {
        $sql = 'SELECT a.*, j.first_name, j.last_name FROM `article` a JOIN `journalist` j ON a.authorid = j.authorid';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    protected function uploadArticle($title, $description, $authorid)
    {
        $sql = "INSERT INTO `article` (`articleid`, `date`, `description`, `status`, `title`, `authorid`) 
                VALUES (:articleid, NOW(), :description, 0, :title, :authorid)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':articleid', $articleid);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':authorid', $authorid);
        $articleid = rand(10000000, 99999999);
        $stmt->execute();
    }

}