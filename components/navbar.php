<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<nav>
    <link rel="stylesheet" href="design/navbar.css" />
    <div class="navbar-container">
        <h1 class="title">The Tavern Times</h1>
        <div class="menu">
            <?php if(isset($_SESSION['logged_on'])) { ?>
                <a href="index.php"><?php echo "Hello, ".$_SESSION['first_name']; ?></a>
                <a href="news.php">News</a>
<!--                <a href="profile.php">Profile</a>-->
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="index.php">Home</a>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php } ?>
        </div>

        <button class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
