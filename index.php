<?php
	include("connection.php");
	include("functions.php");
	include_once("header.php");

	$user_data=check_login($con);
	$_SESSION['user_data']=$user_data;
	
	if($_SESSION['accountType']==='D' && $_SESSION['activated']==='N')
	{
		header("location:doctorRegistration.php");
		exit();
	}
	// $_SESSION['user_data']=$user_data;
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
			echo "</p>Welcome, ".$user_data['first_name']."</p>";
		?>
		<h2>Appointment details</h2>
		<h3>Upcoming appointments<h3>
		<h3>Past appointments</h3>

		
		</main>
		<footer></footer>
	</body>
</html>