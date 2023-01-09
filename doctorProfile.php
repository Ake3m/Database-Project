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
    <title>Doctor Profile</title>
</head>
<body>
    <?php
    $doctorID=$_SESSION['user_data']['doctor_id'];
        $getProfileInformation="SELECT doctor_information.doctor_id,doctor_information.first_name, doctor_information.last_name, doctor_information.professional_statement, doctor_information.active_since, hospital_affiliation.hospital_name, hospital_affiliation.city, hospital_affiliation.country, hospital_affiliation.start_date, hospital_affiliation.end_date 
        FROM doctor_information LEFT JOIN doctor_specialization ON doctor_information.doctor_id=doctor_specialization.doctor_id LEFT JOIN hospital_affiliation ON hospital_affiliation.doctor_id=doctor_information.doctor_id WHERE doctor_information.doctor_id=\"".$doctorID."\";";
        $getQualificationInformation="SELECT * from qualification where doctor_id=\"".$doctorID."\";";
        $getSpecializationInformation="SELECT * from doctor_specialization LEFT JOIN specialization ON doctor_specialization.specialization_id=specialization.id WHERE doctor_id=\"".$doctorID."\";";
        $getScheduleInformation="SELECT doctor_id, day_of_week,shift_name, start_time, end_time  FROM works LEFT JOIN shift_duration ON works.shift_id=shift_duration.shift_id WHERE doctor_id=\"".$doctorID."\";";
        $result=mysqli_query($con, $getProfileInformation);
        $result2=mysqli_query($con, $getQualificationInformation);
        $result3=mysqli_query($con, $getSpecializationInformation);
        $result4=mysqli_query($con, $getScheduleInformation);
        $info=mysqli_fetch_assoc($result);
        $info2=mysqli_fetch_assoc($result2);
        echo "<h1>Doctor ".$info['first_name']." ".$info['last_name']."</h1>";
        echo "<img src=\"./img/placeholder.jpg\" alt=\"A blank profile image\"/>";
        echo "<p> Active Since: ".$info['active_since']."</p>";
        echo "<h2>Professional statement</h2>";
        echo "<p>".$info['professional_statement']."</p>";
        echo "<h2>Qualifications</h2>";
        echo "<p>My most recent qualification is a ".$info2['qualification_name']." from ".$info2['institute_name']." acquired on ".$info2['procurement_date'];
        echo "<h2> Hospital Affiliation</h2>";
        echo "<p>I have worked at the ".$info['hospital_name']." in ".$info['city'].", ".$info['country']." from ".$info['start_date']." to ";
        if($info['end_date'])
        {
            echo $info['end_date'].". I'm currently serving at the Brave Heart Clinic</p>";
        }
        else{
            echo "present. I'm currently serving at the Brave Heart Clinic.</p>";
        }
        echo "<h2> Specialization Areas</h2>";
        if($result3 && mysqli_num_rows($result3)>0)
        {
            echo"<ul>";
            while($row=mysqli_fetch_assoc($result3))
            {
                echo "<li>".$row['specialization_name']."</li>";
            }
            echo"</ul>";
        }
        echo "<h2> Clinic work schedule</h2>";
        if($result4 && mysqli_num_rows($result4)>0)
        {
            echo "<table>";
            echo "<thead>
            <tr>
                <th>Day</th>
                <th>Period</th>
                <th>Start time</th>
                <th>End time</th>
            </tr>
            </thead>
            <tbody>
            ";
            while($row=mysqli_fetch_assoc($result4))
            {
                echo"<tr>
                    <td>".$row['day_of_week']."</td>
                    <td>".$row['shift_name']."</td>";
                if($row['shift_name'] ==='Day off')
                {
                    echo"<td>".$row['shift_name']."</td>
                    <td>".$row['shift_name']."</td>";
                }
                else{
                    echo "<td>".$row['start_time']."</td>
                    <td>".$row['end_time']."</td>";
                }
                   
                echo"</tr>";
            }
            echo"</tbody></table>";
        }
    ?>
    <p>To change any of the above, please cotact your system administrator</p>
    <h2>Change password</p>
    <button><a href="updatePassword.php">Update password</a></button>
</body>
</html>