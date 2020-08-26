<?php 
include_once("king-connect.php");
include_once("king-functions.php");
wait(3);
$dbname = "chat";
mysqli_select_db($conn, $dbname);
$table = "`sign_in`";
$online = "`online`";
$user = 0;

$query = "SELECT * FROM $table WHERE $online = '1';";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$row = mysqli_num_rows($result);

if ($row >= 1) {
	$user = 1;
} 

if (isset($_COOKIE["Chat"])) {
	$client_code = $_COOKIE["Chat"];

} else{

	$client_code = rand(1,300000000);
	setcookie("Chat","$client_code", time() + (86400 * 15), "/");

}


if ($user >= 1) {
	$favicon_status = "href=\"online favicon.png\"";
	$status = "<h1 class='online'>Online</h1>";

} else {
	$favicon_status = "href=\"offline favicon.png\"";
	$status = "<h1 class='offline'>Offline</h1>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="kingstyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="15" />
	<!-- down ///////////////////////////////////////////////////////// -->
	<link rel="shortcut icon" <?php echo "$favicon_status";?> type="image/x-icon">
	<!-- up ///////////////////////////////////////////////////////// -->
</head>
<body>
	<p id="top"></p>
	<a href="#top" class="btn-top">top</a>
	<div class="grey small">
		<a href="#" target="_blank" >Open website</a>
		<p>Auto refresh &#x2713 </p>
		<label for="No Personal Information" id="terms" onclick="notice();">&#10060; Personal Information</label>
	</div>
	<!-- down ///////////////////////////////////////////////////////// -->
	<?php echo("$status");

	if ($status == "<h1 class='offline'>Offline</h1>") 
	{
		die();
	}
	?>
	<div>
		<!-- up ///////////////////////////////////////////////////////// -->
		<!-- down ///////////////////////////////////////////////////////// -->
		<?php
		$table = "`chat`";
		$client_code_info = $client_code;
		$client_code = '`client_code`';
		$x = 1;
		$message_number = 'm';
		$row = "1";
		while ($row !== "") {
			$store_user = "`store_user`";
			$store_user_info = 'New';
			insert_new_registration($conn,$table,$client_code,$store_user,$client_code_info,$store_user_info);
			$query = "SELECT `$message_number$x` FROM $table WHERE  $client_code = '$client_code_info';";

			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

			$row = mysqli_fetch_assoc($result);
			$row = implode(" ",$row);

			
			echo "<p>$row</p><br>";

			$x++;
		}
		?>
		<!-- up /////////////////////////////////////////////////////////// -->
		
	</div>
	<div class="grey small">
		<form action="chat-backend.php" onsubmit="return check(btn_send);" method="POST">
			Your message :<br> <textarea id="btn_send" name="message" placeholder="..."></textarea>
			<br>
			<input type="submit" value="Send" id="submit-button" class="btn">
			<!-- down ///////////////////////////////////////////////////////// -->
			<input type="text" name="client_code" hidden value="<?php print("$client_code_info"); ?>" />
			<!-- up ///////////////////////////////////////////////////////// -->
		</form>
	</div>

	<script type="text/javascript">

		function notice() {
			alert("*NB* Please DO NOT send any critical information. This includes your Bank Details / Personal Information.");
		}

		document.getElementById("terms").checked = true;

		function check(str) {

			let btn_send = document.getElementById("btn_send");

			var judge = true;

			if (str.value.length == 0) {
				judge = false; 
				str.focus();

			}

			return judge;

		}  		

		document.onkeydown=function(evt){

			var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
			if(keyCode)
			{
				if (event.keyCode === 13) {

					event.preventDefault();

					document.getElementById("submit-button").click();
				}
				check(btn_send);
			}
		}	

	</script>
	<!-- ///////////////////////////////////////////////////////// -->
	<footer style="padding-top: 300px;"><?php echo"<p class=\"grey\">$client_code_info Cookie &#x2713</p>"; ?></footer>
	<!-- ///////////////////////////////////////////////////////// -->

</body>
</html>