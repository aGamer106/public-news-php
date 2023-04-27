<?php

require_once 'dbh.php';

class article extends dbh
{
    protected function getAllArticles()
    {
        $sql = 'SELECT DISTINCT a.*
            FROM `article` a 
            JOIN `journalist` j
            ORDER BY a.date DESC';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    protected function uploadArticle($title, $description)
    {
        $articleid = rand(10000000, 99999999);
        $sql = "INSERT INTO `article` (`articleid`, `date`, `description`, `status`, `title`) 
            VALUES (:articleid, NOW(), :description, 0, :title)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':articleid', $articleid);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
    }

    protected function getArticleById($articleid)
    {
        $sql = "SELECT * FROM `article` WHERE `articleid` = :articleid";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':articleid', $articleid);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    protected function incrementArticlesReadByUserToday($userId, $articleId)
    {
        $date = date('Y-m-d');
        $sql = 'INSERT INTO `article_read` (user_id, article_id, date) VALUES (?, ?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId, $articleId, $date]);
    }

    protected function getArticlesReadCountByUserToday($userId)
    {
        $date = date('Y-m-d');
        $sql = 'SELECT COUNT(*) as count FROM `article_read` WHERE user_id = ? AND date = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId, $date]);
        $result = $stmt->fetchColumn();

        return $result;
    }


}