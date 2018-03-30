<?php

session_start();
	if ( isset($_SESSION['email'])) {
	}
	else {
		header('Location: signup.php');
	}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Homepage</h1>
    <a href="logout.php">Log out</a>
</body>
</html>