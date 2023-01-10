<?php
include_once("adminHeader.php");
include_once("../connection.php");
include_once("adminFunctions.php");

$email=$_GET['email'];
if(isset($_POST['updatePass']))
{
    $newPass=$_POST['new_password'];
    $newPass2=$_POST['new_password2'];
    $email=$_SESSION['email'];
    changeUserPassword($con,$email, $newPass, $newPass2);
}
if(isset($_POST['cancel']))
{
    header("location: adminpanel.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update password</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <main id="box">
    <h1>Update User password</h1>

    <form method="post">

        <label for="new_password">Enter user's new password: </label>
        <input id="new_password" type="password" required name="new_password"/>
        <label for="new_password2">Enter user's new password again: </label>
        <input id="new_password2" type="password" required name="new_password2"/>
        <br>
        <input type="submit" name="updatePass" value="Update password"/>
    </form>
    <form method="post">
    <input type="submit" name="cancel" value="Cancel"/>
    </form>
</main>
</body>
</html>