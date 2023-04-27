<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_on'])) {
    header("Location: index.php");
    exit();
}

$userid = $_SESSION['userid'];
$user_type = $_SESSION['user_type'];

require_once 'conn/article.php';
require_once 'controller/articleController.php';
$article = new articleController();
$articles = $article->getArticles();

require_once 'conn/user.php';
require_once 'controller/userController.php';
$user = new userController();
$userData = $user->getUserByID($userid);
$subscriptionStatus = $user->checkSubscriptionStatus($userid);

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
<?php if ($subscriptionStatus['subscription_status'] == 0 && $user_type != 'journalist'): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        You do not have a subscription to access all articles. Please <a href="pay.php">purchase</a> a subscription to have full access.
        <!--        <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
        <!--            <span aria-hidden="true">&times;</span>-->
        <!--        </button>-->
    </div>
<?php else: ?>
    <h1>Read your favourite news</h1>
    <div class="container">
        <div class="row">
            <?php foreach ($articles as $article): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 my-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="article.php?articleid=<?= $article['articleid'] ?>"><?= $article['title'] ?></a></h5>
                            <p class="card-text"><?= $article['description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
</body>
</html>
