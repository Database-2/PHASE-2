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

	if( isset($_GET['disl']) )
	{
	$disk_tid = $_GET['disl'];
	// check for duplicates 
	// for  likes
	$get_num_dislike = "SELECT * FROM `dislike` WHERE `uid` = $user_uid AND `tid` = $disk_tid";
	$check_for_dislike = mysqli_query($conn,$get_num_dislike);

	//
	//
	$get_num_like = "SELECT * FROM `thumb` WHERE `uid` = $user_uid AND `tid` = $disk_tid";
	$check_for_like = mysqli_query($conn,$get_num_like);

		if (mysqli_num_rows($check_for_dislike) > 0) {
			echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
		}elseif (mysqli_num_rows($check_for_like) > 0) {

		$sqllis = "	DELETE FROM `thumb` WHERE `uid` = $user_uid AND `tid` = $disk_tid";
		$reslis = mysqli_query($conn,$sqllis); //or die("Failed".mysqli_error());
		
		$sqldis= "INSERT INTO `dislike`(`uid`, `tid`) 
				VALUES ('$user_uid','$disk_tid')";
		$resdis= mysqli_query($conn,$sqldis) or die("Failed".mysqli_error());
		echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
			
		}else {

		$sqldisl= "INSERT INTO `dislike`(`uid`, `tid`) 
				VALUES ('$user_uid','$disk_tid')";
		$resdisl= mysqli_query($conn,$sqldisl) or die("Failed".mysqli_error());
		echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
		}
	}

	
?>