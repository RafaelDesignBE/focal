<?php
    include_once('userCheck.php');

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
    <title><?php echo htmlspecialchars($search); ?></title>
</head>
<body>

    <?php include_once("nav.inc.php"); ?>

    <div class="feed">
<?php if(!empty($page)): ?>  
        <?php include_once('showPosts.inc.php'); ?>
        </div> 
<?php else: ?>
        <p class="feed__msg">No posts found</p>
<?php endif; ?>
    
    <script src="public_html/js/post.js"></script>
</body>
</html>