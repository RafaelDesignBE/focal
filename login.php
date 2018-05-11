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
        $user->setPassword($_POST['password']);
        if ($user->loginCheck()) {
            $user->login();
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
    <title>Login</title>
</head>
<body>
<form action="" method="post" class="form__login">
        <h1>Log In</h1>
        <div class="form__field">
            <?php if(isset($e)): ?>
            <div class="error">
                <p><?php echo $e->getMessage(); ?></p>
            </div>
            <?php endif; ?>
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
			<input type="submit" value="Log in" class="btn btn--primary">
        </div>
    </form>
    <a class="link--login" href="signup.php">Sign up</a>
</body>
</html>