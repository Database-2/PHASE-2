<?php

include 'config.php';

$username = $_POST['username'];
$pwd = $_POST['pwd'];
$email = $_POST['email'];
$location = $_POST['location'];

$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");

///*
$sql = "INSERT INTO `user`(`username`, `password`, `email`, `location`, `regis_date`)
VALUES ('$username','$pwd','$email','$location','$d')";
$result = mysqli_query($conn,$sql);

//*/

header("Location: login.php");
?>