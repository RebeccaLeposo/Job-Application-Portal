<?php
require_once("includes/config.php");

if(!empty($_POST["nic"])) {
	$nic= $_POST["nic"];
	if (filter_var($nic, FILTER_VALIDATE_EMAIL)===false) {

		echo "error : You did not enter a valid email.";
	}
else {
$sql ="SELECT Email FROM tblemployers WHERE Email=:nic";
$query= $dbh -> prepare($sql);
$query-> bindParam(':nic', $nic, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Email already exists</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{

	echo "<span style='color:green'> Email available</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
