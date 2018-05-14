<?php

    include_once('userCheck.php');
    include_once('library/classes/Post.class.php');

    $limit = 20;
    $pCount = 0;
    $offset = 0;
    if (isset($_GET["page"])) {
        $pCount = $_GET["page"];
        $offset = $limit * $pCount; 
    }
    
    $page = Post::loadPosts($limit, $offset, $_SESSION['user_id']);

?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title>Home</title>
</head>
<body>
    <?php 
        if(isset($_GET['upload'])){
            if( $_GET['upload'] == "complete" ) {
                echo "<div class='upload__complete'>Your post has been uploaded</div>";
            }
        }
    ?>
    <?php include_once("nav.inc.php"); ?>
    <div class="feeds">
        <div class="feeds__container">
            <div class="feeds__tab"><a href="#" id="latest"><img src="public_html/img/rec.svg" alt="">Latest</a></div> 
            <div class="feeds__tab"><a href="#" id="myfeed"><img src="public_html/img/prof.svg" alt="">My Feed</a><div class="feeds__tabs__selected"></div></div>
            <div class="feeds__tab"><a href="#" id="nearby"><img src="public_html/img/near.svg" alt="">Nearby</a></div>
        </div>
    </div>
    <input id="location" name="location">
    <div class="feed">
        <?php if(isset($page)): ?>  
          <?php include_once('showPosts.inc.php'); ?>
    
    <?php if(!empty($page)){
        echo '<form action="" method="GET">
        <button class="btn btn--secondary btn--loadmore" type="submit" value="'.($pCount+1).'" name="page">Load More</button>
    </form>';
        
    } else {
        echo '<p class="feed__msg">No posts yet, be sure to follow people!</p>';
    }
    
    ?>
        
    <?php endif; ?>
    </div>
    <script src="public_html/js/index.js"></script>
    <script src="public_html/js/post.js"></script>
</body>
</html>