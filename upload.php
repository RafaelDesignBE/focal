<?php
include_once('userCheck.php');
include_once('library/classes/Post.class.php');

$filters = array("walden", "slumber", "moon", "gingham", "aden", "_1977", "reyes");

if (!empty($_POST)) {
    try {
        $upload = new Post();
        $upload->setImage($_FILES["uploadFile"]);
        $upload->setDescription($_POST['description']);
        $upload->setTags($_POST['tags']);
        $upload->setWidth(400);
        $upload->setHeight(400);
        $upload->setLocation($_POST['latitude'], $_POST['longitude'], $_POST['location']);
        $upload->saveImg();
        if (isset($_POST['filterinput'])) {
            foreach ($filters as $f) {
                if ($_POST['filterinput'] == $f) {
                    $upload->setFilter($_POST['filterinput']);
                }
            }
        }        
        $upload->postImg($_SESSION['user_id']);
        header('Location: index.php?upload=complete');
    }
    catch (Exception $e){
  
    }
    
} 

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>New post</title>
<?php include_once('header.inc.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./public_html/js/upload.js"></script>
</head>
<body>
<?php include_once("nav.inc.php"); ?>

<form action="" method="post" enctype="multipart/form-data" class="form__post">
    <?php if(isset($e)): ?>
        <div class="error">
            <p><?php echo $e->getMessage(); ?></p>
        </div>
    <?php endif; ?>
    <div class="form__container">
        <div class="form__content">
            <figure id="figurePreview">
            <img id="preview--image" alt="Image preview">
            </figure>
            <div class="form__content form__content__filters">
            <ul>
                <?php foreach ($filters as $f): ?>
                    <li>
                        <input name="filterinput" type="checkbox" value="<?php echo $f ?>" id="filter--<?php echo $f ?>" />
                        <label class="labelfilter" for="filter--<?php echo $f ?>">
                            <figure class="filterfigure <?php echo $f ?>">
                                <img class="uploadedPicture" src="" alt="picture">
                            </figure>
                        </label>
                    </li>                    
                <?php endforeach ?>
            </ul>
            
            </div>
            <div class="form__field field__upload">
                <label>Select image to upload:</label>
                <div class="btn btn--primary btn--upload"><input type="file" name="uploadFile" id="uploadFile" onchange="readURL(this);">Choose file</div>
            </div>
        </div>
               
        <div class="form__content">
            <div class="form__field">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder = "Description">
            </div>
            <div class="form__field">
                <label for="tags">Tags</label>
                <input type="text" name="tags" id="tags" placeholder = "Tags">
            </div>
               
            <div class="form__field location">
                <input id="latitude" name="latitude">
                <input id="longitude" name="longitude">
                <input id="location" name="location">
            </div>

            <input type="submit" value="Upload" name="submit" class="btn btn--primary">
        </div>
    </div>
</form>
</body>
</html>