<?php
ob_start();
session_start();
if(!isset($_SESSION["cp_user"])){ 
header("location:login.php");
exit();
}
include ('../scripts/dbconnect.php');
// Be sure to check that this manager SESSION value is in fact in the database
$cp_user_iD = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
// filter everything but numbers and letters
$cp_user = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["cp_user"]); 
// filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); 
// filter everything but numbers and letters
$user_status = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["user_status"]); 
// filter everything but numbers and letters
$sql = mysql_query("SELECT * FROM users_tb WHERE id='$cp_user_iD' AND user_login='$cp_user' AND user_pass='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	unset($_SESSION['id']); 
	unset($_SESSION['cp_user']);
	unset($_SESSION['password']); 
	unset($_SESSION['user_status']);
	unset($_SESSION['name']);
	$_SESSION['msg']="Please login again";
	header("Location:login.php");
    exit();
}
?>