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
	<meta charset="utf-8">
	<title>Engin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="engine-style.css">
	<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
</head>
<body>
	
	<div>
		<form action="engine back-end.php" method="POST">
			<input type="submit" value ="Delete all data" class="btn red white" name="delete_all_data">
		</form>
	</div>
	
	<div>
		<form action="engine back-end.php" method="POST">
			<input type="submit" value ="Go offline and logout" class="btn red white" name="go_offline">
		</form>
	</div>
	
	<div>
		<form action="engine back-end.php" method="POST">
			<input type="submit" value ="Go online" class="btn green white" name="go_online">
		</form>
	</div>
	<div>
		<form action="engine show all.php" method="POST">
			<input type="submit" value ="Show all data" class="btn blue white" name="show_all">
		</form>
	</div>
	<div>
		<form action="engine reply.php" method="POST">
			<input type="submit" value ="Reply" class="btn orange" name="reply">
		</form>
	</div>
	<div>
		<button><a href="newuser.php">New User</a></button>
	</div>
</body>
</html>