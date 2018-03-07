<?php
include 'config.php';
session_start();

if(isset($_SESSION['username'])){
}

if(isset($_SESSION['uid'])){
}
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
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
  <h1>Inbox</h1>
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
	  <form action="send.php" method="POST" >
        <input type="submit" name="send" value= "Send">
      </form></div>
  </div>

  <div class="main">
    <form action="Inbox.php" method="POST">

	</form>
	
	<?php
	  $sql = "SELECT uid, username
              FROM `user`"; 
      $result = mysqli_query($conn,$sql);
	  while ($row = $result->fetch_assoc()) {
        unset($uid, $username);
        $uid = $row['uid'];
        $username = $row['username']; 
        echo '<option value="'.$uid.'">'.$username.'</option>';
      }


    ?> 
	
  </div>

</body>
</html>