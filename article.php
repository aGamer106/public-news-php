<?php
// Check if user is logged in
//if (!isset($_SESSION['logged_on'])) {
//    header("Location: index.php");
//    exit();
//}



require_once 'conn/article.php';
require_once 'controller/articleController.php';

if (isset($_GET['articleid'])) {
    // Get the article id from the URL parameter
    $articleid = $_GET['articleid'];
    $article = new articleController();
    $articleData = $article->getArticleWithId($articleid);
}

require_once 'components/navbar.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="design/article.css">
    <title>Article</title>
</head>
<body>
<h1><?= $articleData['title'] ?></h1>
<p><?= $articleData['description'] ?></p>
<!--<p>--><?php //$articleid?><!--</p>-->
<!--<p>Written by: --><?//= $articleData['first_name'] ?><!-- --><?//= $articleData['last_name'] ?><!--</p>-->
</body>
</html>
