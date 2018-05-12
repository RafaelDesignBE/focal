<?php
    include_once('library/classes/User.class.php');
    session_start();
    User::removeCookie($_COOKIE["user"]);
    session_destroy();
    header('Location: index.php');
?>