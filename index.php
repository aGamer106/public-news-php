<?php include_once 'components/navbar.php'?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Public News App</title>
    <link rel="stylesheet" href="design/index.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<h1>Automatic API</h1>
<?php


$url = "https://api.hnpwa.com/v0/newest/1.json";
$data = json_decode(file_get_contents($url), true);

echo '<div class="row">';
foreach ($data as $news) {
    echo '<div class="col-md-4">';
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $news["title"] . '</h5>';
    echo '<p class="card-text">' . $news["points"] . ' points by ' . $news["user"] . ' | ' . $news["comments_count"] . ' comments</p>';
    echo '<a href="' . $news["url"] . '" class="btn btn-primary">Read More</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    if ($news["id"] % 3 == 0) {
        echo '</div><div class="row">';
    }
}
echo '</div>';


?>
</body>
</html>