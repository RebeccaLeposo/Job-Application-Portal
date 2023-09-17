<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if(strlen($_SESSION['jsid'])==0)
  {
header('location:logout.php');
}
else{ ?>
<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Service Seeker | Profile </title>

<link href="css/custom.css" rel="stylesheet" type="text/css">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="css/responsive.css" rel="stylesheet" type="text/css">

<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>

</head>



<body class="index">

<div id="wrapper">

 <?php include('includes/header.php');?>

  <section id="inner-banner">

    <div class="container">

      <h1><?php echo htmlentities($_SESSION['jsfname']);?>'s Profile</h1>

    </div>

  </section>

  <div id="main">

    <section class="resumes-section padd-tb">

      <div class="container">

        <div class="row">

          <div class="col-md-12 col-sm-8">

            <div class="resumes-content">

              <div class="box">

                <div class="frame">
                  <?php
//Getting User Id
$jsid=$_SESSION['jsid'];
// Fetching User Details
$sql = "SELECT * from  tbljobseekers  where id=:jobid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':jobid', $jsid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{
 ?><a href="#"><img src="images/<?php echo $result->ProfilePic;?>" width="100" height="100" alt="img"></a></div>




     <div class="text-box">

                  <h2><a href="#"><?php echo htmlentities($_SESSION['jsfname']);?></a></h2>


                  <h4>Reg Date: <?php echo htmlentities($result->RegDate);?></h4>

                  <div class="clearfix"> <strong>Email : <?php echo htmlentities($result->EmailId);?></strong></br> <strong>
                    Mobile : <a href="#"><?php echo htmlentities($result->ContactNumber);?></a></strong> </div>

                  <div class="btn-row"><a href="profile.php" class="login">Edit Profile</a></div>

                </div>


              </div>

<?php } ?>

            </div>

          </div>



        </div>

      </div>

    </section>

    <!--RECENT JOB SECTION END-->

  </div>

  <!--MAIN END-->

</div>

<!--WRAPPER END-->




<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.velocity.min.js"></script>
<script src="js/jquery.kenburnsy.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/form.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
<?php } ?>
