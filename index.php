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
    <?php 
        if(isset($_GET['upload'])){
            if( $_GET['upload'] == "complete" ) {
                echo "<div class='upload__complete'>Your post has been uploaded</div>";
            }
        }
    ?>
    <?php include_once("nav.inc.php"); ?>
    <div class="feed">
        <?php if(isset($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="feed__post">
                    <a href="post.php?watch=<?php echo $p['id']; ?>" class="feed__post--image"><img src="<?php echo $p["thmb_url"] ?>">
                    </a>
                    <div class="feed__post__info">
                        <div class="feed__post__info--more">
                        <button class="feed__post__info--more--button">More</button>
                            <div class="feed__post__info--more--menu">
                                <div class="flexspace"></div>
                                <div class="feed__post__info--option option__mark" data-post="<?php echo  $p['id']; ?>">Mark as inappropriate</div>
                                <div class="feed__post__info--option option__delete">Delete post</div>
                                <div class="flexspace"></div>
                            </div>
                        </div>
                        <p class="feed__post__info--uploader"><?php echo htmlspecialchars($p['username']); ?></p>
                        <p class="feed__post__info--description"><?php echo htmlspecialchars($p['title']); ?></p>
                        <p class="feed__post__info--uploadtime"><?php echo Post::time_elapsed_string($p['datetime']); ?></p>
                        <div class="post__info--location">
                            <div class="location__icon"></div>
                            <p>
                                <a href="location.php?city=<?php echo htmlspecialchars($p['city']); ?>"><?php echo htmlspecialchars($p['city']); ?></a>, 
                                <a href="location.php?region=<?php echo htmlspecialchars($p['region']); ?>"><?php echo htmlspecialchars($p['region']); ?></a>, 
                                <a href="location.php?country=<?php echo htmlspecialchars($p['country']); ?>"><?php echo htmlspecialchars($p['country']); ?></a>
                            </p>
                        </div>
                        <div class="feed__post__info--reactions">
                            <div class="feed__post__info--likes likes-0"><button class="<?php if( $p['liketype'] === "0" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="0">Like</button><div class="like--count"><?php echo substr_count($p['likes'],"0"); ?></div></div>
                            <div class="feed__post__info--likes likes-1"><button class="<?php if( $p['liketype'] === "1" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="1">Bump</button><div class="like--count"><?php echo substr_count($p['likes'],"1"); ?></div></div>
                            <div class="feed__post__info--likes likes-2"><button class="<?php if( $p['liketype'] === "2" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="2">Lol</button><div class="like--count"><?php echo substr_count($p['likes'],"2"); ?></div></div>
                        </div>
                        <div class="feed__post__info__comments">
                            <?php 
                                $comments = Post::loadComments($p['id']);
                                foreach ($comments as $c) {
                                    echo "<div class='feed__post__info__comments--comment'>";
                                    echo "<a href='profile.php?user=".$c['id']."' class='feed__post__info__comments--commentUsername'>".htmlspecialchars($c['username'])."</a>";
                                    echo "<p>".htmlspecialchars($c['comment'])."</p>";
                                    echo "</div>";
                                } ?>
            
                        </div>
                        <?php
                                $countComments = Post::countComments($p['id']);
                                if ($countComments > 4) {
                                    echo "<a class='feed__post__info__comments--moreComments' href='post.php?watch=".$p['id']."'>See all <span class='count'>" . $countComments. "</span> comments</a>";
                                }
                            ?>
                        <div class="flexspace"></div>
                        <div class="feed__post__info__add-comment">
                            <textarea class="feed__post__info__add-comment-area" data-post="<?php echo  $p['id']; ?>" data-post="<?php echo  $p['id']; ?>" rows="1" placeholder="Add a comment..."></textarea>
                        </div>
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
    <script src="public_html/js/post.js"></script>
</body>
</html>