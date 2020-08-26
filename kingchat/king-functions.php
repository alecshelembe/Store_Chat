<?php 
include_once("king-connect.php");

function wait($var) {
	sleep($var);
}

function redirect_back() {
	echo("<script type=\"text/javascript\">
		window.history.go(-1);
		</script>");
	die("Error");
}

function message_information_missing() {
	echo("<script type=\"text/javascript\">
		alert(\"Information missing\");
		</script>");
}

function check_if_empty($var) {
	if (empty($var)) {
		message_information_missing();
		redirect_back();
	}
}

function critical_check($var){
	if (!isset($_POST[$var])) {
		die("$var");
	}
	check_if_empty($var);
}

function check($var){
	if (!isset($_GET[$var])) {
		die("$var");
	}
}


function sanitizeString($var) {    
	if (get_magic_quotes_gpc())

		$var = stripsloashes($var);   
	$var = htmlentities($var);    
	$var = strip_tags($var); 

	if (strlen($var) > 100 ) {
		echo"Charachter break";
		die("fatal error"); 
	}

	return $var; 
}



function code_check($var,$var2) {
	if ($var !== $var2) {
		echo("<script type=\"text/javascript\">
			alert(\"Cannot start Chat. Try again.\");
			</script>");
		redirect_back();
		die();
	}
}

function end_last_login($var) {
	if (isset($_SESSION[$var])) {
		session_reset();
	} 
}

function result($varconn, $query) {
	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
}

function update_new_message($varconn,$table,$client_code,$message_number,$client_code_info,$client_message) {

	if (!isset($_COOKIE["message_digit"])) {

		$message_digit = 1;

	} else {
		$message_digit = $_COOKIE["message_digit"];
	}

	$message_number = "`m$message_digit`";


	
	$client_message = addslashes($client_message);

	$query = "UPDATE $table SET $message_number = '$client_message' WHERE $table.$client_code = '$client_code_info';";
	
	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$query = "SELECT * FROM $table WHERE $message_number = '$client_message' AND $client_code = '$client_code_info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$row = mysqli_num_rows($result);
	if ($row == 0) {

		setcookie("message_digit","1", time() + (86400 * 15), "/");	
		setcookie("registration","", time() - (86400 * 15), "/");
		setcookie("Chat","", time() - (86400 * 15), "/");
		echo "<h4>Please return, refresh and try again.</h4>";
		die();
	}
	$message_digit++;
	setcookie("message_digit","$message_digit", time() + (86400 * 15), "/");	

}


function insert_new_user($varconn,$table,$user,$security_key,$user_info,$security_key_info) {

	$query = "INSERT INTO $table ($user,$security_key) VALUES ('$user_info','$security_key_info');";
	
	result($varconn,$query);

}


function insert_new_registration($varconn,$table,$client_code,$store_user,$client_code_info,$store_user_info) {
	
	$query = "SELECT * FROM $table WHERE $client_code = '$client_code_info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
	$row = mysqli_num_rows($result);
	if ($row == 0) {

		$query = "INSERT INTO $table ($client_code,$store_user) VALUES ('$client_code_info','$store_user_info');";
		
		$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
		

	}

}

function update_last_message_sender($varconn,$table,$client_code,$store_user,$client_code_info,$store_user_info) {

	$query = "UPDATE $table SET $store_user = '$store_user_info' WHERE $table.$client_code = '$client_code_info';";
	
	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

}

function wrongpassword() {

	echo("<script type=\"text/javascript\">
		alert(\"Password Wrong\");
		window.history.go(-1);
		</script>");
	die();


}

function check_if_user_registered_for_login($varconn,$table,$user,$security_key,$user_info,$security_key_info) {


	$query = "SELECT * FROM $table WHERE $user = '$user_info' AND $security_key = '$security_key_info';";


	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	while ($row = mysqli_fetch_assoc($result)) {
		$security_key = $row['security_key'];
	}
	
	if ($security_key !== $security_key_info ){
		wrongpassword();
		die();
	}

	

}


function pair_for_login($varconn,$table,$user,$security_key,$user_info,$security_key_info) {

	$query = "SELECT * FROM $table WHERE $user = '$user_info' and $security_key = '$security_key_info';";


	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));


	$security_key = "";

	while ($row = mysqli_fetch_assoc($result)) {
		$security_key = $row['security_key'];
	}
	
	if ($security_key !== $security_key_info ){
		wrongpassword();
		die();
	}


	$query = "SELECT * FROM $table WHERE $user = '$user_info' and `account_state` = '1';";


	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));


	$account_state = "";
	
	while ($row = mysqli_fetch_assoc($result)) {
		$account_state = $row['account_state'];
	}

	if ($account_state == 0 ){
		die();
	}

	$query = "SELECT * FROM $table WHERE $user = '$user_info';";

	$result = mysqli_query($varconn,$_SESSION['ready'] = $query) or die(mysql_error($varconn));

	while ($row = mysqli_fetch_assoc($result))
	{ 

		$user = $_SESSION['user'] = $row['user'];

	}

}

function set_online($varconn,$table,$user,$online,$user_info) {

	$query = "UPDATE $table SET $online = '1' WHERE $table.$user = '$user_info';";


	result($varconn,$query);

}

function set_offline($varconn,$table,$user,$online,$user_info) {

	$query = "UPDATE $table SET $online = '0' WHERE $table.$user = '$user_info';";

	result($varconn,$query);

	session_destroy();

}

function delete_all_data($varconn,$table) {

	$query = "TRUNCATE $table.$table;";

	result($varconn,$query);
}

function respond($varconn,$table,$user,$client_code,$user_info,$client_code_info,$message) {
	
	$message = addslashes($message);

	$query = "UPDATE $table SET $user = '$user_info' WHERE $table.$client_code = '$client_code_info';";

	result($varconn,$query);

	$x = 1;
	$message_number = 'm';
	$row = "1";
	while ($row !== "") {
			# code...
		$query = "SELECT `$message_number$x` FROM $table WHERE  $client_code = '$client_code_info';";

		$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
		$row = mysqli_fetch_assoc($result);
		$row = implode("",$row);
		if ($row == "") {

		$query = "UPDATE $table SET `$message_number$x` = '$message' WHERE $table.$client_code = '$client_code_info';";
		
		result($varconn,$query);

		}
			$x++;
	}



}

function client_send($varconn,$table,$client_code,$client_code_info,$message) {
	
	$message = addslashes($message);

	$x = 1;
	$message_number = 'm';
	$row = "1";
	while ($row !== "") {
			# code...
		$query = "SELECT `$message_number$x` FROM $table WHERE  $client_code = '$client_code_info';";
		

		$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
		$row = mysqli_fetch_assoc($result);
		$row = implode("",$row);
		if ($row == "") {

		$query = "UPDATE $table SET `$message_number$x` = '$message' WHERE $table.$client_code = '$client_code_info';";
		
		
		result($varconn,$query);

		}
			$x++;
	}



}

?>


