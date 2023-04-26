<?php
// Start the session
session_start();
// Only none logged on user can view this page
if (isset($_SESSION['logged_on'])) {
    header('location: index.php');
}
// Check if user reached by POST method
if (isset($_POST['register'])) {
    // Grab data
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Instantiate Class
    include_once 'conn/journalist.php';
    include_once 'controller/journalistController.php';
    $register = new journalistController($email, $firstName, $lastName, $password);

    // Running the code
    $register->createJournalist();

    // Redirect if successful
    header('Location: login.php');
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
    <title>Create Journalist Account</title>
    <link rel="stylesheet" href="design/register.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Create Journalist Account</h1>
    </div>
    <form method="post">
        <div class="user-details">
            <div class="input-box">
                <span class="details">
                    First Name
                </span>
                <input type="text" placeholder="First Name..." name="fname" required>
            </div>
            <div class="input-box">
                <span class="details">
                    Last Name
                </span>
                <input type="text" placeholder="Last Name..." name="lname" required>
            </div>

            <div class="input-box">
                        <span class="details">
                            Email Address
                        </span>
                <input type="email" placeholder="Email..." name="email" required>
            </div>

            <div class="input-box">
                        <span class="details">
                            Password
                        </span>
                <input type="password" placeholder="Password..." name="password" required>
            </div>
            <div class="button">
                <input type="submit" value="Register" name="register">
            </div>
        </div>
    </form>
</div>
</body>
</html>
