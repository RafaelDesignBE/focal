<?php

  include_once('library/classes/User.class.php');
  $avatar = User::getAvatar($_SESSION['user_id']);

?><nav class="navbar">

    <div class="navbar__container">  

      <a class="link--h1" href="index.php"><h1 class="h1--focal">Focal</h1></a>

      <form class="form__search" action="search.php" method="get">
        <input placeholder="Search" type="text" name="q" onfocus="maxSearch()" onblur="minSearch()">
      </form>

      <div class="navbar__icons">
        <a class="navbar--home" href="index.php"><img class="navbar__icons--icon" src="public_html/img/home.svg" alt="home"></a>
        <a href="upload.php"><img class="navbar__icons--icon" src="public_html/img/upload.svg" alt="upload"></a>
          <?php foreach ($avatar as $a): ?>
            <?php if (!empty($a['avatar_url'])): ?>
              <a href="profile.php?user=<?php echo $_SESSION['user_id'] ?>"><div style="background-image:url(<?php echo $a['avatar_url']; ?>)" class="navbar__avatar navbar__icons--rightIcon"></div></a>
            <?php else: ?>
              <a href="profile.php?user=<?php echo $_SESSION['user_id'] ?>"><img class="navbar__icons--icon navbar__icons--rightIcon" src="public_html/img/profile.svg" alt="profile"></a>
            <?php endif; ?>
            <?php endforeach; ?>
      </div>

      
    
    </div>
    
</nav>