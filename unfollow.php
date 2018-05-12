<?php
session_start();
if ( isset($_SESSION['email'])) {

}
else {
    header('Location: index.php');
};

include_once('library/classes/User.class.php');
try {
    $user = new User();
    $user->unfollowUser($_POST['userId'], $_SESSION['user_id']);    
}

catch (Exception $e){
  
}

