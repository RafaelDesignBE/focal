<?php
session_start();
if ( isset($_SESSION['email'])) {

}
else {
    header('Location: index.php');
};

include_once('library/classes/Post.class.php');
try {
    $post = new Post();
    $post->likePost($_SESSION['user_id'], $_POST['postId'], $_POST['likeType']);
}

catch (Exception $e){
  
}

