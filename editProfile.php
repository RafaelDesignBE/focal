<?php

    include_once('library/classes/User.class.php');
    include_once('library/helpers/Security.class.php');

    include_once('userCheck.php');

    $profile = User::loadProfile($_SESSION['user_id']);

    if (!empty($_POST)) {        
        try {
            if(!empty($_POST['profileText'])) {
                User::updateProfileText($_SESSION['user_id'], $_POST['profileText']);
            }
    
            if(!empty($_POST['email'])) {
                User::updateEmail($_SESSION['user_id'], $_POST['email']);
            }

            if(!empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['confirmnewpassword'])) {
                try {
                    $security = new Security();
                    $security->password = $_POST['newpassword'];
                    $security->passwordRepeat = $_POST['confirmnewpassword'];
                    
                    if ($security->passwordsCheck()) {
                        if (User::passwordCheck($_POST['oldpassword'], $_SESSION['user_id'])) {
                            User::updatePassword($_SESSION['user_id'], $_POST['newpassword']);
                        }
                    }
                }
                catch (Exception $e){
                              
                }
                
            }

        }
        catch (Exception $e){
  
        }
        

        $profile = User::loadProfile($_SESSION['user_id']);
        
    }

    if(!empty($_FILES["avatarFile"])){
        try {

            $user = new User();
            $user->setAvatar($_FILES["avatarFile"]);     
            $user->saveAvatar();
            $user->postAvatar($_SESSION['user_id']);
            header('Location: editProfile.php?upload=complete');
        }

        catch (Exception $e){
  
        }
    }

    
?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title>Edit Profile</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <?php if(isset($e)): ?>
        <div class="user__error error">
            <p><?php echo $e->getMessage(); ?></p>
        </div>
    <?php endif; ?>
    <?php 
        if(isset($_GET['upload'])){
            if( $_GET['upload'] == "complete" ) {
                echo "<div class='user__avatar__complete'><p>Your avatar has been updated</p></div>";
            }
        }
    ?>
    <h1 class="editprofile--h1">Change profile settings</h1>

    <div class="editprofile__avatar">
            <form action="editProfile.php" method="post" id="changeAvatar" class="form__changeAvatar" enctype="multipart/form-data">
                <div class="form__changeAvatar--container">
                    <label>Click on avatar to edit</label>
                    <div style="background-image:url(<?php echo $profile['avatar_url'] ?>);" class="previewAvatar"><input type="file" name="avatarFile" id="avatarFile" onchange="readURL(this);"></div>
                </div>                
                <input type="submit" value="Save avatar" name="submit" class="btn btn--primary btn--change">
            </form>
    
    </div>

    <button class="accordion">Change profile text</button>
    <div class="panel panel__profileText">
            <form action="" method="post" id="changeProfileText" class="form__changeSettings">
                <div class="form__field form__field--profileText">
                    <label for="profileText">Change status</label>
                    <textarea id="profileText" form="changeProfileText" name="profileText"><?php echo htmlspecialchars($profile['profileText']) ?></textarea>
                </div>
                <div class="form__field">
                    <input type="submit" value="Save" class="btn btn--primary btn--change">
                </div>
            </form>
    </div>

    <button class="accordion">Change password</button>
    <div class="panel panel__password">
            <form action="" method="post" id="changePassword" class="form__changeSettings">
                <div class="form__field form__field--password">
                    <label for="oldpassword">Old password</label>
                    <input type="password" id="oldpassword" name="oldpassword" placeholder="Old password">
                </div>
                <div class="form__field form__field--password">
                    <label for="newpassword">New password</label>
                    <input type="password" id="newpassword" name="newpassword" placeholder="New password">
                </div>
                <div class="form__field form__field--password">
                    <label for="confirmnewpassword">Confirm new password</label>
                    <input type="password" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirm new password">
                </div>
                <div class="form__field">
                    <input type="submit" value="Save" class="btn btn--change btn--primary">
                </div>
            </form>
    </div>

    <button class="accordion">Change email</button>
    <div class="panel panel__email">
            <form action="" method="post" id="changeEmail" class="form__changeSettings">
                <div class="form__field form__field--email">
                    <label for="email">Change email</label>
                    <input type="email" id="email" name="email" placeholder="<?php echo $profile['email'] ?>">
                </div>
                <div class="form__field">
                    <input type="submit" value="Save" class="btn btn--change btn--primary">
                </div>
            </form>
    </div>

    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight){
                panel.style.maxHeight = null;
                } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            } 
            });
        }


        function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.previewAvatar').addClass("open");
            $('.previewAvatar').css('background-image', "url("+e.target.result+")");
        }

        reader.readAsDataURL(input.files[0]);
    }
}
    </script>
</body>
</html>