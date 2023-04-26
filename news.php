<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_on'])) {
    header("Location: index.php");
    exit();
}

// Check if user is a journalist
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'journalist') {
    header("Location: index.php");
    exit();
}

require_once 'controller/articleController.php';
$article = new articleController();
$articles = $article->getArticles();

require_once 'components/navbar.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="design/news.css">
    <title>News</title>
    <!-- Import Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Import Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Read your favourite news</h1>
<div class="container">
    <div class="row">
        <?php foreach ($articles as $article): ?>
            <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article['title'] ?></h5>
                        <p class="card-text"><?= $article['description'] ?></p>
                        <p class="card-text"><small class="text-muted">Written by: <?= $article['first_name'] ?> <?= $article['last_name'] ?></small></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="write">
    <button type="button" class="btn btn-warning">Write Article</button>
</div>

</body>
</html>

