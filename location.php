<?php
include_once('userCheck.php');
include_once('library/classes/Post.class.php');
if (isset($_GET['city'])){
    $location = $_GET['city'];
    $page = Post::getByCity($_SESSION['user_id'], $location);
} else if (isset($_GET['region'])){
    $location = $_GET['region'];
    $page = Post::getByRegion($_SESSION['user_id'], $location);
} else if (isset($_GET['country'])){
    $location = $_GET['country'];
    $page = Post::getByCountry($_SESSION['user_id'], $location);
} else {
    die();
}

?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title><?php echo $location; ?></title>
</head>
<body>

    <?php include_once("nav.inc.php"); ?>
    <h1 class="location__h1"><div class="location__icon"></div><?php echo $location; ?></h1>
    <div class="feed">
        <?php if(!empty($page)): ?>  
            <?php include_once('showPosts.inc.php'); ?>
<?php else: ?>
        <p class="feed__msg">No posts found</p>
    <?php endif; ?>
    </div> 
    <script src="public_html/js/post.js"></script>
</body>
</html>