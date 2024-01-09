<?php
session_start();
unset($_SESSION['id']); 
unset($_SESSION['cp_user']);
unset($_SESSION['password']); 
unset($_SESSION['user_status']);
unset($_SESSION['name']);

$_SESSION['msg']="You are now logged out";
header("Location:login.php");
?>