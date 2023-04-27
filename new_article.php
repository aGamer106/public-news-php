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

// Get authorid from session
//$authorid = $_SESSION['authorid'];

require_once 'conn/article.php';
require_once 'controller/articleController.php';
$articleController = new articleController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$title = $_POST['title'];
$description = $_POST['description'];

// Upload article using authorid from session
$articleController->uploadArticle($title, $description);

// Redirect to news page
header('Location: news.php');
exit();
}

include_once 'components/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Article</title>
    <link rel="stylesheet" href="design/write-article.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Write a New Article</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="new_article.php" method="post">
            <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
