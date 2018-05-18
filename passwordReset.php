<?php
include_once('library/helpers/Security.class.php');
include_once('library/classes/User.class.php');




if (!empty($_POST)) {

    try {
        $security = new Security();
        $security->password = $_POST['password'];
        $security->passwordRepeat = $_POST['password_repeat'];
        
        if ($security->passwordsCheck()) {
            if ( isset($_GET)) {
                try{
                    $hash = $_GET['key'];
                    $result = User::resetHash($hash, $_POST['password']);
                    if( !empty($result) ){
                        $email = $result['email'];
                        if(isset($email)){
                            $user = new User();
                            $user->setEmail($email);
                            $user->login();
                        }
                        //header('Location: index.php');
                    }
                }
                catch (Exception $e){
            
                }
            } else {
                die();
            }
        }
    }
    catch (Exception $e){
                  
    }
    
} 


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once('header.inc.php'); ?>
    <title>Reset Password</title>
</head>
<body>
    <form action="" method="post" class="form__login">
        <h1>Reset Password</h1>
        <div class="form__login__field__container">
            <div class="form__field">
                <?php if(isset($e)): ?>
                <div class="error">
                    <p><?php echo $e->getMessage(); ?></p>
                </div>
                <?php endif; ?>
                <label for="email">Password</label>
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="form__field">
                <label for="password_repeat">Password repeat</label>
                <input type="password" id="password_repeat" name="password_repeat" placeholder="Password repeat">
            </div>
            <div class="form__field">
                <input type="submit" value="Reset" class="btn btn--small btn--primary">
            </div>
        </div>
    </form>
    <a class="link--login" href="login.php">Already have access? Log in</a>
    <script src="public_html/js/validatesignup.js"></script>
</body>
</html>