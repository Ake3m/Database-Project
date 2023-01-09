<?php
    include_once('header.php');
    if(isset($_SESSION['user_data']))
    {
        $userdata=$_SESSION['user_data'];
        $user_id=$userdata['uid'];
        $first_name=$userdata['first_name'];
        $middle_name=$userdata['middle_name'];
        $last_name=$userdata['last_name'];
        $gender=$userdata['gender'];
        $email=$userdata['email_address'];
        $date_of_birth=$userdata['date_of_birth'];
        $phone_number=$userdata['phone_number'];
        $health_insurance=$userdata['health_insurance_number'];
        $address=$userdata['address'];
    }

    if(isset($_POST['update']))
    {
        
        header("location: updateInformation.php");
        exit();
    }

    if(isset($_POST['password']))
    {
        header("location: updatePassword.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <main>
        
        <?php
            echo "<div>";
            echo "<h2>Basic Information</h2>";
            if(isset($middle_name))
            {
                echo "<p>Name: ".$first_name.' '.$middle_name.' '.$last_name."</p>";
            }
            else{
                echo "<p>Name: ".$first_name.' '.$last_name."</p>";
            }
            
            echo "<p>Birthday: ".$date_of_birth."</p>";
            
           if($gender==='M')
           {
                echo "<p>Gender: Male</p>";
           }
           else{
                echo "<p>Gender: Female</p>";
           }
            echo "<p>Address: ".$address."</p>";
            if(isset($health_insurance))
            {
                echo "<p>Health Insurance #: ".$health_insurance."</p>";
            }
            else{
                echo "<p>Health Insurance #: None</p>";
            }

            echo "</div>";
            echo "<div>";
            echo "<h2>Contact Information</h2>";
            echo "<p>Email address: ".$email."</p>";
            
            echo "<p>Phone: ".$phone_number."</p>";
            echo "</div>";
            echo "<div>";    
        ?>
        <h2>Update Area</h2>
        <p>To update your basic and/or contact information, press select the update information button below.</p>
        <p>To update your password information, please select the update password button below.</p>
        <form method="post">
            <input type="submit"  value="Update Information" name="update">
            <input type="submit" name="password" value="Update Password">
        </form>
    </main>
</body>
</html>