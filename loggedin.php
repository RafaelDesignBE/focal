<?php
include_once('library/classes/User.class.php');
User::cookieCheck($_COOKIE["user"]);