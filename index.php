<?php

session_start();
if ( isset($_SESSION['email'])) {
}
else {
	header('Location: signup.php');
};

include_once('/library/classes/Upload.class.php');

$collection = Post::getAll();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Homepage</h1>
    <a href="logout.php">Log out</a>

    <div class="feed">
        <?php foreach ($collection as $c): ?>
            <a href="details.php?watch=<?php echo $c['id']; ?>" class="collection__item" style="background-image: url(<?php echo $c["photo_url"] ?>)">
            </a>
        <?php endforeach ?> 
    </div>
    
    
</body>
</html>