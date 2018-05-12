<?php
    session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        header('Location: index.php');
    };

    include_once('library/classes/Post.class.php');

    $getPost = $_GET['watch'];

    $page = Post::getPost($_SESSION['user_id'] ,$getPost);

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

    <div class="post">
        <?php if(isset($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="post__detail">
                    <img class="post__detail__image" src="<?php echo $p["photo_url"] ?>" alt="">    
                </div>
                <div class="post__detail__info">
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
                    <p class="post__detail__info--uploader"><?php echo htmlspecialchars($p['username']); ?></p>
                    <p class="post__detail__info--description"><?php echo htmlspecialchars($p['title']); ?></p>
                    <p class="feed__post__info--uploadtime"><?php echo Post::time_elapsed_string($p['datetime']); ?></p>
                        <div class="feed__post__info--reactions">
                            <div class="feed__post__info--likes likes-0"><button class="<?php if( $p['liketype'] === "0" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="0">Like</button><div class="like--count"><?php echo substr_count($p['likes'],"0"); ?></div></div>
                            <div class="feed__post__info--likes likes-1"><button class="<?php if( $p['liketype'] === "1" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="1">Bump</button><div class="like--count"><?php echo substr_count($p['likes'],"1"); ?></div></div>
                            <div class="feed__post__info--likes likes-2"><button class="<?php if( $p['liketype'] === "2" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="2">Lol</button><div class="like--count"><?php echo substr_count($p['likes'],"2"); ?></div></div>
                        </div>
                        <div class="feed__post__info__comments commments--all">
                        <?php
                            $comments = Post::loadAllComments($p['id']);
                            foreach ($comments as $c) {
                                echo "<div class='feed__post__info__comments--comment'>";
                                echo "<a href='profile.php?user=".$c['id']."' class='feed__post__info__comments--commentUsername'>".htmlspecialchars($c['username'])."</a>";
                                echo "<p>".htmlspecialchars($c['comment'])."</p>";
                                echo "</div>";
                            }
                        ?>
                        </div>
                        <div class="flexspace"></div>
                        <div class="feed__post__info__add-comment">
                            <textarea class="feed__post__info__add-comment-area" data-post="<?php echo  $p['id']; ?>" data-post="<?php echo  $p['id']; ?>" rows="1" placeholder="Add a comment..."></textarea>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="public_html/js/post.js"></script>
</body>
</html>