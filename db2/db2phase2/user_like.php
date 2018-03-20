<?php
include 'config.php';
session_start();

// Set up user and ids 
if(!isset($_SESSION['uid'])){
  header("Location: login.php");
  exit();
}
$user_uid = "";
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
}

	if( isset($_GET['lik']) )
	{
	$lik_tid = $_GET['lik'];
	// check for duplicates 
	// for  likes
	$get_num_like = "SELECT count(*) FROM `thumb` WHERE `uid` = $user_uid AND `tid` = $lik_tid";
	$check_for_like = mysqli_query($conn,$get_num_like);

	//
	//
	$get_num_dislike = "SELECT count(*) FROM `dislike` WHERE `uid` = $user_uid AND `tid` = $lik_tid";
	$check_for_dislike = mysqli_query($conn,$get_num_dislike);

		if (mysqli_num_rows($check_for_like) > 0) {
			echo "<meta http-equiv='refresh' content='0;url=home.php'>";
		}elseif (mysqli_num_rows($check_for_dislike) > 0) {

		$sqldis = "	DELETE FROM `dislike` WHERE `uid` = $user_uid AND `tid` = lik_tid";
		$resdis = mysqli_query($conn,$sqldis) or die("Failed".mysqli_error());

		$sqlil= "INSERT INTO `thumb`(`uid`, `tid`) 
				VALUES ('$user_uid','$lik_tid')";
		$resil= mysqli_query($conn,$sqlil) or die("Failed".mysqli_error());
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";
			
		}else {

		$sqlili= "INSERT INTO `thumb`(`uid`, `tid`) 
				VALUES ('$user_uid','$lik_tid')";
		$resili= mysqli_query($conn,$sqlili) or die("Failed".mysqli_error());
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";
		}
	}

	
?>