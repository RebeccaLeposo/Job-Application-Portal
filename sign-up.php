<?php
session_start();
//Database Configuration File
include('includes/config.php');
error_reporting(0);
if (isset($_POST['signup'])) {
  //Getting Post Values
  $fname = $_POST['fullname'];
  $emaill = $_POST['emailid'];
  $cnumber = $_POST['contactnumber'];
  //Password hashing
  $password = $_POST['jspassword'];
  $options = ['cost' => 12];
  $hashedpass = password_hash($password, PASSWORD_BCRYPT, $options);

  // Query for validation of  email-id
  $ret = "SELECT * FROM  tbljobseekers where (EmailId=:uemail || ContactNumber=:cnumber)";
  $queryt = $dbh->prepare($ret);
  $queryt->bindParam(':uemail', $emaill, PDO::PARAM_STR);
  $queryt->bindParam(':cnumber', $cnumber, PDO::PARAM_STR);
  $queryt->execute();
  $results = $queryt->fetchAll(PDO::FETCH_OBJ);
  if ($queryt->rowCount() == 0) {
    // Query for Insertion
    $isactive = 1;
    $sql = "INSERT INTO tbljobseekers(FullName,EmailId,ContactNumber,Password,IsActive) VALUES(:fname,:emaill,:cnumber,:hashedpass,:isactive)";
    $query = $dbh->prepare($sql);
    // Binding Post Values
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':emaill', $emaill, PDO::PARAM_STR);
    $query->bindParam(':cnumber', $cnumber, PDO::PARAM_STR);
    $query->bindParam(':hashedpass', $hashedpass, PDO::PARAM_STR);
    $query->bindParam(':isactive', $isactive, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
      echo "<script>alert('Signup Successfully');</script>";
      echo "<script type='text/javascript'> document.location ='sign-in.php'; </script>";
    } else {
      $error = "Something went wrong.Please try again";
    }
  } else {
    $error = "Email-id or Contact Number already exist. Please try again";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Service Seeker | Signup</title>
  <link href="css/custom.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

  <link href="css/responsive.css" rel="stylesheet" type="text/css">
  <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/editor.css" type="text/css" rel="stylesheet" />
  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
  <script type="text/javascript">
    function checkpass() {
      if (document.empsignup.password.value != document.empsignup.confirmpassword.value) {
        alert('Password and Confirm Password field does not match');
        document.empsignup.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

  <script>
    function useremailAvailability() {

      jQuery.ajax({
        url: "check_availability.php",
        data: 'emailid=' + $("#emailid").val(),
        type: "POST",
        success: function(data) {
          $("#user-emailavailability-status").html(data);
        },
        error: function() {}
      });
    }
  </script>
</head>

<body class="index">
  <div id="wrapper">

    <?php include('includes/header.php'); ?>


    <section id="inner-banner">

      <div class="container">

        <h1>Service Seeker Signup</h1>

      </div>

    </section>


    <div id="main">




      <!--Signup FORM START-->
      <form name="empsignup" enctype="multipart/form-data" method="post" onsubmit="return checkpass();">
        <section class="resum-form padd-tb">

          <div class="container">
            <!--Success and error message -->
            <?php if (@$error) { ?><div class="errorWrap">
                <strong>ERROR</strong> : <?php echo htmlentities($error); ?>
              </div><?php } ?>

            <?php if (@$msg) { ?><div class="succMsg">
                <strong>Success</strong> : <?php echo htmlentities($msg); ?>
              </div><?php } ?>

            <div class="row">

              <div class="col-md-6 col-sm-6">
                <label>Full Name</label>
                <input type="text" name="fullname" placeholder="Full Name" required autocomplete="off" />
              </div>

              <div class="col-md-6 col-sm-6">
                <label>Password</label>
                <input type="password" name="jspassword" id="password" placeholder="e.g. “Abc9986”" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required>
              </div>

              <div class="col-md-6 col-sm-6">
                <label>Your Email</label>
                <input type="email" name="emailid" id="emailid" onBlur="useremailAvailability()" placeholder="example@gmail.com" autocomplete="off" required>
                <span id="user-emailavailability-status" style="font-size:12px;"></span>
              </div>

              <div class="col-md-6 col-sm-6">
                <label>Confirm Password</label>
                <input type="password" name="jspassword" id="confirmpassword" placeholder="e.g. “Abc9986”" autocomplete="off" required>
              </div>

              <div class="col-md-6 col-sm-6">
                <label>Contact Number</label>
                <input type="text" name="contactnumber" id="contactnumber" onBlur="usercontactnoAvailability()" placeholder="e.g. 1234567890" autocomplete="off" pattern="[0-9]+" title="only numeric digit allowed. Limits 10" maxlength="10" required>
                <span id="user-availability-status1" style="font-size:12px;"></span>
              </div>

              <div class="col-md-12">

                <input type="submit" name="signup" id="submit" value="Sign up">

              </div>
              <div class="col-md-2">
                <p>Already Have account?</p>
                <button class="btn-row"><a href="sign-in.php">Sign in Now</a></button>
              </div>
            </div>



          </div>

        </section>
      </form>
      <!--RESUME FORM END-->

    </div>

    <!--MAIN END-->



    <!--FOOTER START-->

    <?php include('includes/footer.php'); ?>
    <!--FOOTER END-->

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