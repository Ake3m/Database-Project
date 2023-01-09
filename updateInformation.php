<?php
    include_once('header.php');
    include_once('connection.php');

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

        if(isset($_POST['save']))
        {
            $phone=$_POST['phone'];
            $addr=$_POST['address'];
            $insurance=$_POST['insurance'];

            $updateQuery="UPDATE user_info SET phone_number=".$phone.", health_insurance_number=\"".$insurance."\", address=\"".$addr."\" WHERE uid=".$user_id.";";
            if(mysqli_query($con, $updateQuery))
            {
                header("location: logout.php");
                exit();
            }
            else{
                //report error
            }
        }
        if(isset($_POST['cancel']))
        {
            header("location: profile.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Information</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <main id="box">
    <h1>Update Information</h1>
    <p>Update the informaton in the textboxes below and then once satisfied, press the submit button</p>
    <p>Once you submit, you will be signed out and propmted to login once more<p>
    <?php
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
            echo "<p>Email address: ".$email."</p>";

            echo"<form method=\"post\">
            <label for=\"address\">Address: </label>
            <input id=\"address\" type=\"text\" required name=\"address\" value=\"".$address."\"/>
            <label for=\"insurance\">Health Inurance</label>
            <input id=\"insurance\" type=\"text\" name=\"insurance\" value=\"".$health_insurance."\"/>";
            echo "<h2>Contact Information</h2>";
            echo "<p>Email address: ".$email."</p>";
            
            echo"  <label for=\"phone\">Phone #: </label>";
            echo "<input id=\"phone\" type=\"text\" name=\"phone\" required value=\"".$phone_number."\"/>";
            echo "<input type=\"submit\" name=\"save\" value=\"Save Changes\"/>";
            echo "<input type=\"submit\" name=\"cancel\" value=\"Cancel\"/>";
            echo"</form>";
        ?>
    </main>
</body>
</html>