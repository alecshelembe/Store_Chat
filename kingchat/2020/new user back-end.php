<?php 
include_once("../king-connect.php");
include_once("../king-functions.php");
wait(3);
critical_check("new_user");
critical_check("password");
$new_user = sanitizeString($_POST['new_user']);
$password = sanitizeString($_POST['password']);
$dbname = "chat";
mysqli_select_db($conn, $dbname);
$table ="`sign_in`";
session_start();
$user = "`user`";
$security_key = "`security_key`";
insert_new_user($conn,$table,$user,$security_key,$new_user,$password);
header("location:index.php");
die();
