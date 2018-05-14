<?php
session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        include_once('library/classes/User.class.php');
        User::cookieCheck($_COOKIE["user"]);
        if ( isset($_SESSION['email'])) {

        } else {
            header('Location: login.php');
        }
        
    };