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
    <h1>Doctor Management</h1>
    <a href="addDoctor.php" class="addBtn">Add Doctor</a>
    <table>
        <thead>
            <tr>
                <th>Doctor ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Activated</th>
            </tr>
        </thead>
        <tbody>
        <?php

            $query="SELECT * FROM doctor_information, login_info WHERE doctor_information.email_address =login_info.email_address;";
            $result=mysqli_query($con, $query);
           if( $result && mysqli_num_rows($result)>0)
           {
            while($row=mysqli_fetch_assoc($result))
            {
                $doctor_id=$row['doctor_id'];
                $first_name=$row['first_name'];
                $last_name=$row['last_name'];
                $email_address=$row['email_address'];
                $activated=$row['activated'];
                echo"
                    <tr>
                        <td>".$doctor_id."</td>
                        <td>".$first_name."</td>
                        <td>".$last_name."</td>
                        <td>".$email_address."</td>
                        <td>".$activated."</td>
                    </tr>
                ";
            }
           }
        ?>
        </tbody>
    </table>
    <?php
    
    ?>
    
    

</body>
</html>