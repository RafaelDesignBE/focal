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
    $post->removeLike($_SESSION['user_id'], $_POST['postId']);
}

catch (Exception $e){
  
}

