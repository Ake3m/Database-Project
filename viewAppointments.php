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
    <title>View Appointments</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <main id="box">
    <h1>View Appointments</h1>
    <p>Select the date you would like to check</p>
    <form method="post">
    <input type="date" id="query_date" name="query_date">
    <input type="submit" name="search" value="Query"/>
    </form>

    <?php
        if(isset($_POST['search']))
        {
            $query_date=$_POST['query_date'];
            
            $getAppointments="SELECT * FROM appointment INNER JOIN user_info ON patient_id=uid WHERE doctor_id=".$_SESSION['user_data']['doctor_id']." ORDER BY consultation_number";
            $result=mysqli_query($con,$getAppointments);
            if($result && mysqli_num_rows($result))
            {
                echo "<table>
                <thead>
                <tr>
                <th>Date</th>
                <th>Patient Name</th>
                <th>Consultation Number</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>";
                while($row=mysqli_fetch_assoc($result))
                {
                    echo "<tr><td>".$row['appointment_date']."</td>";
                    echo"<td>".$row['first_name']." ".$row['last_name']."</td>";
                    echo "<td>".$row['consultation_number']."</td>";
                    if($row['appointment_status_id']==1)
                    {
                        echo"<td>Scheduled</td>";
                    }
                    else{
                        echo"<td>Cancelled</td>";
                    }
                    echo "</tr>";
                }
                echo"
                </tbody>
                </tabe>";
            }

        }
    ?>
</main>
</body>
</html>