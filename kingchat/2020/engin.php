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
	<!-- <meta http-equiv="refresh" content="10" /> -->
	<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
</head>
<style type="text/css">
	body{
		margin: 20px;
		line-height: 20px;
		background-color: #f5f5f5;
	}

	.btn{
		padding: 10px;
		outline: none;
		border:none;
		cursor: pointer;
	}

	.red{
		background-color: red;
	}

	.white{
		color: white;
	}
	.blue{
		background-color: blue;
	}

	.green{
		background-color: lightgreen;
	}

	.grey{
		background-color: grey;
	}

	div{
		margin: 20px;
	}
	input{
		border-radius: 5px;
		font-size: 20px;
	}
</style>
<body>
	<div>
		<form action="engin back-end.php" method="POST">
			<input type="submit" value ="Go offline and logout" class="btn red white" name="go_offline">
		</form>
	</div>
	<div>
		<form action="engin back-end.php" method="POST">
			<input type="submit" value ="Delete all data" class="btn red white" name="delete_all_data">
		</form>
	</div>
	<div>
		<form action="engin back-end.php" method="POST">
			<input type="submit" value ="Go online" class="btn green white" name="go_online">
		</form>
	</div>
	<div>
		<form action="engin show all.php" method="POST">
			<input type="submit" value ="Show all data" class="btn blue white" name="show_all">
		</form>
	</div>
	<div>
		<form action="engin reply.php" method="POST">
			<input type="submit" value ="Reply" class="btn grey white" name="reply">
		</form>
	</div>
</body>
</html>