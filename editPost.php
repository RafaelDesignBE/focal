<?php
    include_once('userCheck.php');

    include_once('library/classes/Post.class.php');

    $getPost = $_GET['watch'];

    $p = Post::getPost($_SESSION['user_id'] ,$getPost);

    if (!empty($_POST)) {    
        
        if(!empty($_POST['descriptionPost'])) {
            Post::updatePostDescription($_GET['watch'], $_POST['descriptionPost']);
            header('Location: post.php?watch='.$_GET['watch']);
        }

        if(!empty($_POST['tagsPost'])) {
            Post::updatePostTags($_GET['watch'], $_POST['tagsPost']);
            header('Location: post.php?watch='.$_GET['watch']);
        }        
    }

?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title><?php echo htmlspecialchars($p['title']); ?></title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <div class="post">
        <?php if(isset($p)): ?>
                <div class="post__detail">
                <figure class="<?php echo $p["photofilter"]; ?>">
                    <img class="post__detail__image" src="<?php echo $p["photo_url"] ?>" alt="">
                </figure> 
                        
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
                    <div class="feed__post__info__uploader--container">
                        <?php if (!empty($p['avatar_url'])): ?>
                            <div style="background-image:url(<?php echo $p['avatar_url']; ?>)" class="feed__post__info--avatar"></div>
                        <?php endif; ?>
                        <a href="<?php echo "profile.php?user=".Post::getUploader($p['id']).""; ?>" class="feed__post__info--uploader"><?php echo htmlspecialchars($p['username']); ?></a>
                    </div>
                    <form action="" method="post" id="changePost" class="form__changePost">
                        <div class="form__field form__field--descriptionPost">
                            <label for="descriptionPost">Change post description</label>
                            <input type="text" id="descriptionPost" name="descriptionPost" placeholder="<?php echo htmlspecialchars($p['title']); ?>"></input>
                        </div>
                        <div class="form__field form__field--tagsPost">
                            <label for="tagsPost">Change tags</label>
                            <input type="text" id="tagsPost" name="tagsPost" placeholder="<?php echo htmlspecialchars($p['tags']); ?>"></input>
                        </div>
                        <div class="form__field">
                            <input type="submit" value="Save" class="btn btn--primary btn--change">
                        </div>
                    </form>
                </div>
        <?php endif; ?>
    </div>
    <script src="public_html/js/post.js"></script>
</body>
</html>