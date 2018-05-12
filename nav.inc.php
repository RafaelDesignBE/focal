<nav class="navbar">

    <div class="navbar__container">  

      <a class="link--h1" href="index.php"><h1 class="h1--focal">Focal</h1></a>

      <div class="navbar__icons">
        <a href="upload.php"><img class="navbar__icons--icon" src="public_html/img/upload.svg" alt="upload"></a>
        <a href="#"><img class="navbar__icons--icon" src="public_html/img/notification.svg" alt="notification"></a>
        <a href="profile.php?user=<?php echo $_SESSION['user_id'] ?>"><img class="navbar__icons--icon navbar__icons--rightIcon" src="public_html/img/profile.svg" alt="profile"></a>
      </div>

      <form class="form__search" action="search.php" method="get">
        <input placeholder="Search" type="text" name="q">
      </form>
    
    </div>
    
</nav>