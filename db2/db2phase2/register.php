<?php

include 'config.php';

// Display Information for Sign Up HTML
echo "<h1>Sign Up</h1>";
echo "<p>Please fill this form to create an account.</p>";

$username_err = $pwd_err = $email_err = $loca_err = $username_err2 = " ";

//get data and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");

//get location
//http://www.developphp.com/video/PHP/GeoPlugin-Tutorial-Get-User-Location-Information-IP-Detection
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=?"));
$city = $geo["geoplugin_city"];
$state = $geo["geoplugin_region"];
$loc = $city. ',' .$state;

$username = $pwd = $email = $submit = "";

// Set up user, password, sumbit and ids 
if(isset($_POST['username'])){
	$username = $_POST['username'];
}
if(isset($_POST['pwd'])){
	$pwd = $_POST['pwd'];
}
if(isset($_POST['email'])){
	$email = $_POST['email'];
}
if(isset($_POST['submit'])){
	$submit = $_POST['submit'];
}

// Checks inputed user information
if ($submit) {
	// If no username entered display error message
	if (empty($username)){
		$username_err = "<p>Please enter a username.</p>";
		echo $username_err;
	}
	// If no password entered display error message
	if (empty($pwd)){
		$pwd_err = "<p>Please enter a password.</p>";
		echo $pwd_err;
	}
	// If no email entered display error message
	if (empty($email)){
		$email_err = "<p>Please enter a email.</p>";
		echo $email_err;
	}
	
	// If the username, password and emial are entered
	if( (!empty($username)) && (!empty($pwd)) && (!empty($email)) ) {
		//check for duplicates
		$get_num_username = "SELECT * FROM `user` WHERE `username` = '$username' ";
		$check_for_username = mysqli_query($conn,$get_num_username);
		$get_num_email = "SELECT * FROM `user` WHERE `email` = '$email' ";
		$check_for_email = mysqli_query($conn,$get_num_email);

		// If username is already taken display error message
		if (mysqli_num_rows($check_for_username) > 0) {
			$username_err2 = "This username is already taken.";
			echo $username_err2;
		// If email is already taken display error message	
		}elseif (mysqli_num_rows($check_for_email) > 0) {
			$email_err = "This account is already exists.";
			echo $email_err;
		// If neither username or email is taken create account	
		}else {
			$sql = "INSERT INTO `user`(`username`, `password`, `email`, `location`, `regis_date`)
			VALUES ('$username','$pwd','$email','$loc','$d')";
			$result = mysqli_query($conn,$sql);
			// Load login page
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
	<!-- <input type="text" name="location" placeholder="City, State"><br> -->
	<input type="submit" name="submit" value= "Sign Up">
</form>
</div>
</body>
</html>
