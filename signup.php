<?php

include_once('library/helpers/Security.class.php');
include_once('library/classes/User.class.php');

if (!empty($_POST)) {

    try {
        $security = new Security();
        $security->password = $_POST['password'];
        $security->passwordRepeat = $_POST['password_repeat'];
        
        if ($security->passwordsCheck()) {
            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setFirstName($_POST['first_name']);
            $user->setLastName($_POST['last_name']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            if( $user->register() ){
                $user->login();
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
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form action="" method="post" class="form__login">
        <div class="form__field">
            <?php if(isset($e)): ?>
            <div class="error">
                <p><?php echo $e->getMessage(); ?></p>
            </div>
            <?php endif; ?>
			<label for="username">Username</label>
			<input type="text" id="username" name="username" placeholder="Username">
		</div>
        <div class="form__field">
			<label for="first_name">First name</label>
			<input type="text" id="first_name" name="first_name" placeholder="First name">
		</div>
        <div class="form__field">
			<label for="last_name">First name</label>
			<input type="text" id="last_name" name="last_name" placeholder="Last name">
		</div>
        <div class="form__field">
			<label for="email">Email</label>
			<input type="email" id="email" name="email" placeholder="Email">
		</div>
        <div class="form__field">
			<label for="email">Password</label>
			<input type="password" id="password" name="password" placeholder="Password">
		</div>
        <div class="form__field">
			<label for="password_repeat">Password repeat</label>
			<input type="password" id="password_repeat" name="password_repeat" placeholder="Password repeat">
		</div>
        <div class="form__field">
			<input type="submit" value="Sign up" class="btn">
		</div>
    </form>
</body>
</html>