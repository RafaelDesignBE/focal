<?php 
session_start();
if ( isset($_SESSION['email'])) {
    header('Location: index.php');
}
include_once('library/classes/User.class.php');
if (!empty($_POST)) {
    try{
        $user = new User();
        $user->setEmail($_POST['email']);
        $emailReset = $user->resetMail();
        if ($emailReset) {
            $reset = "done";
        }
    }
    catch(Exception $e) {

    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title>Forgot Password</title>
</head>
<body>
<form action="" method="post" class="form__login">
        <h1 class="h1--focal">FOCAL</h1>
        <h2 class="h2--focal" >Focus on the good things</h2>
        <div class="form__login__field__container">
            <div class="form__field">
                <?php if(isset($e)): ?>
                <div class="error">
                    <p><?php echo $e->getMessage(); ?></p>
                </div>
                <?php endif; ?>
                <?php 
        if(isset($reset)){
            echo "<div class='user__complete'><p>An email has been sent</p></div>";
        }
    ?>
            </div>
            <div class="form__field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">
            </div>
            <div class="form__field">
                <input type="submit" value="Recover" class="btn btn--small btn--primary">
            </div>
        </div>        
    </form>
    <a class="link--login" href="login.php">Log In</a>
</body>
</html>