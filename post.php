<?php

    include_once('library/classes/Post.class.php');

    $getPost = $_GET['watch'];



    $page = Post::getPost($getPost);

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
                    <div class="post__detail__info">
                        <p class="post__detail__info--uploader"><?php echo htmlspecialchars($p['username']); ?></p>
                        <p class="post__detail__info--description"><?php echo htmlspecialchars($p['title']); ?></p>
                        <div class="feed__post__info__comments">
                            <?php
                                $comments = Post::loadAllComments($p['id']);
                                foreach ($comments as $c) {
                                    echo "<div class='feed__post__info__comments--comment'>";
                                    echo "<a href='#' class='feed__post__info__comments--commentUsername'>".htmlspecialchars($c['username'])."</a>";
                                    echo "<p>".htmlspecialchars($c['comment'])."</p>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>    
</body>
</html>