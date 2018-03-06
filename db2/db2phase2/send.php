<?php
include 'config.php';
session_start();

//get data and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");

if(isset($_SESSION['username'])){
 // $get_id_username = "SELECT uid FROM `user` WHERE `username` = $_SESSION[$username]";
 // echo $get_id_username;
//echo $_SESSION['username'];

}

if(isset($_SESSION['uid'])){
}

// Set up user ids for message sending
$user_uid = $receiver_uid = "";
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
}
if(isset($receiver_uid)){
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}
.menu {
  float: left;
  width: 20%;
}
.menuitem {
  padding: 8px;
  margin-top: 7px;
  border-bottom: 1px solid #f1f1f1;
}
.main {
  float: left;
  width: 60%;
  padding: 0 20px;
  overflow: hidden;
}
.right {
  background-color: lightblue;
  float: left;
  width: 20%;
  padding: 10px 15px;
  margin-top: 7px;
}
.topright {
  position:absolute;
  top:5px;
  right:5px;
}


@media only screen and (max-width:800px) {
  /* For tablets: */
  .main {
    width: 80%;
    padding: 0;
  }
  .right {
    width: 100%;
  }
  .topcorner{
    width: 100%;
  }
}
@media only screen and (max-width:500px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width: 100%;
  }
}
</style>
</head>
<body style="font-family:Verdana;">

<div class="topright">
  <form action="logout.php" method="POST">
    <input type="submit" name="logout" value= "Sign Out">
  </form>  
  </div>

<div class="topcorner">
  <form action="home.php" method="POST">
    <input type="submit" name="home" value= "Home">
  </form>  
  </div>

<div style="background-color:#ffffff;padding:15px;">
  <center>
  <h1>Send Message</h1>
  </center>
</div>


<div style="overflow:auto">
  <div class="menu">
    <?php
        echo "Welcome, " .$_SESSION['username']. "!";
    ?>
    
    <!-- <div class="menuitem">
      <form action="profile.php" method="POST">
            <input type="submit" name="profile" value= "My Profile">
      </form>  
    </div> -->

    <div class="menuitem">Follwers
    <output name="Follower" for= "followers"></output></div>
    <div class="menuitem">Follwing
    <output name="Following" for= "following"></output></div>
    <div class="menuitem">Message
	  <form action="inbox.php" method="POST" >
        <input type="submit" name="inbox" value= "Inbox">
      </form></div>
  </div>

  <div class="main">
    <form action="send.php" method="POST">
      <div class="block">
        <label>To:<label></br>
	    <input type="text" name ="user_rec" />
      </div>
	  <div class="block">
        </br><label>Mesage:<label></br>
	    <textarea name="user_mes" style="resize:none" rows="4" cols="50" maxlength="200" ></textarea>
      </div>
	  <input type="submit" name="send_mes" value= "Send Message">
	</form>
	
	<?php
      $search = $user_name ="";

      if(isset($_POST['user_rec'])){
        $user_name = $_POST['user_rec'];
      }
      if(isset($_POST['send_mes'])){
        $search = $_POST['send_mes'];
      }
  
      if ($search) {
        $sql = "SELECT user.uid
                FROM `user` 
                WHERE user.username = '$user_name'"; 
        $result = mysqli_query($conn,$sql);
		
      if($result->num_rows > 0){
		$row = mysqli_fetch_assoc($result);  
		$receiver_uid = $row["uid"];
		$user_mes = $_POST['user_mes'];
		
	    $sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `body`, `send_time`)
		VALUES ('$user_uid','$receiver_uid','$user_mes','$d')";
		$result = mysqli_query($conn,$sql);
      } else {
          echo "No result";
        }
      } 
    ?> 
	
  </div>

</body>
</html>