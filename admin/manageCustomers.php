<?php
include_once("adminHeader.php");
include_once("../connection.php");
include_once("adminFunctions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <main id="box">
    <h1>Customer Management</h1>
    <h2>Customer Login Information</h2>
    <table>
        <thead>
            <tr>
                <th>Email Address</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php

            $query="SELECT * FROM login_info WHERE account_type='R';";
            $loginInfoResult=mysqli_query($con, $query);
            if($loginInfoResult && mysqli_num_rows($loginInfoResult)>0)
            {
                while($row=mysqli_fetch_assoc($loginInfoResult))
                {
                    echo"<tr>";
                    echo"<td>".$row['email_address']."</td>";
                    echo"<td>**********</td>";
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
    <h2>Customer Basic Information</h2>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email Address</th>
                <th>Date Of Birth</th>
                <th>Phone number</th>
                <th>Health Insurance Number</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php

            $query="SELECT * FROM user_info;";
            $InfoResult=mysqli_query($con, $query);
            if($InfoResult && mysqli_num_rows($InfoResult)>0)
            {
                while($row=mysqli_fetch_assoc($InfoResult))
                {
                    echo"<tr>";
                    echo"<td>".$row['uid']."</td>";
                    echo"<td>".$row['first_name']."</td>";
                    echo"<td>".$row['middle_name']."</td>";
                    echo"<td>".$row['last_name']."</td>";
                    echo"<td>".$row['gender']."</td>";
                    echo"<td>".$row['email_address']."</td>";
                    echo"<td>".$row['date_of_birth']."</td>";
                    echo"<td>".$row['phone_number']."</td>";
                    echo"<td>".$row['health_insurance_number']."</td>";
                    echo"<td>".$row['address']."</td>";
                    echo "<td>
                    <a href=\"editCustomerInfo.php?id=".$row['uid']."\"><button>Edit</button></a>
                    </td>";
                    echo"</tr>";
                }
            }
        ?>
        </tbody>
    </table>
        </main>
</body>
</html>