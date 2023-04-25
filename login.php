<?php

// Start the session
session_start();
// Only none logged on user can view this page
if (isset($_SESSION['logged_on'])) {
    header('location: index.php');
}
// Check if user reached by POST method
if (isset($_POST['login'])) {
    // Grab data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instantiate Class
    include_once 'login.php';
    include_once 'controller/loginController.php';
    $login = new loginController($email, $password);

    // Check login and redirect if successful
    if ($login->login()) {
        header('location: login_success.php');
        exit();
    }
}

include_once 'components/navbar.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="design/login.css">
    <title>Log In</title>
</head>
<body>

<div class="sidenav">
    <div class="login-main-text">
        <h2>Hi!<br> Good to see you again!</h2>
        <p>Proceed further by logging in</p>
    </div>
</div>
    <?php if (isset($_SESSION['error'])) {
        echo '<p class="error">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    } ?>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="Email Address" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-black" name="login">Login</button>
            </form>
        </div>
    </div>
</div>



</body>
</html>
