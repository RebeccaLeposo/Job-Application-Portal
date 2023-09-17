<?php
session_start();
error_reporting(0);

include('includes/config.php');
?>
<!doctype html>

<html lang="en-US">

<head>

  <meta charset="utf-8">
  <title>PataKazi || Home Page</title>
  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/prettyPhoto.css" rel="stylesheet" type="text/css">
  <link href="css/responsive.css" rel="stylesheet" type="text/css">
  <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
</head>

<body class="index">

  <div id="wrapper">

    <?php include_once('includes/header.php'); ?>
    <section id="hero" class="d-flex align-items-center">

      <div class="container">
        <div class="row">
          <div class="col-lg-12 justify-content-center text-center">
            <h1 style="color:#fff;">JOP APLLICATION PLATFORM</h1>
          </div>
          <div class="row">
            <div class="col-lg-6 pt-4 d-flex flex-column justify-content-center">
              <div class="btn-get-started"><a href="job-search.php">Search Here</a></div>
              </br><?php if (strlen($_SESSION['jsid'] == 0)) { ?>
                <div class="btn-get-started"><a href="sign-up.php">Are you JOB seeking?</a></div>
                <div class="btn-get-started"><a href="employers/employers-signup.php">Are you hiring?</a> </div>
              <?php } ?>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
              <img src="css/img.png" class="img-fluid" alt="">
            </div>
          </div>
        </div>

    </section><!-- End Hero -->

    <section class="about">

      <div class="container">
        <div class="box">
          <h2>About Us</h2>
          <h4 style="line-height: 30px; padding:5px;">PataKazi is a Connected Workforce Platform that mobilizes the service providers and service seekers through a digitized platform with day-to-day tasks and provides real-time visibility into all areas of operation. We provide the platform with total transparency and connectivity, executives will have the additional services for our users. This platform will transform the untapped possibilities into tangible solutions and competitive advantage comparing to the current workforce system around the world</h4>
        </div>
      </div>

    </section>


    <!--MAIN START-->

    <div id="main">

      <section class="popular-categories">

        <div class="container">

          <div class="clearfix">

            <h2>Popular Domestic Work Categories</h2>

          </div>

          <div class="row">
            <?php
            $sql = "SELECT jobCategory,count(jobId) as totaljobs from tbljobs group by jobCategory";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            foreach ($results as $row) {               ?>
              <div class="col-md-3 col-sm-6">

                <div class="box">

                  <h4><a href="view-categorywise-job.php?viewid=<?php echo htmlentities($row->jobCategory); ?>"><?php echo htmlentities($row->jobCategory); ?></a></h4>

                  <strong><?php echo htmlentities($row->totaljobs); ?></strong>

                </div>

              </div>
            <?php } ?>

          </div>

        </div>

      </section>

      <!--POPULAR JOB CATEGORIES END-->



      <!--RECENT JOB SECTION START-->

      <section class="recent-row padd-tb" id="recent-row">

        <div class="container">

          <div class="row">

            <div class="col-md-12 col-sm-12">

              <div id="content-area">

                <h2>Recent Works</h2>

                <ul id="myList">

                  <li>
                    <?php
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
                    $sql = "SELECT tbljobs.*,tblemployers.Image,tblemployers.Name from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId LIMIT $offset, $no_of_records_per_page";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                      foreach ($results as $row) {               ?>
                        <div class="box">

                          <div class="thumb">
                            <a href="jobs-details.php?jobid=<?php echo ($row->jobId); ?>"><img src="employers/employerslogo/<?php echo $row->Image; ?>" width="100" height="100"></a>
                          </div>

                          <div class="text-col">

                            <h4><a href="jobs-details.php?jobid=<?php echo ($row->jobId); ?>"><?php echo htmlentities($row->jobCategory); ?></a></h4>

                            <p><?php echo htmlentities($row->Name); ?></p>

                            <a href="jobs-details.php?jobid=<?php echo ($row->jobId); ?>" class="text">Address : <?php echo htmlentities($row->jobLocation); ?></a> </br> <a href="#" class="text">Posted Date : <?php echo htmlentities($row->postinDate); ?> </a>
                          </div>

                          <strong class="price">Amount :Ksh <?php echo htmlentities($row->salaryPackage); ?> <?php echo htmlentities($row->Pay); ?></strong>

                        </div>

                  </li>

              <?php $cnt = $cnt + 1;
                      }
                    } ?>


                </ul>

                <div align="left">
                  <ul class="pagination">

                    <li <?php if ($page_no <= 1) {
                          echo "class='disabled'";
                        } ?>>
                      <a <?php if ($page_no > 1) {
                            echo "href='?page_no=$previous_page'";
                          } ?>>Previous</a>
                    </li>

                    <?php
                    if ($total_no_of_pages <= 10) {
                      for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                        if ($counter == $page_no) {
                          echo "<li class='active'><a>$counter</a></li>";
                        } else {
                          echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                        }
                      }
                    } elseif ($total_no_of_pages > 10) {

                      if ($page_no <= 4) {
                        for ($counter = 1; $counter < 8; $counter++) {
                          if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                          } else {
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                          }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                      } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                        echo "<li><a>...</a></li>";
                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                          if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                          } else {
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                          }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                      } else {
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                        echo "<li><a>...</a></li>";

                        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                          if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                          } else {
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                          }
                        }
                      }
                    }
                    ?>

                    <li <?php if ($page_no >= $total_no_of_pages) {
                          echo "class='disabled'";
                        } ?>>
                      <a <?php if ($page_no < $total_no_of_pages) {
                            echo "href='?page_no=$next_page'";
                          } ?>>Next</a>
                    </li>
                    <?php if ($page_no < $total_no_of_pages) {
                      echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                    } ?>
                  </ul>
                </div>

              </div>

            </div>

          </div>

        </div>

      </section>

      <!--RECENT JOB SECTION END-->
      <section class="about">

        <div class="container">

          <h2>Contact Us</h2>

          <div class="col-md-3 col-sm-6">

            <div class="box">

              <h4>Phone Number</h4>

              <strong>+254-798 222 717</strong>

            </div>

          </div>
          <div class="col-md-3 col-sm-6">

            <div class="box">

              <h4>Email</h4>

              <strong>mykbechuana@gmail.com</strong>

            </div>

          </div>
          <div class="col-md-3 col-sm-6">

            <div class="box">

              <h4><i class="bi bi-geo-alt-fill"></i>Address</h4>

              <strong>Juja</strong>

            </div>

          </div>

        </div>

      </section>

    </div>

    <!--MAIN END-->



    <!--FOOTER START-->
    <?php include_once('includes/footer.php'); ?>
    <!--FOOTER END-->

  </div>

  <!--WRAPPER END-->



  <!--jQuery START-->

  <!--JQUERY MIN JS-->

  <script src="js/jquery-1.11.3.min.js"></script>

  <!--BOOTSTRAP JS-->

  <script src="js/bootstrap.min.js"></script>

  <!--OWL CAROUSEL JS-->

  <script src="js/owl.carousel.min.js"></script>

  <!--BANNER ZOOM OUT IN-->

  <script src="js/jquery.velocity.min.js"></script>

  <script src="js/jquery.kenburnsy.js"></script>

  <!--SCROLL FOR SIDEBAR NAVIGATION-->

  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

  <!--CUSTOM JS-->

  <script src="js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</body>

</html>