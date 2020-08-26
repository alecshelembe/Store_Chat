<?php
include_once("../king-connect.php");
include_once("../king-functions.php");
session_start();
$user = $_SESSION['user'];
if (!isset($user)) {
	header("location:index.php");
	die();
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Engine.R</title>
	<meta http-equiv="refresh" content="10" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="engine-style.css">
	<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
</head>
<body>
	<p class="small grey">Auto refresh &#x2713 </p>
	<div>
		<button><a href="engine.php">Engine</a></button>
		<button><a href="engine show all.php " class="font-blue">Engine show all</a></button>
	</div>
	<h1>Reply</h1>
	<!-- down ///////////////////////////////////////////////////////// -->
	<?php
	mysqli_select_db($conn, $dbname);
	$table ="`chat`";
	$user_info = $user;
	$user = "`user`";
	$online = "`online`";
	$client_code = "`client_code`";

	$query = "SELECT $client_code FROM $table;";

	$result = mysqli_query($conn, $query) or die(mysqli_error($varconn));

	$x = 1;
	while($row = mysqli_fetch_assoc($result)) {
		$row = implode(" ",$row);
		echo "
		<form action = \"engine respond.php\" target=\"_blank\" method=\"GET\">
		($x) <input type=\"text\"hidden name=\"check\" class=\"radio\"value=\"$row\">
		<input type=\"submit\" id=\"$row\" value=\"Respond\" class=\"btn\">
		</form>

		";
		$x++;
	}

	?>
	<!-- up ///////////////////////////////////////////////////////// -->
</body>
</html>