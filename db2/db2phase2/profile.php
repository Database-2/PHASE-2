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
  <h1>Twitter</h1>
  </center>
</div>


<div style="overflow:auto">
  <div class="menu">
    <?php
        echo "Welcome, " .$_SESSION['username']. "!";
    ?>

    <div class="menuitem">Follwers
    <output name="Follower" for= "followers"></output></div>
    <div class="menuitem">Follwing
    <output name="Following" for= "following"></output></div>
    <div class="menuitem">Message
	  <div>
	    <form action="inbox.php" method="POST" style='display:inline;'>
          <input type="submit" name="inbox" value= "Inbox">
        </form>
	    <form action="send.php" method="POST" style='display:inline;'>
          <input type="submit" name="send" value= "Send">
        </form>
	  </div>
	</div>
  </div>

  <div class="main">
    <h2>Post</h2>
     <form action="profile.php" method="POST" >
      <textarea name="userpost" style="resize:none" rows="4" cols="50" maxlength="200" placeholder ="What's on your mind?" > </textarea><br />
      <input type="submit" name="proses" value= "Post">
  	  </form> 
 <?php

// create user's post
  $user_post = $proses = $user_post_err = "";
  if (isset($_POST['proses'])){
      $user_post = nl2br($_POST['userpost']); 
   if (!strlen(trim($user_post))){
        $user_post_err = "<p>Please enter something.</p>";
        echo $user_post_err;
   }else {

      $sqla = "INSERT INTO `twitts`(`uid`, `body`, `post_time`)
              VALUES ('$user_uid','$user_post','$d')";
      $resulta = mysqli_query($conn,$sqla);
    }        
 }

// display user's post only
  $sql ="SELECT username, body, post_time  
         FROM user, twitts
         WHERE twitts.uid = user.uid
               AND user.uid = $user_uid
         ORDER By post_time DESC";

  $result =$conn->query($sql);

  if($result->num_rows > 0){
    $num_like ="Likes";
    $num_dislike = "Dislike";

    while ($row = $result->fetch_assoc()) {
      $current_username = $row["username"];
      $date = $row["post_time"];
      $body = $row["body"];
      $likes = "3";
      $dislike = "2";
      echo "<ul style='list-style-type:none'>";
      echo "<li>".$current_username." ".$date. " <input type='submit' name='del' value= 'delete'> </li>";
      echo "<li>".$body."</li>";
      echo "<li>" .$num_like. " " .$likes. " " .$num_dislike. " " .$dislike. "</li>";
      echo "</ul>";
     }
  }else {
     echo "No result";
      }
      
      ?> 

      </div>
</body>
</html>