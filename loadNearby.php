<?php
session_start();
if ( isset($_SESSION['email'])) {

}
else {
    header('Location: index.php');
};

include_once('library/classes/Post.class.php');

try {
    $city = $_POST['city'];
    $page = Post::getByCity($_SESSION['user_id'], $city);
}

catch (Exception $e){
  
}
?>
<?php if(!empty($page)): ?>
    <?php include_once('showPosts.inc.php'); ?>
<?php else : ?>
<?php echo "none" ?>
<?php endif ?>
