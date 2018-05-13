<?php

include_once('library/classes/User.class.php');
include_once('library/classes/Post.class.php');

    $users = User::getAllUsers();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
</head>
<body>
    <table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>View Profile</th>
        <th>Password</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Creation Date</th>
        <th>Delete</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><a href="#" class="email"><?php echo $user['email']; ?></a></td>
        <td><a href="profile.php?user=<?php echo $user['id']; ?>">View Profile</a></td>
        <td><a href="#" class="password">Change password</a></td>
        <td><?php echo $user['first_name']; ?></td>
        <td><?php echo $user['last_name']; ?></td>
        <td><?php echo $user['creation']; ?></td>
        <td><a href="#" class="delete">Delete account</a></td>
        
    </tr>
    <?php endforeach ?>
    </table>
</body>
</html>