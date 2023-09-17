<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if (strlen($_SESSION['emplogin']) == 0) {
  header('location:emp-login.php');
} else {
?>
  <!doctype html>

  <html>

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Service Provider | Service lisServiceg</title>

    <!--CUSTOM CSS-->

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

          <h1>Service Provider | Services listing</h1>

        </div>

      </section>

      <!--INNER BANNER END-->







      <!--MAIN START-->

      <div id="main">

        <!--RECENT JOB SECTION START-->

        <section class="recent-row padd-tb">

          <div class="container">

            <div class="row">

              <div class="col-md-12 col-sm-8">


                <div id="content-area">
                  <ul id="myList">

                    <?php
                    //Geeting Employer Id
                    $empid = $_SESSION['emplogin'];
                    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                      $page_no = $_GET['page_no'];
                    } else {
                      $page_no = 1;
                    }
                    // Formula for pagination
                    $no_of_records_per_page = 5;
                    $offset = ($page_no - 1) * $no_of_records_per_page;
                    $previous_page = $page_no - 1;
                    $next_page = $page_no + 1;
                    $adjacents = "2";
                    $ret = "SELECT jobId FROM tbljobs";
                    $query1 = $dbh->prepare($ret);
                    $query1->execute();
                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                    $total_rows = $query1->rowCount();
                    $total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
                    $second_last = $total_no_of_pages - 1; // total page minus 1
                    // Fetching jobs
                    $sql = "SELECT tbljobs.*,tblemployers.Image from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId  where employerId=:eid LIMIT $offset, $no_of_records_per_page";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':eid', $empid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                      foreach ($results as $result) {


                    ?>

                        <li>
                          <div class="box">
                            <div class="thumb">
                              <!-- logo -->
                              <a href="job-details.php?jobid=<?php echo htmlentities($result->jobId); ?>"><img src="employerslogo/<?php echo htmlentities($result->Image); ?>" alt="img" width="60" height="60"></a>
                            </div>

                            <div class="text-col">
                              <div class="hold" style="width:100%">

                                <!-- Job Title -->
                                <h4><a href="job-details.php?jobid=<?php echo htmlentities($result->jobId); ?>" title='View Details'><?php echo htmlentities($result->jobCategory); ?></a> <a href="edit-job.php?jobid=<?php echo htmlentities($result->jobId); ?>" title='Edit Job Details'>(Edit this job)</a></h4>

                                <!-- Job Title limit 250 chars-->
                                <p> <?php echo substr($result->jobDescription, 0, 300); ?></p>
                                <p><b>Amount:Ksh <?php echo htmlentities($result->salaryPackage); ?></b></p>

                                <!-- Job Location -->
                                <a href="job-details.php?jobid=<?php echo htmlentities($result->jobId); ?>" class="text" title='View Details'>

                                  <?php echo htmlentities($result->jobLocation); ?>
                                </a>

                                </br></br><!-- Job Posting date -->
                                <a href="job-details.php?jobid=<?php echo htmlentities($result->jobId); ?>" class="text" title='View Details'>
                                  <?php echo htmlentities($result->postinDate); ?>
                                </a>


                              </div>
                            </div>

                            <!-- Job Package -->

                          </div>

                        </li>

                    <?php }
                    } ?>

                  </ul>

                </div>

              </div>



            </div>

          </div>

        </section>

        <!--RECENT JOB SECTION END-->

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