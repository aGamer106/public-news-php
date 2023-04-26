<?php
// Start the session
session_start();
// Only none logged on user can view this page
if (isset($_SESSION['logged_on'])) {
    header('location: index.php');
}
include_once 'controller/userController.php';
$userController = new userController();

// Get current user details
$result = $userController->getUserByID($_SESSION['userID']);

// Check if user details exist before setting variables
if ($result) {
    // Set user details in variables
    $fname = $result['firstName'];
    $lname = $result['lastName'];
    $email = $result['email'];
    $password = $result['password'];
} else {
    // Handle error if user details don't exist
    $_SESSION['error'] = 'User details not found';
    header('Location: index.php');
    exit();
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Update user details
    $userController->update($_POST['email'], $_POST['password']);
}

include 'components/navbar.php';

// Get the currently authenticated user's ID from the session
$user_id = $_SESSION['user_id'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="design/profile.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>My Details</h1>
    </div>
    <form method="post">
        <div class="user-details">
            <div class="input-box">
                <span class="details">
                    Email Address
                </span>
                <input type="email" placeholder="Email..." name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-box">
                <span class="details">
                    Password
                </span>
                <input type="password" placeholder="Password..." name="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="button">
                <input type="submit" value="Update Your Details" name="submit">
            </div>
        </div>
    </form>
</div>
</body>
</html>
