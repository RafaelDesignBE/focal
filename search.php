<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    include_once('library/classes/Post.class.php');

    $search = $_GET['q'];
    $search = strtolower($search);
    $search = htmlspecialchars($search);
    $searchArray = explode(",", $search);

    $all = Post::getAll();
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
                        <p class="feed__post__info--uploader">Jo Smets</p>
                        <p class="feed__post__info--description"><?php echo $p['description']; ?></p>
                        <p class="feed__post__info--comments">Great pic</p>
                    </div>
                </div>
            <?php endforeach ?>
    </div> 
<?php else: ?>
        <p class="feed__msg">No posts found</p>
    <?php endif; ?>
    
</body>
</html>