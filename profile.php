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
        <?php include_once('showPosts.inc.php'); ?>
        </div>
    <?php else: ?>
        <p class="feed__msg">This user has nothing posted yet!</p>
    <?php endif; ?>
    
    <script src="public_html/js/post.js"></script>
    <script src="public_html/js/follow.js"></script>
</body>
</html>