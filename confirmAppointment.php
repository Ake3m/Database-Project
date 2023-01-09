<?php
include("connection.php");
include("functions.php");
include_once("header.php");


if(isset($_POST['confirm']))
{
    echo "test";
    $user_data=$_SESSION['user_data'];
    $user_id=$user_data['uid'];
    $date=$_GET['date'];
    $doctor_id=$_GET['id'];
    $starttime=$_GET['start_time'];
    $endtime=$_GET['end_time'];
    $check_doctors_patients_query="SELECT COUNT(*) AS consultancy_number FROM appointment WHERE appointment_date=\"".$date."\" AND doctor_id=\"".$doctor_id."\";";
    $queryResult=mysqli_query($con, $check_doctors_patients_query);
    if($queryResult && mysqli_num_rows($queryResult)>0)
    {
        
        $row=mysqli_fetch_assoc($queryResult);
        $current_patient_number= $row['consultancy_number'];
        if($current_patient_number===0)
        {
            $insert_appointment_query="INSERT INTO appointment(appointment_date, patient_id, doctor_id,consultation_number,appointment_status_id, start_time, end_time) VALUES('$date', '$user_id','$doctor_id',1,1,'$starttime','$endtime');";
            if(mysqli_query($con, $insert_appointment_query))
            {
                header("location: index.php");
            }
            else{
                header("location: confirmAppointment.php?error=idk");
            }
        }
        else{
            $current_patient_number+=1;
            
            $insert_appointment_query="INSERT INTO appointment(appointment_date, patient_id, doctor_id,consultation_number,appointment_status_id, start_time, end_time) VALUES('$date', '$user_id','$doctor_id','$current_patient_number',1, '$starttime','$endtime');";
            if(mysqli_query($con, $insert_appointment_query))
            {
                header("location: index.php");
            }
            else{
                header("location: confirmAppointment.php?error=idk");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <main id="box">
    <h1>Confirm Appointment Details</h1>
    <p>Here is a summary of your appointment. In order to confirm, please press the confirm button below. After confirming the appointment, you'll be given a consultancy number,which represents the order in which the doctor will be seeing patients on that day.There may be cases where patients do not make it before their number is called, they can still see the doctor, but they would have to wait until all the other numbers have been called. Therefore, please be on time and keep in mind the doctor's start time. All payment will be handled on site. Thank you for your patronage!</p>
    <?php
        echo "<p>Appointment Date: ".$_GET['day']." ".$_GET['date']."</p>";
        echo "<p>Doctor's name: ".$_GET['first_name']." ".$_GET['last_name']."</p>";
        echo "<p>Consultation time: ".$_GET['start_time']." to ".$_GET['end_time']."</p>"
    ?>
    <form method="post">
        <input type="submit" value="Confirm" name="confirm"/>
    </form>
</main>
</body>
</html>