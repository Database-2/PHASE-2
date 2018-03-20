<?php
include 'config.php';
session_start();

echo "<h2>Sign In</h2>";
echo "<p>Please enter your username and password.</p>";

$uid = $username = $pwd = $login = "";

if(isset($_POST['uid'])){
}
if(isset($_POST['username'])){
$username = $_POST['username'];
}
if(isset($_POST['pwd'])){
$pwd = $_POST['pwd'];
}
if(isset($_POST['login'])){
$login = $_POST['login'];
}
if ($login) {
	if (empty($username)){
		$username_err = "<p>Please enter a username.</p>";
		echo $username_err;
	}if (empty($pwd)){
		$pwd_err = "<p>Please enter a password.</p>";
		echo $pwd_err;
	}if( (!empty($username)) && (!empty($pwd))){
		# code..
		$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$pwd'";
		$result = mysqli_query($conn,$sql); 
		if(!$row = mysqli_fetch_assoc($result)){
		echo "You username or password in incorrect";
		}else {
		//echo "You are logged in!";
		$_SESSION['username']=$username;
		$sql = "SELECT user.uid
               FROM `user` 
               WHERE user.username = '$username'"; 
        $result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$_SESSION['uid']=$row["uid"];
		$_SESSION['receiver'] = "";		
		header("Location: home.php");

	}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign In</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
body{ font: 14px sans-serif; }
	.wrapper{ width: 350px; padding: 20px; }
</style>
</head>
<body>	

<div class="wrapper">

<form action="login.php" method="POST">
	<input type="text" name="username" placeholder="Username"><br>
	<input type="password" name="pwd" placeholder="Password"><br>
    <input type="submit"  name= "login" value="Login"><br>
    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
</form>
</div>
</body>
</html>