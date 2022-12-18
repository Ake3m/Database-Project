<?php
    include_once('header.php');
    if(isset($_SESSION['user_data']))
    {
        $userdata=$_SESSION['user_data'];
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
            echo "<hr>";
            echo "<p>Birthday: ".$date_of_birth."</p>";
            echo "<hr>";
           if($gender==='M')
           {
                echo "<p>Gender: Male</p>";
           }
           else{
                echo "<p>Gender: Female</p>";
           }
            echo "<hr>";
            echo "<p>Address: ".$address."</p>";
            echo "<button>Update Address</button>";
            echo "<hr>";
            if(isset($health_insurance))
            {
                echo "<p>Health Insurance #: ".$health_insurance."</p>";
            }
            else{
                echo "<p>Health Insurance #: None</p>";
            }
            echo "<button>Update Insurance</button>";
            echo "</div>";
            echo "<div>";
            echo "<h2>Contact Information</h2>";
            echo "<p>Email address: ".$email."</p>";
            echo "<hr>";
            echo "<p>Phone: ".$phone_number."</p>";
            echo "<button>Phone Number</button>";
            echo "<hr>";
            echo "</div>";
            echo "<div>";
            echo "<h2>Appointment History</h2>";
            // TODO: Insert Appointment Information
            echo "<p>No Appointments to show</p>";
            echo "</div>";
            

                
        ?>
    </main>
</body>
</html>