<?php

include_once 'conn/article.php';

class articleController extends Article
{
    public function getArticles()
    {
        return $this->getAllArticles();
    }

    public function uploadArticle($title, $description)
    {
        $this->uploadArticle($title, $description);
    }

    public function getArticleWithId($articleId)
    {
        return $this->getArticleById($articleId);
    }

    public function incrementArticlesReadByUserToday($userId, $articleId)
    {
        $readCount = $this->getArticlesReadCountByUserToday($userId);
        if ($readCount >= 3) {
            // User has exceeded free read limit, redirect to subscription page
            header('Location: get_subscription.php');
            exit();
        }
        $this->incrementArticlesReadByUserToday($userId, $articleId);
    }
}