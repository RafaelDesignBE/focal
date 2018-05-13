<?php

    include_once('library/classes/User.class.php');
    include_once('library/classes/Post.class.php');

    session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        header('Location: signup.php');
    };
    
    if ($_GET["user"] == $_SESSION['user_id']) {
        $profile = User::loadProfile($_SESSION['user_id']);
        $edit = 1;
    }
    else {
        $profile = User::loadProfile($_GET["user"]);
    }

    if (User::checkFollow($_GET["user"], $_SESSION['user_id']) == 0) {
        $btnClass = "btn--follow";
        $btnText = "Follow";
    }
    else {
        $btnClass = "btn--following";
        $btnText = "Unfollow";
    }

    $page = Post::loadPostsProfile($_GET["user"], $_SESSION['user_id']);
    

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
    
    <?php foreach ($profile as $p): ?>
        <div class="profile__user">
            <div class="profile__user--top">
                <h1><?php echo $p['username'] ?></h1>
                <?php if (isset($edit)): ?>
                    <div class="profile__user--btns">
                        <a class="btn btn--edit" href="editProfile.php">Edit Profile</a>
                        <a class="btn btn--secondary btn--logout" href="logout.php">Log out</a>
                    </div>
                <?php else: ?>
                    <div class="btn <?php echo $btnClass; ?>" data-post="<?php echo  $_GET["user"]; ?>"><?php echo $btnText; ?></div>
                <?php endif; ?>
            </div>
            <div class="profile__user--description">
                <p><?php echo $p['profileText'] ?></p>
            </div>                      
        </div>        
    <?php endforeach; ?>

    <div class="feed">
        <?php if(isset($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="feed__post">
                    <a href="post.php?watch=<?php echo $p['id']; ?>" class="feed__post--image">
                        <figure class="<?php echo $p["photofilter"]; ?>">
                            <img src="<?php echo $p["thmb_url"] ?>">
                        </figure>  
                    </a>
                    <div class="feed__post__info">
                        <div class="feed__post__info--more">
                        <button class="feed__post__info--more--button">More</button>
                            <div class="feed__post__info--more--menu">
                                <div class="flexspace"></div>
                                <div class="feed__post__info--option option__mark" data-post="<?php echo  $p['id']; ?>">Mark as inappropriate</div>
                                <?php if ($_SESSION['user_id'] == Post::getUploader($p['id'])):  ?>
                                    <div class="feed__post__info--option option__delete" data-post="<?php echo  $p['id']; ?>">Delete post</div>
                                <?php endif; ?>
                                <div class="flexspace"></div>
                            </div>
                        </div>
                        <p class="feed__post__info--uploader"><?php echo htmlspecialchars($p['username']); ?></p>
                        <p class="feed__post__info--description"><?php echo htmlspecialchars($p['title']); ?></p>
                        <p class="feed__post__info--uploadtime"><?php echo Post::time_elapsed_string($p['datetime']); ?></p>
                        <?php if(!empty($p['city'])): ?>
                        <div class="post__info--location">
                            <div class="location__icon"></div>
                            <p>
                                <a href="location.php?city=<?php echo htmlspecialchars($p['city']); ?>"><?php echo htmlspecialchars($p['city']); ?></a>, 
                                <a href="location.php?region=<?php echo htmlspecialchars($p['region']); ?>"><?php echo htmlspecialchars($p['region']); ?></a>, 
                                <a href="location.php?country=<?php echo htmlspecialchars($p['country']); ?>"><?php echo htmlspecialchars($p['country']); ?></a>
                            </p>
                        </div>
                        <?php endif; ?>
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
    <?php else: ?>
        <p class="feed__msg">This user has nothing posted yet!</p>
    <?php endif; ?>
    <script src="public_html/js/post.js"></script>
    <script src="public_html/js/follow.js"></script>
</body>
</html>