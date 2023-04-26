<?php
echo 'logged in!';
header("refresh:3;url=index.php");
?>
<script>
    setTimeout(function() {
        window.location.href = "index.php";
    }, 3000);
</script>
