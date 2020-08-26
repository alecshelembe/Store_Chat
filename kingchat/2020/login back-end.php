<?php 
include_once("../king-connect.php");
include_once("../king-functions.php");
session_start();
wait(3);
critical_check("login_user");
critical_check("password");
$login_user = sanitizeString($_POST['login_user']);
$password = sanitizeString($_POST['password']);
$dbname = "chat";
mysqli_select_db($conn, $dbname);
$table ="`sign_in`";
end_last_login('user');
$user = "`user`";
$security_key = "`security_key`";
check_if_user_registered_for_login($conn,$table,$user,$security_key,$login_user,$password);
pair_for_login($conn,$table,$user,$security_key,$login_user,$password);
$user_info = $_SESSION['user'];
header("location:engine.php");


