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
 
$user_enter = $commenter_enter= "";

      if(isset($_POST['u_commenter'])){
        $user_enter = $_POST['u_commenter'];
      
      }if(isset($_POST['user_click'])){
       $commenter_enter = $_POST['user_click'];
      }if(isset($_POST['tid'])){
        $tidl = $_POST['tid'];
      }

      if ($commenter_enter) {
           if (empty($user_enter)){
               //echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
               $_SESSION['temp_comm']  = "Please enter a comment.";
            

              }else{
                $sql_comm = "INSERT INTO `comment`(`uid`, `tid`, `body`, `comment_time`) 
                             VALUES ('$user_uid', '$tidl', '$user_enter','$d')";
                $result_user_comm =$conn->query($sql_comm);
                $_SESSION['temp_comm'] = "";
                echo "<meta http-equiv='refresh' content='0;url=home.php'>";
              }
      }
?>