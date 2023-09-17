 <header id="header">

   <!--BURGER NAVIGATION SECTION START-->

   <!--BURGER NAVIGATION SECTION END-->

   <div class="container">

     <!--NAVIGATION START-->

     <div class="navigation-col">

       <nav class="navbar navbar-inverse">

         <div class="navbar-header">

           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>


           <h2><strong class="logo" style="color:purple;padding-top:8%">PataKazi </strong></h2>
         </div>



         <ul class="nav navbar-nav" id="nav">
           <li><a href="#">Services</a>
             <ul>
               <li><a href="post-job.php">Post a Service</a></li>
               <li><a href="job-listing.php">Manage Services</a></li>
             </ul>
           </li>

           <li><a href="jobseeker-listings.php">Service Seeker List</a></li>
           <div id="google_translate_element"></div>

           <script type="text/javascript">
             function googleTranslateElementInit() {
               new google.translate.TranslateElement({
                 pageLanguage: 'en',
                 layout: google.translate.TranslateElement.InlineLayout.SIMPLE
               }, 'google_translate_element');
             }
           </script>

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
         <!--Fetching Company Logo -->
         <?php
          //Geeting Employer Id
          $empid = $_SESSION['emplogin'];
          // Fetching jobs
          $sql = "SELECT  Image from tblemployers where id=:eid";
          $query = $dbh->prepare($sql);
          $query->bindParam(':eid', $empid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>

             <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <img src="employerslogo/<?php echo htmlentities($result->Image) ?>" alt="Company Logo" width="44" height="44" style="border: solid 1px #000000;"></button>
         <?php }
          } ?>
         <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

           <li><a href="edit-profile.php">Manage Account</a></li>

           <li><a href="change-password.php">Change Password</a></li>
           <li><a href="../payment/index.php">Subscription</a></li>
           <li><a href="logout.php">Log off</a></li>

         </ul>

       </div>

     </div>



   </div>

   <!--USER OPTION COLUMN END-->



 </header>