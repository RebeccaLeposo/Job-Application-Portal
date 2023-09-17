<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['jsid'] == 0)) {
  header('location:job-details.php');
} else {
  if (isset($_POST['comment'])) {
    $jobid = intval($_GET['jobid']);
    $userid = $_SESSION['jsid'];
    $content = $_POST['content'];

    $sql = "INSERT INTO comment (user_id,Jobid,content) VALUES(:userid,:jobid,:content)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':jobid', $jobid, PDO::PARAM_STR);
    $query->bindParam(':userid', $userid, PDO::PARAM_STR);
    $query->bindParam(':content', $content, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
      $msg = "Successfully Commented";
    } else {
      $error = "Something went wrong. Please try again";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PataKazi Comment</title>

    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>


  </head>

  <body>


    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="container">
            <form name="comment" method="post">
              <div class="input-group">
                <textarea class="form-control" placeholder="comment" type="text" name="content"></textarea>
                <?php if ($_SESSION['jsid']) { ?>
                  <button type="submit" value="comment" name="comment" class="btn btn-primary btn-hover-green">Post Your Comment</button>
                <?php } else { ?>
                  <a href="job-details.php" class="btn-primary btn">Comment</a></li>
                <?php } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>




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

    <!--FOR CHECKBOX-->

    <script src="js/form.js"></script>

    <!--CUSTOM JS-->

    <script src="js/custom.js"></script>

  </body>

  </html>
<?php }  ?>