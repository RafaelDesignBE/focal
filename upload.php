<?php
session_start();
if ( isset($_SESSION['email'])) {
}
else {
    header('Location: signup.php');
}
include_once('library/classes/Post.class.php');


if (!empty($_POST)) {
    try {
        $upload = new Post();
        $upload->setImage($_FILES["uploadFile"]);
        $upload->setDescription($_POST['description']);
        $upload->setTags($_POST['tags']);
        $upload->setCategory($_POST['category']);
        $upload->setWidth(400);
        $upload->setHeight(400);
        $upload->saveImg();
        $upload->postImg($_SESSION['email']);
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
<script src="./public_html/js/uploadpreview.js"></script>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data" class="form__post">
    <?php if(isset($e)): ?>
        <div class="error">
            <p><?php echo $e->getMessage(); ?></p>
        </div>
    <?php endif; ?>
    <div class="form__container">
        <div class="form__content">
            <div id="preview--image" alt="Image preview"></div>
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
            
            <div class="form__field form__radio">
                <input type="radio" id="category1"
                name="category" value="0">
                <label for="category1">Photo</label>

                <input type="radio" id="category2"
                name="category" value="1">
                <label for="category2">Graphic</label>

                <input type="radio" id="category3"
                name="category" value="2">
                <label for="category3">Art</label>
            </div>

            <input type="submit" value="Upload" name="submit" class="btn btn--primary">
        </div>
    </div>
</form>

</body>
</html>