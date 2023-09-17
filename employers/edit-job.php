<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if(strlen($_SESSION['emplogin'])==0)
  {
header('location:emp-login.php');
}
else{

//Genrating CSRF Token
if (empty($_SESSION['token2'])) {
    $_SESSION['token2'] = bin2hex(random_bytes(32));
}

if(isset($_POST['update']))
{

//Verifying CSRF Token
if (!empty($_POST['csrftoken2'])) {
if (hash_equals($_SESSION['token2'], $_POST['csrftoken2'])) {

//Getting Jobid
$jobid=intval($_GET['jobid']);
//Geeting Employer Id
$empid=$_SESSION['emplogin'];
//Getting Post Values
$category=$_POST['category'];
$salpackg=$_POST['salarypackage'];
$exprnce=$_POST['experience'];
$joblocation=$_POST['joblocation'];
$jobdesc=$_POST['description'];



$sql="Update tbljobs set jobCategory=:category,salaryPackage=:salpackg,experience=:exprnce,jobLocation=:joblocation,jobDescription=:jobdesc where employerId=:eid and jobId=:jobid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':salpackg',$salpackg,PDO::PARAM_STR);
$query->bindParam(':exprnce',$exprnce,PDO::PARAM_STR);
$query->bindParam(':joblocation',$joblocation,PDO::PARAM_STR);
$query->bindParam(':jobdesc',$jobdesc,PDO::PARAM_STR);
$query->bindParam(':jobid',$jobid,PDO::PARAM_STR);
$query->bindParam(':eid',$empid,PDO::PARAM_STR);
$query->execute();

$msg=" Job updated Successfully";
unset( $_SESSION['token2']);




}}}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Service Providers | Service Posting</title>
<link href="../css/custom.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="../css/responsive.css" rel="stylesheet" type="text/css">
<link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/editor.css" type="text/css" rel="stylesheet"/>
<link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>


</head>

<body class="index">
<div id="wrapper">
<!--HEADER START-->
 <?php include('includes/header.php');?>
<!--HEADER END-->


<?php
//Getting Jobid
$jobid=intval($_GET['jobid']);
//Geeting Employer Id
$empid=$_SESSION['emplogin'];
// Fetching jobs
$sql = "SELECT tbljobs.*,tblemployers.Image from tbljobs join tblemployers on tblemployers.id=tbljobs.employerId  where tbljobs.employerId=:eid and tbljobs.jobId=:jobid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $empid, PDO::PARAM_STR);
$query-> bindParam(':jobid', $jobid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
 ?>

  <section id="inner-banner">

    <div class="container">

      <h1> Edit Job</h1>

    </div>

  </section>



  <div id="main">
    <form name="empsignup" enctype="multipart/form-data" method="post">
<input type="hidden" name="csrftoken2" value="<?php echo htmlentities($_SESSION['token2']); ?>" />


    <section class="resum-form padd-tb">

      <div class="container">
    <!--Success and error message -->
     <?php if(@$error){ ?><div class="errorWrap">
        <strong>ERROR</strong> : <?php echo htmlentities($error);?></div><?php } ?>

        <?php if(@$msg){ ?><div class="succMsg">
        <strong>Success</strong> : <?php echo htmlentities($msg);?></div><?php } ?>

<div class="row">
<div class="col-md-6 col-sm-6" >
<label>Category</label>
  <div class="selector">
       <select name='category' class="full-width">
 <option value="<?php echo htmlentities($result->jobCategory);?>"><?php echo htmlentities($result->jobCategory);?></option>
  <?php
$sqlt = "SELECT CategoryName FROM tblcategory order by CategoryName asc";
$queryt = $dbh -> prepare($sqlt);
$queryt -> execute();
$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($queryt -> rowCount() > 0)
{
foreach($results as $row)
{?>
<option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php  }} ?>

</select>
</div>
</div>

          <div class="col-md-6 col-sm-6">

              <label>Payment</label>
<input type="text" value="<?php echo htmlentities($result->salaryPackage);?>" name="salarypackage" required>

            </div>
            </div>


<div class="row">

<div class="col-md-6 col-sm-6">
<label>Experience</label>
<input type="text" value="<?php echo htmlentities($result->experience);?>" name="experience" required>
</div>

<div class="col-md-6 col-sm-6">
<label>Service Location</label>
<input type="text" value="<?php echo htmlentities($result->jobLocation);?>" name="joblocation" required>
</div>
</div>


<div class="row">
 <div class="col-md-12">
<h4>Service Description</h4>
<div class="text-editor-box">
<textarea  name="description"  autocomplete="off" ><?php echo htmlentities($result->jobDescription);?></textarea>
</div>

</div>
</div>

<?php }} ?>

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


<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.velocity.min.js"></script>
<script src="../js/jquery.kenburnsy.js"></script>
<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../js/editor.js"></script>
<script src="../js/jquery.accordion.js"></script>
<script src="../js/jquery.noconflict.js"></script>
<script src="../js/theme-scripts.js"></script>
<script src="../js/custom.js"></script>

</body>

</html>
<?php } ?>
