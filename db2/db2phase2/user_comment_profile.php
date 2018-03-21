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

//get data and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");
 
 	
	if( isset($_GET['commm']) )
	{
	$tidl = $_GET['commm'];
	}

	if( isset($_GET['text_c']) ){
    $user_enter = $_GET['text_c'];
	}
	if(!isset($_GET['text_c'])){
  		$user_enter = $_SESSION['temp_comm'];  
	}
	if(isset($user_enter)){
 		 $_SESSION['temp_comm'] = $user_enter;
 		 $user_enter = $_SESSION['temp_comm'];
	}
     // if(isset($_POST['commenter'])){
      //  $user_enter = $_POST['commenter'];
      //}if(isset($_POST['enter_comm'])){
       //$commenter_enter = $_POST['enter_comm'];
     // } 
      //if ($commenter_enter) {
           //if (empty($user_enter)){
               //echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
               //$comm_err = "<p>Please enter a comment.</p>";
               //echo $comm_err;

              //}else{
                $sql_comm = "INSERT INTO `comment`(`uid`, `tid`, `body`, `comment_time`) 
                             VALUES ('$user_uid', '$tidl', '$user_enter','$d')";
                $result_user_comm =$conn->query($sql_comm);
                $_SESSION['temp_comm'] = "";
                echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
              //}
      //}
	//}
?>