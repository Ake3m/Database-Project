<?php
include_once("adminHeader.php");
include_once("../connection.php");

$email=$_GET['email'];

if(isset($_POST['yes']))
{
    $deleteUser="DELETE from login_info WHERE email_address=\"".$email."\";";
    if(mysqli_query($con, $deleteUser))
    {
        header("location: adminpanel.php");
        exit();
    }
}
if(isset($_POST['no']))
{
    header("location:adminpanel.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <main id="box">
        <h1>Delete Account</h1>
        <?php
                echo "<p>Are you sure you want to delete this account (".$email.") and all associated information?</p>"
            ?>
        <form method="post">
            <input type="submit" name="yes" value="Yes">
            <input type="submit" name="no" value="No">
        </form>
    </main>
</body>
</html>