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

    <div class="feed">
    <?php if(isset($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="post__detail">
                    <img class="post__detail__image" src="<?php echo $p["photo_url"] ?>" alt="">
                        <p class="feed__post__info--uploadtime"><?php echo Post::time_elapsed_string($p['datetime']); ?></p>
                        <div class="feed__post__info--likes likes-0"><button class="<?php if( $p['liketype'] === "0" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="0">Like</button><div class="like--count"><?php echo substr_count($p['likes'],"0"); ?></div></div>
                        <div class="feed__post__info--likes likes-1"><button class="<?php if( $p['liketype'] === "1" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="1">Bump</button><div class="like--count"><?php echo substr_count($p['likes'],"1"); ?></div></div>
                        <div class="feed__post__info--likes likes-2"><button class="<?php if( $p['liketype'] === "2" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="2">Lol</button><div class="like--count"><?php echo substr_count($p['likes'],"2"); ?></div></div>
                </div>
                
            <?php endforeach ?>
    <?php endif; ?>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="public_html/js/like.js"></script>
</body>
</html>