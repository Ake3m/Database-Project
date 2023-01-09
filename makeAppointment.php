<?php
include("connection.php");
include("functions.php");
include_once("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Appointment</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <main id="box">
    <h1>Make Appointment</h1>
    <form method="get">
        <?php
        $todays_date=date("Y-m-d");
        $end_date=date("Y-m-t", strtotime($todays_date));
        echo "<p>Select your desired appointment date. Please note that as of this moment, appointments can only be made within the month you are querying for, as doctors schedules may change on a monthly basis. We apologize for any inconvenience caused.</p>";
        echo "<label for=\"appointment_date\">Appointment Date</label>
        <input type=\"date\" id=\"appointment_date\" name=\"appointment_date\" value=\"".$todays_date."\" min=\"".$todays_date."\" max=\"".$end_date."\">";
        echo "<fieldset>
        <legend>Please select the specialization of the doctor you'd like to see.</legend>";
            $getSpecializationsQuery="SELECT * FROM specialization;";
            $queryResult=mysqli_query($con, $getSpecializationsQuery);
            if($queryResult && mysqli_num_rows($queryResult))
            {
                while($row=mysqli_fetch_assoc($queryResult))
                {
                    echo "<input type=\"radio\" id=\"s_choice".$row['id']."\" name=\"specialization\" value=\"".$row['id']."\"/>";
                    echo "<label for=\"s_choice".$row['id']."\">".$row['specialization_name']."</label>";
                }
            }
            echo "</fieldset>"
        ?>
        <input type="submit" value="Search" name="search"/>
        <input type="reset" value="Clear" name="reset"/>
    </form>

    <?php
    if(isset($_GET['search']))
    {
        $date = $_GET['appointment_date'];
        $day = date('l', strtotime($date));
        if($day==="Sunday" || $day ==="Saturday")
        {
            echo "I'm sorry. We don't open on weekends. Please select a week day.";
        }
        else{
            $doc_specialization=$_GET['specialization'];
            // $doctorQuery="SELECT * FROM doctor_information AS di, doctor_specialization AS ds WHERE di.doctor_id=ds.doctor_id AND ds.specialization_id=".$doc_specialization.";";
            $doctorQuery="SELECT doctor_information.doctor_id, doctor_information.first_name, doctor_information.last_name, doctor_specialization.specialization_id, works.day_of_week, shift_duration.shift_name, shift_duration.start_time, shift_duration.end_time
            FROM doctor_information
            LEFT JOIN doctor_specialization ON doctor_information.doctor_id=doctor_specialization.doctor_id LEFT JOIN works ON  doctor_information.doctor_id=works.doctor_id LEFT JOIN shift_duration ON works.shift_id=shift_duration.shift_id
            WHERE shift_duration.start_time IS NOT NULL AND shift_duration.end_time IS NOT NULL AND doctor_specialization.specialization_id =".$doc_specialization." AND works.day_of_week=\"".$day."\";";
            $result=mysqli_query($con, $doctorQuery);
            if($result && mysqli_num_rows($result)>0)
            {
                echo "<table>
                <thead>
                <tr>
                <th>Name</th>
                <th>Time</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>";
                while($row=mysqli_fetch_assoc($result))
                {
                    echo"<tr><td>".$row['first_name']." ".$row['last_name']."</td>";
                    echo "<td>".$row['day_of_week'].", ".$row['start_time']." - ".$row['end_time']."</td>";
                    echo "<td>
                    <button><a href=\"viewDoctorProfile.php?id=".$row['doctor_id']."\" target=_blank\">View Profile</a></button>
                    <button><a href=\"confirmAppointment.php?date=".$date."&id=".$row['doctor_id']."&day=".$day."&start_time=".$row['start_time']."&end_time=".$row['end_time']."&first_name=".$row['first_name']."&last_name=".$row['last_name']."\">Book Appoinment</a></button>
                    </td></tr>";
                }
                echo"
                </tbody>
                </tabe>";
            }

        }
        
    }
    ?>
</main>
</body>
</html>