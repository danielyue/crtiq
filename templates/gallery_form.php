<body>
<div class="darkener"></div>

<script>
  $.backstretch([
    '<?= htmlspecialchars($background_url) ?>'
        //NOTE: The last element has NO comma
    ], {
      fade: 500,      //Speed of Fade
      duration: 5000  //Time of image display
  });
</script>
<script type='text/javascript'>
    $(document).ready(function(){
        $("div.a").hover(
        function() {
            $(this).stop().animate({"opacity": ".4"}, "slow");
            $(this).find('.message').fadeIn(600);
        },
        function() {
             $(this).stop().animate({"opacity": "1"}, "slow");
             $(this).find('.message').fadeOut(500);
        });

    });
</script>

<div id="container">
  <!-- === === === === === HEADER === === === === === -->
    <div id="header">
        <h1>
            <a href="home.php" title="Back to Home"><img src="img/crtiq_logo.png" alt="CrtIQ" /></a>
        </h1>
        
        <div id="nav">
            <ul>
                <li><a href="home.php" title="Back to Home">HOME</a></li>
                <li><a href="browse.php" title="Browse other's work">BROWSE</a></li>
                <li><a href="about.php" title="About crtIQ">ABOUT</a></li>
            </ul>
        </div>

        <h1 class="pull-right" style="margin-right:4%">
            <a href="logout.php" title="Logout"><img src="img/logout.png" style="height:24px;" alt="Q" /></a>
        </h1>
        <h1 class="pull-right">
            <a href="profile.php" title="Profile Settings"><img src="img/settings.png" style="height:24px;" alt="Q" /></a>
        </h1>
    </div>

    <!-- === === === === === GALLERY === === === === === -->
    <div class="usersidebar">
        <?php if (isset($user_info)):?>
          <div class="username">
          <?php
              $counter = 0;
              foreach($user_info["splitname"] as $name)
              {
                  if ($counter > 0)
                  {
                      print("<br>");
                  }
                  print($name);
                  $counter++;
              }
          ?>
          </div>
          <?php if (!empty($user_info["profile_url"])):?>
              <div class="usericon"><img src= '<?=$user_info["profile_url"]?>' ></div>
          <?php else: ?>
              <div class="usericon"><img src="img/man-silhouette-svg-med-copy.png"></div>
          <?php endif ?>
          <div class="userbasicinfo">
              <p><?= htmlspecialchars($user_info["hometown"])?> &nbsp&nbsp&nbsp&nbsp&nbsp|
                    &nbsp&nbsp&nbsp&nbsp&nbsp <?= htmlspecialchars(sizeof($user_images))?> &nbsp images</p>
              <p class="userlikes"><?= htmlspecialchars($user_info["likes"])?> likes</p>
              <p class="userchecks"></p>
          </div>
        <?php else: ?>
          <div class="browsemessage"> Browse through other's work and select one to critique! </div>
        <?php endif ?>
        <?php if (!empty($user_info["profile_url"])):?>
            <h1 class="about-me title">ABOUT ME</h1>
            <p class="about-me"><?=$user_info["description"]?></p>
        <?php endif ?>
    </div>
    <div class="gallery_container">
        <?php
            foreach($user_images as $image)
            {
                print("<a href='critique.php?image_id={$image["id"]}'class='gallery-img'>");
                print("<div class='img-container a'><img src='{$image["url"]}'>");
                print("<span class='message'>{$image["title"]}</span></div></a>");
            }
        ?>
        <?php if (isset($user_info)):?>
            <a href="upload.php" class="gallery-img add-img"><img class="a" src="img/upload_gallery_plus.png"></a>
        <?php endif ?>
    </div>

</div>