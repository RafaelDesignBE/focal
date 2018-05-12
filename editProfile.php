<?php

    include_once('library/classes/Profile.class.php');

    session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        header('Location: signup.php');
    };
    
    
    

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
    
    



</body>
</html>