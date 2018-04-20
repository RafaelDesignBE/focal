<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    session_start();
    if ( isset($_SESSION['email'])) {
    }
    else {
        header('Location: signup.php');
    };

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title>Home</title>
</head>
<body>
    <h1>Homepage</h1>
    <a href="logout.php">Log out</a>

    <div class="feed">        
        

    </div>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="public_html/js/index.js"></script>
    
</body>
</html>