<?php
 
 session_start();
 $old_user = $_SESSION['username'];
 unset($_SESSION['username']);
 session_destroy();
 header("Location: login.php");

?>