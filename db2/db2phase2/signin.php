<?php

include 'config.php';

$username = $_POST['username'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$pwd'";
$result = mysqli_query($conn,$sql);

if(!$row = mysqli_fetch_assoc($result)){
	echo "You username or password in incorrect";

} else {
	echo "You are logged in!";

}
?>