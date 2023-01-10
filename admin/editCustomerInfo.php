<?php
include_once("adminHeader.php");
include_once("../connection.php");
include_once("adminFunctions.php");

$user_id=$_GET['id'];

if(isset($_POST['edit']))
{
    $fname=$_POST['first_name'];
    $mname=$_POST['middle_name'];
    $lname=$_POST['last_name'];
    $gender=$_POST['gender'];
    $date=$_POST['date'];
    $phone=$_POST['phone'];
    $health=$_POST['health'];
    $address=$_POST['address'];

    if($gender!=="M" || $gender!=="M")
    {
        header("location: editCustomerInfo.php?error=gender");
        exit();
    }

    $updateQ="UPDATE user_info SET first_name='$fname', middle_name='$mname', last_name='$lname', gender='$gender', date_of_birth='$date', phone_number='$phone',health_insurance_number='$health', address='$address' WHERE uid=$user_id;";
    if(mysqli_query($con, $updateQ))
    {
        header("location: manageCustomers.php?error=none");
        exit();
    }
    else{
        header("location: editCustomerInfo.php?error=unknown");
        exit();
    }
    
}
if(isset($_POST['cancel']))
    {
        header("location: manageCustomers.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Information</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <main id="box">
        <?php
            $getInfo="SELECT * FROM user_info WHERE uid='$user_id';";
            $result=mysqli_query($con, $getInfo);
            if($result)
            {
                $row=mysqli_fetch_assoc($result);
            }
            else{
                header("location: manageCustomers.php?error=connection");
                exit();
            }
        ?>
        <h1>Edit Patient Information</h1>
        <form method="post">
            <label id="first_name">First Name</label>
            <input id="first_name"type="text" name="first_name" required value="<?php echo $row['first_name'] ?>">
            <label id="middle_name">Middle Name</label>
            <input id="middle_name"type="text" name="middle_name" value="<?php echo $row['middle_name'] ?>">
            <label id="last_name">Last Name</label>
            <input id="last_name"type="text" name="last_name" required value="<?php echo $row['last_name'] ?>">
            <label id="gender">Gender</label>
            <input id="gender"type="text" name="gender" required minlength="1" maxlength="1" value="<?php echo $row['gender'] ?>">
            <label id="date">Date of Birth</label>
            <input id="date"type="date" name="date" required value="<?php echo $row['date_of_birth']?>">
            <label id="phone">Phone number</label>
            <input id=""type="text" name="phone" required value="<?php echo $row['phone_number'] ?>">
            <label id="health">Health Insurance</label>
            <input id="health"type="text" name="health" required value="<?php echo $row['health_insurance_number'] ?>">
            <label id="address">Address</label>
            <input id="address"type="text" name="address" required value="<?php echo $row['address'] ?>">
            <input type="submit" name="edit" value="Edit">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </main>
</body>
</html>