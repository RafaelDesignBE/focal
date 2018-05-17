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

var_dump($_POST);
if( isset($_POST['user']) && isset($_POST['role']) ) {
    User::updateRole($_POST['user'], $_POST['role']);
    echo "updated role";
}

if( isset($_POST['user']) && isset($_POST['email']) ) {
    User::updateEmail($_POST['user'], $_POST['email']);
    echo "updated email";
}

if( isset($_POST['user']) && isset($_POST['username']) ) {
    User::updateUsername($_POST['user'], $_POST['username']);
    echo "updated username";
}

if( isset($_POST['user']) && isset($_POST['firstname']) ) {
    User::updateFirstname($_POST['user'], $_POST['firstname']);
    echo "updated first name";
}

if( isset($_POST['user']) && isset($_POST['lastname']) ) {
    User::updateLastname($_POST['user'], $_POST['lastname']);
    echo "updated last name";
}

if( isset($_POST['user']) && isset($_POST['password']) ) {
    User::updatePassword($_POST['user'], $_POST['password']);
    echo "updated password";
}

if( isset($_POST['user']) && isset($_POST['lock']) ) {
    User::lockAccount($_POST['user']);
    echo "locked account";
}

if( isset($_POST['user']) && isset($_POST['del']) ) {
    User::deleteAccount($_POST['user'], $_POST['del']);
    echo "account deleted";
}