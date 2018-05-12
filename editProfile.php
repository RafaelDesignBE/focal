<?php

    include_once('library/classes/User.class.php');

    session_start();
    if ( isset($_SESSION['email'])) {

    }
    else {
        header('Location: signup.php');
    };

    $profile = User::loadProfile($_SESSION['user_id']);

    if (!empty($_POST)) {

        if(!empty($_POST['profileText'])) {
            User::updateProfileText($_SESSION['user_id'], $_POST['profileText']);
            $profile = User::loadProfile($_SESSION['user_id']);
        }

        if(!empty($_POST['email'])) {
            User::updateEmail($_SESSION['user_id'], $_POST['email']);
            $profile = User::loadProfile($_SESSION['user_id']);
        }
        
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
    
    <h1>Change profile settings</h1>

    <?php foreach ($profile as $p): ?>
        <form action="" method="post" id="changeSettings" class="form__changeSettings">
            <div class="form__field">
                <label for="profileText">Change status</label>
                <textarea id="profileText" form="changeSettings" name="profileText"><?php echo $p['profileText'] ?></textarea>
            </div>
            <div class="form__field">
                <label for="oldpassword">Old password</label>
                <input type="password" id="oldpassword" name="oldpassword" placeholder="Old password">
            </div>
            <div class="form__field">
                <label for="newpassword">New password</label>
                <input type="newpassword" id="newpassword" name="newpassword" placeholder="New password">
            </div>
            <div class="form__field">
                <label for="confirmnewpassword">Confirm new password</label>
                <input type="confirmnewpassword" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirm new password">
            </div>
            <div class="form__field">
                <label for="email">Change email</label>
                <input type="email" id="email" name="email" placeholder="<?php echo $p['email'] ?>">
            </div>
            <div class="form__field">
                <input type="submit" value="Change settings" class="btn btn--primary">
            </div>
        </form>
    <?php endforeach; ?>

</body>
</html>