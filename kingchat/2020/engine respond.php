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

if (isset($_GET["drop"])) {
	check("drop");
	$client_code_info = sanitizeString($_GET["drop"]);
	check_if_empty($client_code_info); 

	
} else {
	check("check");
	$client_code_info = sanitizeString($_GET['check']);
	check_if_empty($client_code_info);		

}


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


if ($user >= 1) {
	$favicon_status = "href=\"respond favicon.png\"";
	$status = "$client_code_info";

} else {
	$favicon_status = "href=\"../ offline favicon.png\"";
	$status = "<h1 class='offline'>Offline</h1>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Respond</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../kingstyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="15" />
	<link rel="shortcut icon" <?php echo "$favicon_status";?> type="image/x-icon">
	
</head>
<style type="text/css">
	button{
		padding: 5px;
		margin: 5px;
		border:none;
		outline: none;
		text-transform: uppercase;
		border-radius: 5px;

	}
</style>
<body>
	<p id="top"></p>
	<a href="#top" class="btn-top">top</a>
	<div class="grey small">
		<p>Auto refresh &#x2713 </p>
		<label for="No Personal Information" id="terms" onclick="notice();">&#10060; Personal Information</label>
	</div>
	<div>
		<button><a href="engine.php">Engine</a></button>
		
		<button><a href="engine show all.php">Engine show all</a></button>
		
		<button><a href="engine reply.php">Engine reply</a></button>
		
	</div>
	<!-- down ///////////////////////////////////////////////////////// -->
	<?php echo("$status");

	if ($status == "<h1 class='offline'>Offline</h1>") 
	{
		die();
	}
	?>
	<div>
	<!-- up down ///////////////////////////////////////////////////////// -->
		<?php
		$table = "`chat`";
		$client_code = '`client_code`';
		$x = 1;
		$message_number = 'm';
		$row = "1";

		$query = "SELECT * FROM $table WHERE $client_code = '$client_code_info';";

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$row = mysqli_num_rows($result);
		if ($row == 0) {

				die("Data Deleted Please close tab");
		}

		while ($row !== "") {
			# code...
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
		<form action="respond back-end.php" onsubmit="return check(btn_send);" method="POST">
			Your message :<br> <textarea id="btn_send" name="message" placeholder="..."></textarea>
			<br>
			<input type="submit" value="Send" id="submit-button" class="btn">
			<!-- down ///////////////////////////////////////////////////////// -->
			<input type="text"  hidden name="client_code" value="<?php print("$client_code_info");?>">
			<input type="text" name="store_user" hidden value="<?php print("$user"); ?>" />
			<!-- up ///////////////////////////////////////////////////////// -->
		</form>
	</div>

	<script type="text/javascript">

		function notice() {
			alert("*NB* Please DO NOT send any critical informnation. This includes your Bank Details / Personal Information.");
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
	<!-- down ///////////////////////////////////////////////////////// -->
	<footer style="padding-top: 300px;"><?php echo"<p class=\"grey\">$user_info</p>"; ?></footer>
	<!-- up ///////////////////////////////////////////////////////// -->
</body>
</html>