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

function addDoctor($con, $doc_email, $doc_firstname, $doc_surname){
    $defaultpassword="123456789";
    $accountType="D";
    $activated="N";
    $addquery="INSERT INTO login_info(email_address, password, account_type, activated) VALUES(?,?,?,?);";
    $addDocInfo="INSERT INTO doctor_information(first_name, last_name, email_address) VALUES(?,?,?);";
    $stmt=mysqli_stmt_init($con);
    $stmt2=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $addquery)){
        header("location: addDoctor.php?error=stmtfailed");
        exit();
    }
    if(!mysqli_stmt_prepare($stmt2, $addDocInfo)){
        header("location: addDoctor.php?error=stmtfailed");
        exit();
    }
    $hashedPassword=password_hash($defaultpassword, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $doc_email, $hashedPassword, $accountType, $activated);
    mysqli_stmt_bind_param($stmt2, "sss", $doc_firstname, $doc_surname, $doc_email);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_execute($stmt2);

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);

    header("location: adminpanel.php?error=none");
}

function addSpecialization($con, $specialization_name)
{
    $addQuery="INSERT INTO specialization(specialization_name) VALUES('$specialization_name');";
    if(!mysqli_query($con, $addQuery))
    {
        header("location: manageSpecialization.php?error=inputerror");
        exit();
    }
    else{
        header("location: manageSpecialization.php?error=none");
        exit();
    }
}

function changeUserPassword($con,$email, $pw1, $pw2)
{
    if($pw1!==$pw2)
    {
        header("location: adminChangePassword?error=passwordmismatch");
        exit();
    }
    $hashedPw=password_hash($pw1, PASSWORD_DEFAULT);

    $updatePwdQuery="UPDATE login_info SET password=\"".$hashedPw."\";";
    if(mysqli_query($con, $updatePwdQuery))
    {
        header("location: adminpanel.php?error=none");
        exit();
    }
}

?>