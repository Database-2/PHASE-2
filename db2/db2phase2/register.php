<?php

include 'config.php';

//session_start();

echo "<h1>Sign Up</h1>";
echo "<p>Please fill this form to create an account.</p>";

$username_err = $pwd_err = $email_err = $loca_err = $username_err2 = " ";
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");
$username = $pwd = $email = $location = $submit = "";

if(isset($_POST['username'])){
$username = $_POST['username'];
}
if(isset($_POST['pwd'])){
$pwd = $_POST['pwd'];
}
if(isset($_POST['email'])){
$email = $_POST['email'];
}
if(isset($_POST['location'])){
$location = $_POST['location'];
}
if(isset($_POST['submit'])){
$submit = $_POST['submit'];
}

if ($submit) {
	# code..

if (empty($username)){
	$username_err = "<p>Please enter a username.</p>";
	echo $username_err;
}if (empty($pwd)){
	$pwd_err = "<p>Please enter a password.</p>";
	echo $pwd_err;
}if (empty($email)){
	$email_err = "<p>Please enter a email.</p>";
	echo $email_err;
}if (empty($location)){
	$location_err = "<p>Please enter your location.</p>";
	echo $location_err;
} if( (!empty($username)) && (!empty($pwd)) && (!empty($email)) && (!empty($location)) ) {
	//check for duplicates
	$get_num_username = "SELECT * FROM `user` WHERE `username` = '$username' ";
	$check_for_username = mysqli_query($conn,$get_num_username);
	$get_num_email = "SELECT * FROM `user` WHERE `email` = '$email' ";
	$check_for_email = mysqli_query($conn,$get_num_email);

	if (mysqli_num_rows($check_for_username) > 0) {
		$username_err2 = "This username is already taken.";
		echo $username_err2;
	}elseif (mysqli_num_rows($check_for_email) > 0) {
		$email_err = "This account is already exists.";
		echo $email_err;
	}else {
		///*
		$sql = "INSERT INTO `user`(`username`, `password`, `email`, `location`, `regis_date`)
		VALUES ('$username','$pwd','$email','$location','$d')";
		$result = mysqli_query($conn,$sql);
		//*/
	header("Location: login.php");
	}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
body{ font: 14px sans-serif; }
	.wrapper{ width: 350px; padding: 20px; }
</style>
</head>
<body>	

<div class="wrapper">

<form action="register.php" method="POST">
	<input type="text" name="username" placeholder="Username"><br>
	<input type="text" name="email" placeholder="Email"><br>
	<input type="password" name="pwd" placeholder="Password"><br>
	<input type="text" name="location" placeholder="City, State"><br> 
	<input type="submit" name="submit" value= "Sign Up">
</form>
</div>
</body>
</html>
