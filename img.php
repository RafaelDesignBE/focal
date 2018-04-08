<?php
session_start();
if ( isset($_SESSION['email'])) {
}
else {
    header('Location: signup.php');
}
include_once('library/classes/Upload.class.php');


if (!empty($_POST)) {

    try {
        $upload = new Upload();
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
<body>
<?php if(isset($e)): ?>
            <div class="error">
                <p><?php echo $e->getMessage(); ?></p>
            </div>
            <?php endif; ?>
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="uploadFile" id="uploadFile">
    <input type="text" name="description" id="description">
    <input type="text" name="tags" id="tags">
    
    <input type="radio" id="category1"
     name="category" value="0">
    <label for="category1">Photo</label>

    <input type="radio" id="category2"
     name="category" value="1">
    <label for="category2">Graphic</label>

    <input type="radio" id="category3"
     name="category" value="2">
    <label for="category3">Art</label>

    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>