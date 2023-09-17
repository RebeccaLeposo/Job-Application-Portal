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
else{
if(isset($_POST['update']))
{
//Getting Post Values
$FullName=$_POST['fname'];
//Getting User Id
$uid=$_SESSION['jsid'];

$sql="update  tbljobseekers set FullName=:fname where id=:uid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query-> bindParam(':fname', $FullName, PDO::PARAM_STR);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Account detail has been updated")</script>';
    echo "<script>window.location.href ='profile.php'</script>";


}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User | Update Account Details</title>
<link href="css/custom.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="css/responsive.css" rel="stylesheet" type="text/css">
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/editor.css" type="text/css" rel="stylesheet"/>
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>

<body class="index">
<div id="wrapper">
<!--HEADER START-->
 <?php include('includes/header.php');?>
<!--HEADER END-->


  <!--INNER BANNER START-->
  <section id="inner-banner">

    <div class="container">

      <h1>User Account Details</h1>

    </div>

  </section>

  <!--INNER BANNER END-->



  <!--MAIN START-->

  <div id="main">
    <!--Signup FORM START-->
    <form name="" enctype="multipart/form-data" method="post">
    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->

     <?php if(@$error){ ?><div class="errorWrap">
        <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>Success</strong> : <?php echo htmlentities($msg);?></div><?php } ?>

          <div class="row">
<?php
//Getting Employer Id
$uid=$_SESSION['jsid'];
// Fetching jobs
$sql = "SELECT * from  tbljobseekers  where id=:uid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{


 ?>



<div class="col-md-6 col-sm-6">
<label>Full Name *</label>
<input type="text" name="fname" placeholder="Full Name" required autocomplete="off" value="<?php echo htmlentities($result->FullName)?>" />
</div>

<div class="col-md-6 col-sm-6">
<label>Your Email *</label>
<input type="email" name="emailid" readonly="true"  autocomplete="off" value="<?php echo htmlentities($result->EmailId)?>">
</div>

<div class="col-md-6 col-sm-6">
<label>Contact Number</label>
<input type="text" name="contactnumber" autocomplete="off" value="<?php echo htmlentities($result->ContactNumber)?>" readonly="true" >

 <br>
<?php if($result->ProfilePic!=""):?>
<img src="images/<?php echo $result->ProfilePic;?>" width="100" height="100" value="<?php  echo $result->ProfilePic;?>">
<br />
<?php endif; ?>
<p style="padding-top: 20px"><a href="change-profilepics.php">Change Profile Pic</a></p>
</div>

<div class="col-md-6 col-sm-6">

<label>Registration Date</label>
 <input type="text" name="regdate" readonly="true" autocomplete="off" value="<?php echo htmlentities($result->RegDate)?>">
</div>

</div>
<?php
}}
?>

            <div class="col-md-12">

              <div class="btn-col">

                <input type="submit" name="update" value="Update">

              </div>

            </div>

          </div>



      </div>

    </section>
    </form>
    <!--RESUME FORM END-->

  </div>

  <!--MAIN END-->

</div>


<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.velocity.min.js"></script>
<script src="js/jquery.kenburnsy.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/editor.js"></script>
<script src="js/jquery.accordion.js"></script>
<script src="js/jquery.noconflict.js"></script>
<script src="js/theme-scripts.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
<?php }
?>
