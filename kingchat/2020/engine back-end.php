<?php
session_start();
$user = $_SESSION['user'];
include_once("../king-connect.php");
include_once("../king-functions.php");
wait(3);

$dbname = "chat";
mysqli_select_db($conn, $dbname);

if (isset($_POST['go_offline'])) {
	$table ="`sign_in`";
	$user_info = $user;
	$user = "`user`";
	$online = "`online`";
	set_offline($conn,$table,$user,$online,$user_info);
	header("location:index.php");
	die();  
} 

if (isset($_POST['go_online'])) {
	$table ="`sign_in`";
	$user_info = $user;
	$user = "`user`";
	$online = "`online`";
	set_online($conn,$table,$user,$online,$user_info);
	header("location:engine.php");
	die();  
} 

if (isset($_POST['delete_all_data'])) {
	$table ="`chat`";
	$user_info = $user;
	$user = "`user`";
	delete_all_data($conn,$table);
	header("location:engine.php");
	die();  
} 

?>