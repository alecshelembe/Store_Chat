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
	<title>Engine.A</title>
	<meta http-equiv="refresh" content="10" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="engine-style.css">
	<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
</head>
<body>
	<p class="grey small">Auto refresh &#x2713 </p>
	<div>
		<button><a href="engine.php">Engine</a></button>
		<button><a href="engine reply.php"  class="font-orange">Engine reply</a></button>
		
	</div>
	<h1>All data</h1>
	<p class="grey small"> Cookie | Date (started) | Time | Store user | Chat </p>
	<div class="long">
		<!-- down ///////////////////////////////////////////////////////// -->
		<?php
		mysqli_select_db($conn, $dbname);

		function show_all_data($varconn,$table) {

			$query = "SELECT * FROM $table;";


			$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

			$row = mysqli_num_rows($result);

			echo("All chats = <strong>$row</strong> <br><br>");

			$x = 1;
			while($row = mysqli_fetch_assoc($result)) {
				$row = implode(" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$row);
				echo "<div><p>($x) $row ($x)</p></div>";
				$x++;

			}

		}
		$table ="`chat`";
		$user_info = $user;
		$user = "`user`";
		$online = "`online`";
		show_all_data($conn,$table);

		?>
		<!-- up ///////////////////////////////////////////////////////// -->
	</div>
</body>
</html>