<?php 
include_once("../king-connect.php");
include_once("../king-functions.php");
wait(3);
session_start();
$user = $_SESSION['user'];
$user_info = $user;
if (!isset($user)) {
	header("location:index.php");
	die();
}
mysqli_select_db($conn, $dbname);
critical_check("client_code");
critical_check("store_user");
$client_code_info = sanitizeString($_POST['client_code']);
$store_user = sanitizeString($_POST['store_user']);                                                  
critical_check("message");
critical_check("store_user");
$message = sanitizeString($_POST['message']);
$table = "`chat`";
$user = "`store_user`";
$client_code = "`client_code`";
respond($conn,$table,$user,$client_code,$user_info,$client_code_info,$message);
echo"<form action=\"engine respond.php\" hidden id=\"drop\" methode=\"POST\">
<input type=\"checkbox\" value=\"$client_code_info\" name=\"drop\" checked />
<input type=\"submit\">
<script type=\"text/javascript\">
document.getElementById(\"drop\").submit();
</script>
</form>";
die();
?>



