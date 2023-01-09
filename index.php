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
		<link rel="stylesheet" href="./styles/main.css">
	</head>
	<body>
		<main id="box">
		<h1>Welcome to Brave Heart Clinic's Website</h1>
		<?php
			if($_SESSION['accountType']==='D')
			{
				$id=$user_data['doctor_id'];
				echo "</p>Welcome back Dr. ".$user_data['last_name']."";
				echo "<h2>Appointment details</h2>";
				echo "<p>Below is a list of all your upcoming appointments. To find appointments by date, please check the 'View appointments' section.</p>";
				$todays_date=date('Y-m-d');
				echo "<h3>Upcoming Appointments</h3>";
				$getAppointments="SELECT appointment_date,appointment_status_id, patient_id,appointment.doctor_id, appointment.doctor_id,consultation_number,start_time, end_time, user_info.first_name,user_info.last_name
				FROM appointment INNER JOIN user_info ON appointment.patient_id=user_info.uid WHERE appointment.doctor_id=\"".$id."\" AND appointment_date>=".$todays_date." ORDER BY appointment_date;";
				$queryResult=mysqli_query($con, $getAppointments);
				if(mysqli_num_rows($queryResult)===0)
				{
					echo "<p>No Upcoming Appointments</p>";
				}
				else{
					echo"<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Patient Name</th>
							<th>Consultation time</th>
							<th>Consultancy Number</th>
							<th>Status</th>
						</tr>
					</thead>
					";
					echo"<tbody>";
					while($row=mysqli_fetch_assoc($queryResult))
					{
						echo"<tr>
						<td>".$row['appointment_date']."</td>
						<td>".$row['first_name']." ".$row['last_name']."</td>
						<td>".$row['start_time']." to ".$row['end_time']."</td>
						<td>".$row['consultation_number']."</td>";
						if($row['appointment_status_id']==1)
						{
							echo "<td>Scheduled</td>";
						}
						else
						{
							echo "<td>Cancelled</td>";
						}
						echo"</tr>";
					}
					echo"</tbody>
					</table>";
				}
				echo "<h3>Past appointments</h3>";
				$getPastAppointments="SELECT appointment_date, patient_id, appointment.doctor_id,consultation_number,start_time, end_time, user_info.first_name,user_info.last_name
				FROM appointment INNER JOIN user_info ON appointment.patient_id=user_info.uid WHERE appointment.doctor_id=\"".$id."\" AND appointment_date <".$todays_date." ORDER BY appointment_date;";
				$queryResult=mysqli_query($con, $getPastAppointments);
				if(mysqli_num_rows($queryResult)===0)
				{
					echo "<p>No Previous Appointments</p>";
				}
				else
				{
					echo"<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Patient Name</th>
							<th>Consultation time</th>
							<th>Consultancy Number</th>
						</tr>
					</thead>
					";
					echo"<tbody>";
					while($row=mysqli_fetch_assoc($queryResult))
					{
						if($row['appointment_date']>=$todays_date)
						{
							echo"<tr>
							<td>".$row['appointment_date']."</td>
							<td>".$row['first_name']." ".$row['last_name']."</td>
							<td>".$row['start_time']." to ".$row['end_time']."</td>
							<td>".$row['consultation_number']."</td>
							</tr>";
						}
					}
					echo"</tbody>
					</table>";
				}
			}
			else if($_SESSION['accountType']==='R'){
				echo "</p>Welcome, ".$user_data['first_name'].".Thank you for choosing us!</p>";
				echo "<h2>Appointment details</h2>";
				echo "<p>Below is a list of all appointments, past, present and future. Appointments can be cancelled at anytime.</p>";
				$todays_date=date('Y-m-d');
				$id=$user_data['uid'];
				echo "<h3>Upcoming Appointments</h3>";
				$getAppointments="SELECT appointment_date, patient_id,appointment.doctor_id, appointment.doctor_id,consultation_number,start_time, end_time, doctor_information.first_name,doctor_information.last_name
				FROM appointment INNER JOIN doctor_information ON appointment.doctor_id=doctor_information.doctor_id WHERE patient_id=\"".$id."\" AND appointment_date>=".$todays_date." AND appointment_status_id=1 ORDER BY appointment_date;";
				$queryResult=mysqli_query($con, $getAppointments);
				if(mysqli_num_rows($queryResult)===0)
				{
					echo "<p>No Upcoming Appointments</p>";
				}
				else{
					echo"<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Doctor Name</th>
							<th>Consultation time</th>
							<th>Consultancy Number</th>
							<th>Action</th>
						</tr>
					</thead>
					";
					echo"<tbody>";
					while($row=mysqli_fetch_assoc($queryResult))
					{
						echo"<tr>
						<td>".$row['appointment_date']."</td>
						<td>".$row['first_name']." ".$row['last_name']."</td>
						<td>".$row['start_time']." to ".$row['end_time']."</td>
						<td>".$row['consultation_number']."</td>
						<td><button><a href=\"confirmCancellation.php?date=".$row['appointment_date']."&doctor_id=".$row['doctor_id']."&consultation_number=".$row['consultation_number']."&last_name=".$row['last_name']."\">Cancel</a></button></td>
						</tr>";
					}
					echo"</tbody>
					</table>";
				}
				echo "<h3>Past appointments</h3>";
				$getPastAppointments="SELECT appointment_date, patient_id, appointment.doctor_id,consultation_number,start_time, end_time, doctor_information.first_name,doctor_information.last_name
				FROM appointment INNER JOIN doctor_information ON appointment.doctor_id=doctor_information.doctor_id WHERE patient_id=\"".$id."\" AND appointment_date <".$todays_date." ORDER BY appointment_date;";
				$queryResult=mysqli_query($con, $getPastAppointments);
				if(mysqli_num_rows($queryResult)===0)
				{
					echo "<p>No Previous Appointments</p>";
				}
				else
				{
					echo"<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Doctor Name</th>
							<th>Consultation time</th>
							<th>Consultancy Number</th>
						</tr>
					</thead>
					";
					echo"<tbody>";
					while($row=mysqli_fetch_assoc($queryResult))
					{
						if($row['appointment_date']>=$todays_date)
						{
							echo"<tr>
							<td>".$row['appointment_date']."</td>
							<td>".$row['first_name']." ".$row['last_name']."</td>
							<td>".$row['start_time']." to ".$row['end_time']."</td>
							<td>".$row['consultation_number']."</td>
							</tr>";
						}
					}
					echo"</tbody>
					</table>";
				}
			}
		?>
		</main>
		<footer></footer>
	</body>
</html>