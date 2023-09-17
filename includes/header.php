<header id="header">

  <!--BURGER NAVIGATION SECTION START-->

  <!--BURGER NAVIGATION SECTION END-->

  <div class="container">

    <!--NAVIGATION START-->

    <div class="navigation-col">

      <nav class="navbar navbar-inverse">

        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

          <h2><strong class="logo" style="color: purple; padding-top:8%">PataKazi </strong></h2>
        </div>

        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav" id="nav">

            <li><a href="index.php">Home</a>



            </li>
            <?php if (strlen($_SESSION['jsid'] == 0)) { ?>
              <li><a href="sign-up.php">Service Seeker</a>
              </li>

              <li><a href="employers/emp-login.php">Service Providers</a></li>
              <li><a href="admin/index.php">Admin</a></li><?php } ?>


            <?php if (strlen($_SESSION['jsid'] != 0)) { ?>
              <li><a href="applied-jobs.php">History of Applied Services</a></li>
            <?php } ?>
            </li>
            <li><a href="Chat/index.php" target="_blank">Chat</a></li>

            <li><a href="" target="_blank"></a></li>


            <div id="google_translate_element"></div>

            <!-- <script type="text/javascript">
              function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                  pageLanguage: 'en',
                  layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
              }
            </script> -->

            <!-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->


          </ul>

        </div>

      </nav>

    </div>

    <!--NAVIGATION END-->

  </div>



  <!--USER OPTION COLUMN START-->

  <div class="user-option-col">

    <div class="thumb">

      <div class="dropdown">
        <?php if (strlen($_SESSION['jsid'] != 0)) { ?>

          <?php
          $uid = $_SESSION['jsid'];
          $sql = "SELECT * from tbljobseekers where id='$uid'";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);

          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $row) {               ?>
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="images/<?php echo $row->ProfilePic; ?>" width="40" height="40"></button>
          <?php $cnt = $cnt + 1;
            }
          } ?>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a href="my-profile.php">My Profile</a></li>

            <li><a href="change-password.php">Change Password</a></li>

            <li><a href="profile.php">Edit Profile</a></li>

            <li><a href="logout.php">Log Out</a></li>

          </ul>
        <?php } ?>
      </div>

    </div>



  </div>

  <!--USER OPTION COLUMN END-->
</header>