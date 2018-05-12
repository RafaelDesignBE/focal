<?php

    include_once('library/classes/Profile.class.php');

    session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        header('Location: signup.php');
    };
    
    if ($_GET["user"] == $_SESSION['user_id']) {
        $profile = Profile::loadProfile($_SESSION['user_id']);
        $edit = 1;
    }
    else {
        $profile = Profile::loadProfile($_GET["user"]);
    }
    

?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title>Home</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    
    <?php foreach ($profile as $p): ?>
        <h1><?php echo $p['username'] ?></h1>
    <?php endforeach; ?>
    <?php if (isset($edit)): ?>
        <a href="editProfile.php">Edit Profile</a>
    <?php endif; ?>



</body>
</html>