<?php
include_once("adminHeader.php");
include_once("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <title>Manage Doctors</title>
</head>
<body>
    <main id="box">
    <h1>Doctor Management</h1>
    <a href="addDoctor.php"><button class="addBtn">Add Doctor</button></a>
    <h2>Doctor Login Information</h2>
    <table>
        <thead>
            <tr>
                <th>Email Address</th>
                <th>Password</th>
                <th>Activated</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php

            $query="SELECT * FROM login_info WHERE account_type='D';";
            $loginInfoResult=mysqli_query($con, $query);
            if($loginInfoResult && mysqli_num_rows($loginInfoResult)>0)
            {
                while($row=mysqli_fetch_assoc($loginInfoResult))
                {
                    echo"<tr>";
                    echo"<td>".$row['email_address']."</td>";
                    echo"<td>**********</td>";
                    echo"<td>".$row['activated']."</td>";
                    echo "<td>
                    <a href=\"adminChangePassword.php?email=".$row['email_address']."\"><button>Change password</button></a>
                    <a href=\"deleteAccount.php?email=".$row['email_address']."\"><button class=\"deleteBtn\">Delete User</button></a>
                    </td>";
                    echo"</tr>";
                }
            }
        ?>
        </tbody>
    </table>
    <h2>Doctor Basic Information</h2>
    <table>
        <thead>
            <tr>
                <th>Doctor ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Professional Statement</th>
                <th>Active Since</th>
                <th>Email Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php

        $query="SELECT * FROM doctor_information";
        $docInfoResult=mysqli_query($con, $query);
        if($docInfoResult && mysqli_num_rows($docInfoResult)>0)
        {
            while($row=mysqli_fetch_assoc($docInfoResult))
            {
                echo"<tr>";
                echo"<td>".$row['doctor_id']."</td>";
                echo"<td>".$row['first_name']."</td>";
                echo"<td>".$row['last_name']."</td>";
                echo"<td>".$row['professional_statement']."</td>";
                echo"<td>".$row['active_since']."</td>";
                echo"<td>".$row['email_address']."</td>";
                echo"<td><a href=\"editDoctorInfo.php?doctor_id=".$row['doctor_id']."\"><button>Edit</button></a></td>";
                echo"</tr>";    
            }
        }
        ?>
    </tbody>
    </table>
    <h2>Doctor Hospital Affiliation Information</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor ID</th>
                <th>Hospital Name</th>
                <th>City</th>
                <th>Country</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php

        $query="SELECT * FROM hospital_affiliation";
        $affiliationResult=mysqli_query($con, $query);
        if($affiliationResult && mysqli_num_rows($affiliationResult)>0)
        {
            while($row=mysqli_fetch_assoc($affiliationResult))
            {
                echo"<tr>";
                echo"<td>".$row['id']."</td>";
                echo"<td>".$row['doctor_id']."</td>";
                echo"<td>".$row['hospital_name']."</td>";
                echo"<td>".$row['city']."</td>";
                echo"<td>".$row['country']."</td>";
                echo"<td>".$row['start_date']."</td>";
                echo"<td>".$row['end_date']."</td>";
                echo"<td><a href=\"editDoctorInfo.php?doctor_id=".$row['doctor_id']."\"><button>Edit</button></a></td>";
                echo"</tr>";
            }
        }
        ?>
    </tbody>
    </table>
    <h2>Doctor Qualification Information</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor ID</th>
                <th>Qualification Name</th>
                <th>Institute Name</th>
                <th>Procurement Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php

        $query="SELECT * FROM qualification";
        $qualificationResult=mysqli_query($con, $query);
        if($qualificationResult && mysqli_num_rows($qualificationResult)>0)
        {
            while($row=mysqli_fetch_assoc($qualificationResult))
            {
                echo"<tr>";
                echo"<td>".$row['id']."</td>";
                echo"<td>".$row['doctor_id']."</td>";
                echo"<td>".$row['qualification_name']."</td>";
                echo"<td>".$row['institute_name']."</td>";
                echo"<td>".$row['procurement_date']."</td>";
                echo"<td><a href=\"editDoctorInfo.php?doctor_id=".$row['doctor_id']."\"><button>Edit</button></a></td>";
                echo"</tr>";
            }
        }
        ?>
    </tbody>
    </table>
    <h2>Doctor Specialization Information</h2>
    <a href="addDoctorSpecialization.php"><button class="addBtn">Add Doctor Specialization</button></a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor ID</th>
                <th>Specialization ID</th>
                <th>Specialization Name</th>
            </tr>
        </thead>
        <tbody>
        <?php

        $query="SELECT * FROM doctor_specialization INNER JOIN specialization ON doctor_specialization.specialization_id=specialization.id ORDER BY doctor_id";
        $speializationResult=mysqli_query($con, $query);
        if($affiliationResult && mysqli_num_rows($speializationResult)>0)
        {
            while($row=mysqli_fetch_assoc($speializationResult))
            {
                echo"<tr>";
                echo"<td>".$row['id']."</td>";
                echo"<td>".$row['doctor_id']."</td>";
                echo"<td>".$row['specialization_id']."</td>";
                echo"<td>".$row['specialization_name']."</td>";
                echo"</tr>";
            }
        }
        ?>
    </tbody>
    </table>
    
    <h2>Doctor Work Schedule Information</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor ID</th>
                <th>Day</th>
                <th>Shift</th>
                <th>Start time</th>
                <th>End time</th>
            </tr>
        </thead>
        <tbody>
        <?php

        $query="SELECT * FROM works INNER JOIN shift_duration ON works.shift_id=shift_duration.shift_id ORDER BY doctor_id";
        $worksResult=mysqli_query($con, $query);
        if($worksResult && mysqli_num_rows($worksResult)>0)
        {
            while($row=mysqli_fetch_assoc($worksResult))
            {
                echo"<tr>";
                echo"<td>".$row['id']."</td>";
                echo"<td>".$row['doctor_id']."</td>";
                echo"<td>".$row['day_of_week']."</td>";
                echo"<td>".$row['shift_name']."</td>";
                echo"<td>".$row['start_time']."</td>";
                echo"<td>".$row['end_time']."</td>";
                echo"</tr>";
            }
        }
        ?>
    </tbody>
    </table>
    </main>
</body>
</html>