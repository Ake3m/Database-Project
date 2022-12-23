<?php
function check_login($con)
{
   if($_SESSION['email'])
   {
    $email=$_SESSION['email'];
    if($_SESSION['accountType']==='R')
    {
        $query = "select * from user_info where email_address='$email';";
        $result=mysqli_query($con, $query);
        if($result && mysqli_num_rows($result)>0)
        {
            $user_data=mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    else if($_SESSION['accountType']==='D')
    {
        $query="select * from doctor_information where email_address='$email';";
        $result=mysqli_query($con, $query);
        if($result && mysqli_num_rows($result)>0)
        {
            $doctor_data=mysqli_fetch_assoc($result);
            return $doctor_data;
        }
    }
   }
   else{
    header("Location: login.php");
    die;
   }
   //redirect to login
   
}

function emptyInputSignup($email, $password,$password2, $first_name, $middle_name, $last_name, $gender, $dob, $phone_numer, $address)
{

    $result=false;
    if(empty($email) || empty($password)|| empty($password2)|| empty($first_name)|| empty($last_name)|| empty($gender)|| empty($dob)|| empty($dob)|| empty($address) )
    {
        $result=true;
    }
    return $result;
}

function invalidEmail($email)
{

    $result=false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result=true;
    }
    return $result;
}
function pwdMatch($password, $password2)
{

    $result=false;
    if($password!==$password2)
    {
        $result=true;
    }
    return $result;
}

function createUser($con,$email, $password, $first_name, $middle_name, $last_name, $gender, $dob, $phone_number, $address,$health_insurance_number)
{
    $query="INSERT INTO login_info (email_address, password) VALUES (?,?)";
    $query2="insert into user_info(first_name, middle_name, last_name, gender, email_address, date_of_birth, phone_number, health_insurance_number, address) values(?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($con);
    $stmt2=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $query))
    {
        header("location signup.php?error=stmtfailed");
        exit();
    }
    if(!mysqli_stmt_prepare($stmt2, $query2))
    {
        header("location signup.php?error=stmtfailed");
        exit();
    }

    $hashedPassword=password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
    mysqli_stmt_bind_param($stmt2, "ssssssiss", $first_name,$middle_name,$last_name, $gender, $email, $dob, $phone_number, $health_insurance_number, $address);


    mysqli_stmt_execute($stmt);
    mysqli_stmt_execute($stmt2);

    
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);

    header("location: signup.php?error=none");
}

function emailExists($con,$email)
{
    $sql="SELECT * FROM login_info WHERE email_address = ?;";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result=false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function loginUser($con, $email, $password)
{
    $emailExists = emailExists($con, $email);

    if($emailExists===false)
    {
        header("location: login.php?error=wronglogin1");
        exit();
    }
    $passwordHashed=$emailExists['password'];
    $checkedPassword=password_verify($password, $passwordHashed);
    if($checkedPassword===false)
    {
        header("location: login.php?error=wronglogin");
        exit();
    }
    else if($checkedPassword===true)
    {

        session_start();
        $_SESSION['email']= $emailExists['email_address'];
        $_SESSION['accountType']=$emailExists['account_type'];
        $_SESSION['activated']=$emailExists['activated'];
        header("location: index.php");
        exit();
    }
}



?>