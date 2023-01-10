<?php
include_once("adminHeader.php");
include_once("../connection.php");
include_once("adminFunctions.php");

$todays_date=date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <main id="box">
        <h1>Manage Appointments</h1>
        <h2>Active Appointments</h2>
        <?php
            $getAppointments="SELECT appointment_date, patient_id,appointment.doctor_id, appointment.doctor_id,consultation_number,start_time, end_time, doctor_information.first_name,doctor_information.last_name, user_info.first_name as fn, user_info.last_name as ln
            FROM appointment INNER JOIN doctor_information ON appointment.doctor_id=doctor_information.doctor_id  INNER JOIN user_info ON patient_id=user_info.uid WHERE appointment_date>='$todays_date' AND appointment_status_id=1 ORDER BY appointment_date;";
            $queryResult=mysqli_query($con, $getAppointments);
            if(mysqli_num_rows($queryResult)===0)
            {
                echo "<p>No Appointments</p>";
            }
            else{
                echo"<table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Patient Name</th>
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
                    <td>".$row['fn']." ".$row['ln']."</td>
                    <td>".$row['first_name']." ".$row['last_name']."</td>
                    <td>".$row['start_time']." to ".$row['end_time']."</td>
                    <td>".$row['consultation_number']."</td>
                    <td><a href=\"adminConfirmCancellation.php?date=".$row['appointment_date']."&doctor_id=".$row['doctor_id']."&consultation_number=".$row['consultation_number']."&last_name=".$row['last_name']."\"><button class=\"deleteBtn\">Cancel</button></a></td>
                    </tr>";
                }
                echo"</tbody>
                </table>";}
        ?>
        <h2>Successful Appointments</h2>
        <?php
            $getAppointments="SELECT appointment_date, patient_id,appointment.doctor_id, appointment.doctor_id,consultation_number,start_time, end_time, doctor_information.first_name,doctor_information.last_name, user_info.first_name as fn, user_info.last_name as ln
            FROM appointment INNER JOIN doctor_information ON appointment.doctor_id=doctor_information.doctor_id  INNER JOIN user_info ON patient_id=user_info.uid WHERE appointment_date<='$todays_date' AND appointment_status_id=1 ORDER BY appointment_date;";
            $queryResult=mysqli_query($con, $getAppointments);
            if(mysqli_num_rows($queryResult)===0)
            {
                echo "<p>No Appointments</p>";
            }
            else{
                echo"<table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Consultation time</th>
                        <th>Consultancy Number</th>
                    </tr>
                </thead>
                ";
                echo"<tbody>";
                while($row=mysqli_fetch_assoc($queryResult))
                {
                    echo"<tr>
                    <td>".$row['appointment_date']."</td>
                    <td>".$row['fn']." ".$row['ln']."</td>
                    <td>".$row['first_name']." ".$row['last_name']."</td>
                    <td>".$row['start_time']." to ".$row['end_time']."</td>
                    <td>".$row['consultation_number']."</td>
                    </tr>";
                }
                echo"</tbody>
                </table>";}
        ?>
        <h2>Cancelled Appointments</h2>
        <?php
            $getAppointments="SELECT appointment_date, patient_id,appointment.doctor_id, appointment.doctor_id,consultation_number,start_time, end_time, doctor_information.first_name,doctor_information.last_name, user_info.first_name as fn, user_info.last_name as ln
            FROM appointment INNER JOIN doctor_information ON appointment.doctor_id=doctor_information.doctor_id INNER JOIN user_info ON patient_id=user_info.uid WHERE appointment_status_id=2 ORDER BY appointment_date;";
            $queryResult=mysqli_query($con, $getAppointments);
            if(mysqli_num_rows($queryResult)===0)
            {
                echo "<p>No Appointments</p>";
            }
            else{
                echo"<table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Consultation time</th>
                        <th>Consultancy Number</th>
                    </tr>
                </thead>
                ";
                echo"<tbody>";
                while($row=mysqli_fetch_assoc($queryResult))
                {
                    echo"<tr>
                    <td>".$row['appointment_date']."</td>
                    <td>".$row['fn']." ".$row['ln']."</td>
                    <td>".$row['first_name']." ".$row['last_name']."</td>
                    <td>".$row['start_time']." to ".$row['end_time']."</td>
                    <td>".$row['consultation_number']."</td>";
                }
                echo"</tbody>
                </table>";
            }
        ?>
    </main>
</body>
</html>