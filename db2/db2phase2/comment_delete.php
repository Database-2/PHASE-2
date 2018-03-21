<?php
include 'config.php';
session_start();

$id = $_GET['del'];

if(!isset($_SESSION['uid'])){
  header("Location: login.php");
  exit();
}
if(isset($_SESSION['username'])){
}
$user_uid = "";
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
}

// sql to delete a record
$sql = "DELETE FROM comment WHERE cid = $id"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: profile.php');
    exit;
} else {
    echo "Error deleting record";
}

?>
