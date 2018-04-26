<?php

    include_once('library/classes/Post.class.php');

    session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        header('Location: signup.php');
    };

    if (isset($_GET["page"])) {
        $amountPages = $_GET["page"] + 1;
        $loadPosts = $amountPages*4;
        $page = Post::loadPosts($loadPosts, $_SESSION['user_id']);
        if (count(Post::loadPosts($loadPosts + 1, $_SESSION['user_id'])) <= count($page)) {
            $hideMore = 1;
        }
        
    }
    else {
        if (empty(Post::loadPosts(1, $_SESSION['user_id']))) {
            $empty = 1;
        } else {
            $page = Post::loadPosts(4, $_SESSION['user_id']);
            if (count(Post::loadPosts(5, $_SESSION['user_id'])) <= count($page)) {
                $hideMore = 1;
                
            }
        }

        $amountPages = 1;
    }

?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title>Home</title>
</head>
<body>

    <?php include_once("nav.inc.php"); ?>

    <div class="feed">
        <?php if(isset($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="feed__post">
                    <a href="post.php?watch=<?php echo $p['id']; ?>" class="feed__post--image" style="background-image: url(<?php echo $p["photo_url"] ?>)">
                    </a>
                    <div class="feed__post__info">
                        <p class="feed__post__info--uploader">Jo Smets</p>
                        <p class="feed__post__info--description"><?php echo $p['title']; ?></p>
                        <p class="feed__post__info--comments">Great pic</p>
                    </div>
                </div>
                
            <?php endforeach ?>
          
    </div>
    <?php if (!isset($hideMore)): ?>
        <form action='' method='GET'>
            <button class="btn btn--secondary btn--loadmore" type="submit" value="<?php echo $amountPages ?>" name="page">Load More</button>
        </form>
    <?php else: ?>
        <p class="feed__msg">End of feed</p>
    <?php endif; ?>
    <?php elseif (isset($empty)): ?>
        <p class="feed__msg">No posts yet, be sure to follow people!</p>
    <?php endif; ?>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="public_html/js/index.js"></script>
    
</body>
</html>