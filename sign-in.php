<?php
session_start();

include('includes/config.php');
error_reporting(0);
if (isset($_POST['signin'])) {

  $uname = $_POST['emailmbile'];
  $password = $_POST['password'];

  $sql = "SELECT id,FullName,Password FROM tbljobseekers WHERE (EmailId=:usname || ContactNumber=:usname)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':usname', $uname, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    foreach ($results as $row) {
      $dbhashpass = $row->Password;
      $_SESSION['jsid'] = $row->id;
      $_SESSION['jsfname'] = $row->FullName;
    }
    //verifying Password
    if (password_verify($password, $dbhashpass)) {
      echo "<script type='text/javascript'> document.location ='my-profile.php'; </script>";
    } else {
      echo "<script type='text/javascript'> document.location ='my-profile.php'; </script>";
    }
  }
  //if username or email not found in database
  else {
    echo "<script>alert('User not registered with us');</script>";
  }
}
?>

<!doctype html>

<html lang="en">

<head>
  <title>Service Seeker SignIn | PataKazi </title>

  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

  <link href="css/responsive.css" rel="stylesheet" type="text/css">
  <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
</head>



<body class="index">

  <!--WRAPPER START-->

  <div id="wrapper">

    <?php include('includes/header.php'); ?>
    <!--HEADER END-->

    <section id="inner-banner">
      <div class="container">
        <h1>Service Seeker Login</h1>
      </div>
    </section>



    <div id="main">

      <section class="signup-section">

        <div class="container">

          <div class="holder">

            <form method="post" name="emplsignin">

              <div class="input-box">

                <input type="text" placeholder="Email-Id" name="emailmbile" autocomplete="off" required>

              </div>

              <div class="input-box">
                <input type="password" class="form-control" name="password" required placeholder="Password">

              </div>


              <div class="input-box">
                <input type="submit" value="Sign in" name="signin">
              </div>

              <a href="forgetpassword.php" class="login">Forgot your Password</a>

              <div class="login-social">
                <p>Don't you have an Account? <a href="sign-up.php">SIGN UP NOW</a></p>
              </div>
              <a href="index.php" class="login">Back Home</a>

            </form>

          </div>

        </div>

      </section>

      <!--SIGNUP SECTION END-->



    </div>

  </div>

  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.velocity.min.js"></script>
  <script src="js/jquery.kenburnsy.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/jquery.noconflict.js"></script>
  <script src="js/theme-scripts.js"></script>
  <script src="js/form.js"></script>
  <script src="js/custom.js"></script>

</body>

</html>