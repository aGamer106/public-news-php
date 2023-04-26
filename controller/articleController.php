<?php

include_once 'conn/article.php';

class articleController extends article
{

    private $article;

    public function __construct() {
        $this->article = new article();
    }

    public function getArticles() {
        return $this->article->getAllArticles();
    }

    public function uploadArticle($title, $description, $authorid) {
        $this->article->uploadArticle($title, $description, $authorid);
    }



}