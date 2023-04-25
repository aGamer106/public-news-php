<nav>
    <link rel="stylesheet" href="design/navbar.css" />
    <div class="navbar-container">
        <h1 class="title">The Tavern Times</h1>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="news.php">News</a>
            <?php if(isset($_SESSION['logged_on'])) { ?>
                <a href="#"><?php echo "Hello, ".$_SESSION['first_name']; ?></a>
            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
            <a href="register.php">Register</a>
        </div>

        <button class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
