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
	<title>All</title>
	<!-- <meta http-equiv="refresh" content="10" /> -->
</head>
<style type="text/css">
	body{
		margin: 20px;
		font-size: 20px;
	}
	a{
		text-decoration: none
	}
</style>
<body>
	<a href="engine.php">Back</a><br><br>
<?php
	mysqli_select_db($conn, $dbname);

	function show_all_data($varconn,$table) {

		$query = "SELECT * FROM $table;";


		$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

		$row = mysqli_num_rows($result);

		echo("All chats = $row <br><br>");

		while($row = mysqli_fetch_assoc($result)) {
			$row = implode(" ",$row);
			echo "$row<br><br>";

		}

	}

	if (isset($_POST['show_all'])) {
		$table ="`chat`";
		$user_info = $user;
		$user = "`user`";
		$online = "`online`";
		show_all_data($conn,$table);

	} 
	?>
</body>
</html>