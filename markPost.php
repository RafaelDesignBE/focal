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
    $m = $post->getMark($_POST['postId']);
    if(!empty($m['marked'])){
        $check = explode(",", $m['marked']);
        if (in_array($_SESSION['user_id'], $check)){
        } else {
            if(count($check) < 2){
                array_push($check, $_SESSION['user_id']);
                $post->setMark(implode(",", $check), $_POST['postId']);
            } else {
                $post->deletePost($_POST['postId']);
            }
        }
    }
    
}

catch (Exception $e){
  
}

