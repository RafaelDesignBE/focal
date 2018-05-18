<?php
session_start();
if ( isset($_SESSION['user_id'])) {
    include_once('library/classes/User.class.php');
    $role = User::getUserRole($_SESSION['user_id'])['role'];
    if( $role == 2 ) {

    } else {
        die();
    }
} else {
    die();
}

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
    <?php include_once('header.inc.php'); ?>
    <title>Admin Panel</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <table class="admin-table">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>View Profile</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Lock Account</th>
            <th>Delete</th>
            <th>Creation Date</th>
        </tr>
    <?php foreach ($users as $user): ?>
        <tr<?php if(  $user['deleted'] == 1 ){echo ' class="deleted"';} ?>>
            <td class="table__userid"><?php echo $user['id']; ?></td>
            <td><input type="text" class="username" data-userid="<?php echo $user['id']; ?>" value="<?php echo htmlspecialchars($user['username']); ?>"></td>
            <td><input class="email" type="email" data-userid="<?php echo $user['id']; ?>" value="<?php echo htmlspecialchars($user['email']); ?>"></td>
            <td><a href="profile.php?user=<?php echo $user['id']; ?>">View Profile</a></td>
            <td><input type="password" class="password" data-userid="<?php echo $user['id']; ?>" value=""></td>
            <td><input type="text" class="firstname" data-userid="<?php echo $user['id']; ?>" value="<?php echo htmlspecialchars($user['first_name']); ?>"></td>
            <td><input type="text" class="lastname" data-userid="<?php echo $user['id']; ?>" value="<?php echo htmlspecialchars($user['last_name']); ?>"></td>
            <td>
                <select name="role" class="role" data-userid="<?php echo $user['id']; ?>">
                    <option value="0"<?php if( $user['role'] == 0 ) { echo 'selected="selected"'; } ?>>User</option>
                    <option value="1"<?php if( $user['role'] == 1 ) { echo 'selected="selected"'; } ?>>Moderator</option>
                    <option value="2"<?php if( $user['role'] == 2 ) { echo 'selected="selected"'; } ?>>Administrator</option>
                </select>
            </td>
            <td><a href="#" class="lock" data-userid="<?php echo $user['id']; ?>">Lock</a></td>
            <td><a href="#" class="delete" data-userid="<?php echo $user['id']; ?>"><?php if(  $user['deleted'] == 1 ){echo 'recover';} else {echo 'delete';}; ?></a></td>
            <td class="table__creation"><?php echo $user['creation']; ?></td>
        </tr>
    <?php endforeach ?>
    </table>
    <script src="public_html/js/admin.js"></script>
</body>
</html>