<?php
	include("connection.php");
	include("functions.php");
	include_once("header.php");

	$user_data=check_login($con);
	$_SESSION['user_data']=$user_data;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Brave Heart Clinic</title>
	</head>
	<body>
	
		<main>
		<h1>Welcome to Brave Heart Clinic's Website</h1>
		<?php
			echo "</p>Welcome to the website".$user_data['first_name']."I hope you find what you're looking for</p>";
		?>
		
		</main>
		<footer></footer>
	</body>
</html>