<?php
session_start();
if ( isset($_SESSION['email'])) {

}
else {
    header('Location: index.php');
};

include_once('library/classes/Post.class.php');

try {
    $limit = 20;
    $offset = $_POST['offset'] * $limit;
    $page = Post::loadPosts($limit, $offset, $_SESSION['user_id']);
}

catch (Exception $e){
  
}
?>
<?php if(!empty($page)): ?>
    <?php include_once('showPosts.inc.php'); ?>
<?php else : ?>
<?php echo "none" ?>
<?php endif; ?>
