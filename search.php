<?php
session_start();
error_reporting(0);

include('includes/config.php');
$jobid = $_GET['jobid'];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PataKazi || Home Page</title>
  <!--CUSTOM CSS-->
  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <!--BOOTSTRAP CSS-->
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <!--COLOR CSS-->
  <!--RESPONSIVE CSS-->
  <link href="css/responsive.css" rel="stylesheet" type="text/css">
  <!--OWL CAROUSEL CSS-->
  <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
  <!--FONTAWESOME CSS-->
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!--SCROLL FOR SIDEBAR NAVIGATION-->
  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
  <!--FAVICON ICON-->
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <!--GOOGLE FONTS-->
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>

</head>

<body class="index">

  <div id="wrapper">

    <!--HEADER START-->
    <?php include_once('includes/header.php'); ?>
    <!--HEADER END-->

    <!--MAIN START-->

    <div id="wrapper" class="job-search">

      <form action="job-search.php" method="post">

        <div class="container">

          <div class="row">

            <div class="col-md-5 col-sm-5">

              <input type="date" placeholder="Select date" name="edate">

            </div>
            <div class="col-md-5 col-sm-5">

              <input type="text" placeholder="Enter Time" name="etime">

            </div>

            <div class="col-md-2 col-sm-2">

              <button class="btn-row" type="submit" name="search">Search</button>

            </div>

          </div>

        </div>

      </form>

      <section class="recent-row padd-tb">

        <div class="container">

          <div class="row">

            <div class="col-md-12 col-sm-8">

              <div id="content-area">

                <ul id="myList">

                  <li>
                    <?php
                    $jobid = $_GET['jobid'];

                    $sql = "SELECT Edate,Etime from tblapplyjob where JobId=:jobid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':edate', $edate, PDO::PARAM_STR);
                    $query->bindParam(':etime', $etime, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                      foreach ($results as $row) {               ?>


                        <div class="box">

                          <div class="thumb"><a href="jobs-details.php?jobid=<?php echo ($row->jobId); ?>"><img src="employers/employerslogo/<?php echo $row->Image; ?>" width="100" height="100"></a></div>

                          <div class="text-col">

                            <h4><a href="jobs-details.php?jobid=<?php echo ($row->jobId); ?>"><?php echo htmlentities($row->jobCategory); ?></a></h4>

                            <p><?php echo htmlentities($row->Name); ?></p>

                            <a href="jobs-details.php?jobid=<?php echo ($row->jobId); ?>" class="text">Location: <?php echo htmlentities($row->jobLocation); ?></a></br> <a href="#" class="text">Calender: <?php echo htmlentities($row->postinedate); ?> </a>
                          </div>

                          <strong class="price">Amount:Ksh <?php echo htmlentities($row->salaryPackage); ?> <?php echo htmlentities($row->Pay); ?></strong>
                        </div>

                  </li>

                <?php
                        $cnt = $cnt + 1;
                      }
                    } else { ?>

                <h4> No record found against this search</h4>


              <?php } ?>


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

</body>

</html>