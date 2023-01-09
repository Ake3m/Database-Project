<?php
include_once('header.php');
include_once('connection.php');
include_once('functions.php');


if(isset($_POST['updatePass']))
{
    $currPass=$_POST['current_password'];
    $newPass=$_POST['new_password'];
    $newPass2=$_POST['new_password2'];
    $email=$_SESSION['email'];
    updatePassword($con,$email, $currPass, $newPass, $newPass2);
}
if(isset($_POST['cancel']))
{
    header("location: profile.php");
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
</head>
<body>
    <h1>Update password</h1>
    <p>PLEASE NOTE: Updating your password can have devastating effects in regards to your account access.</p>
    <p>If you want to change your password, first, enter your current password below. Then enter your new password twice below.</p>
    
    <form method="post">

        <label for="current_password">Enter your current password: </label>
        <input id="current_password" type="password" required name="current_password"/>
        <label for="new_password">Enter your new password: </label>
        <input id="new_password" type="password" required name="new_password"/>
        <label for="new_password2">Enter your new password: </label>
        <input id="new_password2" type="password" required name="new_password2"/>
        <input type="submit" name="updatePass" value="Update password"/>
    </form>
    <form method="post">
    <input type="submit" name="cancel" value="Cancel"/>
    </form>
</body>
</html>