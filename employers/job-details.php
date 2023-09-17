<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if (strlen($_SESSION['emplogin']) == 0) {
  header('location:emp-login.php');
} else { ?>
  <!doctype html>
  <html>

  <head>
    <title>Service Details | Service Provider</title>
    <link href="../css/custom.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">

    <link href="../css/responsive.css" rel="stylesheet" type="text/css">
    <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
  </head>



  <body class="index">

    <!--WRAPPER START-->

    <div id="wrapper">

      <!--HEADER START-->
      <?php include('includes/header.php'); ?>
      <!--HEADER END-->
      <!--INNER BANNER START-->

      <section id="inner-banner">

        <div class="container">

          <h1>Service Details</h1>

        </div>

      </section>

      <!--INNER BANNER END-->



      <!--MAIN START-->

      <div id="main">

        <!--RECENT JOB SECTION START-->

        <section class="recent-row padd-tb job-detail">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-8">
                <div id="content-area">

                  <?php
                  //Getting Jobid
                  $jobid = intval($_GET['jobid']);
                  //Geeting Employer Id
                  $empid = $_SESSION['emplogin'];
                  // Fetching jobs
                  $sql = "SELECT tbljobs.*,tblemployers.Image from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId  where tbljobs.employerId=:eid and tbljobs.jobId=:jobid";
                  $query = $dbh->prepare($sql);
                  $query->bindParam(':eid', $empid, PDO::PARAM_STR);
                  $query->bindParam(':jobid', $jobid, PDO::PARAM_STR);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                  ?>

                      <div class="box">
                        <div class="thumb">

                          <a href="#">
                            <img src="employerslogo/<?php echo htmlentities($result->Image); ?>" alt="img" width="165" height="165"></a>
                        </div>
                        <div class="text-col">

                          <h2><?php echo htmlentities($result->jobCategory); ?></h2>

                          <a class="text">Address : <?php echo htmlentities($result->jobLocation); ?></a>
                          </br>
                          <a class="text">Registered Date : <?php echo htmlentities($result->postinDate); ?></a>

                          <strong class="price">Amount :Ksh <?php echo htmlentities($result->salaryPackage); ?></strong>

                          <div class="clearfix">
                            <p>Experience : <?php echo htmlentities($result->experience); ?></p>

                            <h4>Description</h4>

                            <p><?php echo $result->jobDescription; ?></p>

                          </div>
                      <?php }
                  } ?>


                        </div>
                      </div>
                </div>
              </div>
        </section>
      </div>

      <!--MAIN END-->

    </div>

    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.velocity.min.js"></script>
    <script src="../js/jquery.kenburnsy.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/form.js"></script>
    <script src="../js/custom.js"></script>

  </body>

  </html>
<?php } ?>