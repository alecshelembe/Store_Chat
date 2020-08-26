<?php 
include_once("king-connect.php");
include_once("king-functions.php");
wait(3);
$dbname = "chat";
mysqli_select_db($conn, $dbname);
$table = "`chat`";
critical_check("client_code");
$client_code = sanitizeString($_POST['client_code']);
$client_code_info = $client_code;
critical_check("message");
$message = sanitizeString($_POST['message']);
$client_code = "`client_code`";
$store_user = "`store_user`";
$store_user_info = "New";
insert_new_registration($conn,$table,$client_code,$store_user,$client_code_info,$store_user_info);
update_last_message_sender($conn,$table,$client_code,$store_user,$client_code_info,$store_user_info);
setcookie("registration","$client_code", time() + (86400 * 15), "/");
client_send($conn,$table,$client_code,$client_code_info,$message);
header("Location:index.php");
die();

