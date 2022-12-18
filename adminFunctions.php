<?php
function authenticate($con, $user)
{
    $checkAdminTable="SELECT * FROM admin_login WHERE login = ?;";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $checkAdminTable))
    {
        header("location: adminLogin.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function loginAdmin($con, $user, $password)
{
    $userExists=authenticate($con,$user);
    if($userExists===false)
    {
        header("location: adminLogin.php?error=wronglogin");
        exit();
    }
    $hashedPassword=$userExists['password'];
    $checkedPassword=password_verify($password, $hashedPassword);
    if($checkedPassword===false)
    {
        header("location: adminLogin.php?error=wronglogin");
        exit();
    }
    else if($checkedPassword===true)
    {
        session_start();
        $_SESSION['admin']=$userExists['login'];
        header("location: adminpanel.php");
        exit();
    }
}

?>