<?php
include 'config.php';
session_start();

$id = $_GET['id'];

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
$sql = "DELETE FROM message WHERE message_id = $id"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: inbox.php');
    exit;
} else {
    echo "Error deleting record";
}

?>
