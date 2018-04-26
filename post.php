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

    <div class="feed">
    <?php if(isset($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="post__detail">
                    <img class="post__detail__image" src="<?php echo $p["photo_url"] ?>" alt="">
                </div>
                
            <?php endforeach ?>
    <?php endif; ?>
        </div>
    </div>
    </div>
    
</body>
</html>