<?php
    session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        header('Location: index.php');
    };

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    include_once('library/classes/Post.class.php');

    $search = $_GET['q'];
    $search = strtolower($search);
    $search = htmlspecialchars($search);
    $searchArray = explode(",", $search);

    $all = Post::getAll($_SESSION['user_id']);
    $result = [];
    foreach($all as $key => $p) {
        $tags = explode(", ", $p['tags']);
        $amountTags = count($tags) - 1;
        for ($x = 0; $x <= $amountTags; $x++) {    
            if (in_array(strtolower($tags[$x]), $searchArray)) {              
                $result[$key] = $p;
            }
        }
        
    }
    $page = $result;
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
        <?php if(!empty($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="feed__post">
                    <a href="post.php?watch=<?php echo $p['id']; ?>" class="feed__post--image" style="background-image: url(<?php echo $p["photo_url"] ?>)">
                    </a>
                    <div class="feed__post__info">
                        <p class="feed__post__info--uploader"><?php echo htmlspecialchars($p['username']); ?></p>
                        <p class="feed__post__info--description"><?php echo htmlspecialchars($p['title']); ?></p>
                        <p class="feed__post__info--uploadtime"><?php echo Post::time_elapsed_string($p['datetime']); ?></p>
                        <div class="feed__post__info--likes likes-0"><button class="<?php if( $p['liketype'] === "0" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="0">Like</button><div class="like--count"><?php echo substr_count($p['likes'],"0"); ?></div></div>
                        <div class="feed__post__info--likes likes-1"><button class="<?php if( $p['liketype'] === "1" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="1">Bump</button><div class="like--count"><?php echo substr_count($p['likes'],"1"); ?></div></div>
                        <div class="feed__post__info--likes likes-2"><button class="<?php if( $p['liketype'] === "2" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="2">Lol</button><div class="like--count"><?php echo substr_count($p['likes'],"2"); ?></div></div>
                        <div class="feed__post__info__comments">
                            <?php 
                                $comments = Post::loadComments($p['id']);
                                foreach ($comments as $c) {
                                    echo "<div class='feed__post__info__comments--comment'>";
                                    echo "<a href='#' class='feed__post__info__comments--commentUsername'>".$c['username']."</a>";
                                    echo "<p>".$c['comment']."</p>";
                                    echo "</div>";
                                }
                                $countComments = Post::countComments($p['id']);
                                if ($countComments > 2) {
                                    echo "<a class='feed__post__info__comments--moreComments' href='post.php?watch=".$p['id']."'>See all " . $countComments. " comments</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
            <?php endforeach ?>
    </div> 
<?php else: ?>
        <p class="feed__msg">No posts found</p>
    <?php endif; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="public_html/js/like.js"></script>
</body>
</html>