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
    <?php echo $_SESSION['user_id']; ?>
    <div class="feed">
        <?php if(isset($page)): ?>  
            <?php foreach ($page as $p): ?>
                <div class="feed__post">
                    <a href="post.php?watch=<?php echo $p['id']; ?>" class="feed__post--image" style="background-image: url(<?php echo $p["photo_url"] ?>)">
                    </a>
                    <div class="feed__post__info">
                        <p class="feed__post__info--uploader"><?php echo htmlspecialchars($p['username']); ?></p>
                        <p class="feed__post__info--description"><?php echo htmlspecialchars($p['title']); ?></p>
                        <p class="feed__post__info--uploadtime"><?php echo Post::time_elapsed_string($p['datetime']); ?></p>
                        <div class="feed__post__info--likes"><button class="<?php if( $p['liketype'] === "0" ){ echo "liked"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="0">Like</button><div class="like--count"><?php echo substr_count($p['likes'],"0"); ?></div></div>
                        <div class="feed__post__info--likes"><button class="<?php if( $p['liketype'] === "1" ){ echo "liked"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="1">Bump</button><div class="like--count"><?php echo substr_count($p['likes'],"1"); ?></div></div>
                        <div class="feed__post__info--likes"><button class="<?php if( $p['liketype'] === "2" ){ echo "liked"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="2">Lol</button><div class="like--count"><?php echo substr_count($p['likes'],"2"); ?></div></div>
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
    <script>
    function likePost() {
        $.ajax({
                url: "likePost.php",
                context: this,
                method: "POST",
                data: { postId: $(this).data("post"), likeType: $(this).data("type") }
                }).done(function() {
                    var liked = $( this ).parent().parent().find('.liked');
                    var parent = $( this ).parent().find('.like--count');
                    liked.toggleClass('like liked');
                    liked.off();
                    liked.on("click", likePost);
                    $( this ).toggleClass('like liked');
                    $( this ).off();
                    $( this ).on("click", removeLike);
                    var newlike = parseInt(parent.html()) + 1;
                    parent.html(newlike);
            });
            console.log("added like");
    }

    function removeLike() {
        $.ajax({
                url: "unlikePost.php",
                context: this,
                method: "POST",
                data: { postId: $(this).data("post") }
                }).done(function() {
                    var parent = $( this ).parent().find('.like--count');
                    $( this ).toggleClass('like liked');
                    $( this ).off();
                    $( this ).on("click", likePost);
                    var newlike = parseInt(parent.html()) - 1;
                    parent.html(newlike);
            });
            console.log("removed like");
    }

    $(".like").on("click", likePost);

    $(".liked").on("click", removeLike);
    
    </script>
</body>
</html>