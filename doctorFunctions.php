<?php
include_once("functions.php");


function checkDates($startdate, $enddate)
{
    if($startdate>$enddate)
    {
        return true;
    }
    return false;
}
function checkSpecialization($specialization_list)
{
    if(count($specialization_list)===0)
    {
        return true;
    }
    else{
        return false;
    }
}
function updateBasicInfo($con,$id, $fname, $sname, $pStatement, $active_since)
{
    $updateQuery="UPDATE doctor_information SET first_name= ?, last_name= ?, professional_statement= ? , active_since=? WHERE doctor_id=?;";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $updateQuery))
    {
        header("location: doctorRegistration.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssi", $fname, $sname, $pStatement, $active_since, $id);

    mysqli_stmt_close($stmt);
    
}

function updatePassword($con,$email, $pw)
{
    $hashedPw=password_hash($pw, PASSWORD_DEFAULT);
    $passwordUpdateQuery="UPDATE login_info SET password=? WHERE email_address=?;";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepae($stmt, $passwordUpdateQuery))
    {
        header("location: doctorRegistration.php?error=stmtfailed");
        exit();
    }
    
    
}

function insertQualifications($con,$doc_id, $qname, $iname, $pdate)
{
    $query="INSERT INTO qualification(doctor_id, qualification_name, institute_name,procurement_date) VALUES('$doc_id','$qname','$iname','$pdate');";
    if(!mysqli_query($con, $query))
    {
        header("location: doctorRegistration.php?error=qualificationInsertError");
        exit();
    }
}

function insertSpecializations($con, $id, $specialization_list)
{
    foreach($specialization_list as $specialization)
    {
        $query="INSERT INTO doctor_specialization(doctor_id,specialization_id) VALUES ('$id', '$specialization');";
        if(!mysqli_query($con, $query))
        {
            header("location: doctorRegistration.php?error=specializationError");
            exit();
        }
    }
}

function insertAffiliation($con, $id,$hname, $hcity, $hcountry,$start_date, $end_date)
{
    $query="INSERT INTO hospital_affiliation(doctor_id, hospital_name, city,country, start_date,end_date) VALUES ('$id','$hname','$hcity','$hcountry','$start_date','$end_date');";
    if(!mysqli_query($con, $query))
    {
        header("location: doctorRegistration.php?error=affiliationerror");
        exit();
    }
}

function insertWorkSchedule($con, $id,$monday, $tuesday, $wednesday,$thursday, $friday)
{
    $daysofweek=array("Monday"=>$monday,"Tuesday"=>$tuesday, "Wednesday"=>$wednesday, "Thursday"=>$thursday, "Friday"=>$friday);
    foreach($daysofweek as $day=>$value)
    {
        if(isset($value))
        {
            $query="INSERT INTO works(doctor_id,day_of_week,shift_id) VALUES('$id','$day', '$value');";
            if(!mysqli_query($con, $query))
            {
                header("location: doctorRegistration.php?error=workserror");
                exit();
            }

        }
    }
}

function checkSchedule($monday, $tuesday, $wednesday, $thursday, $friday)
{
    if(!empty($monday) && !empty($tuesday) && !empty($wednesday) && !empty($thursday) && !empty($friday))
    {
        return false;
    }
    else{
        return true;
    }
}

function completeRegistration($con, $id,$email, $fname, $sname, $pStatement, $active_since, $pw, $qname, $iname, $pdate, $specialty_list, $hname, $hcity, $hcountry, $start_date, $end_date, $monday, $tuesday, $wednesday, $thursday, $friday )
{
    $activated="Y";
    $hashedPw=password_hash($pw, PASSWORD_DEFAULT); // hash the inputted password
    $daysofweek=array("Monday"=>$monday,"Tuesday"=>$tuesday, "Wednesday"=>$wednesday, "Thursday"=>$thursday, "Friday"=>$friday);
    //queries
    $updateBasicQuery="UPDATE doctor_information SET first_name= ?, last_name= ?, professional_statement= ? , active_since=? WHERE doctor_id=?;";
    $passwordUpdateQuery="UPDATE login_info SET password=? WHERE email_address=?;";
    $qualificationQuery="INSERT INTO qualification(doctor_id, qualification_name, institute_name,procurement_date) VALUES(?,?,?,?);";
    $specializationQuery="INSERT INTO doctor_specialization(doctor_id,specialization_id) VALUES (?, ?);";
    $affiliationQuery="INSERT INTO hospital_affiliation(doctor_id, hospital_name, city,country, start_date,end_date) VALUES (?,?,?,?,?,?);";
    $scheduleQuery="INSERT INTO works(doctor_id,day_of_week,shift_id) VALUES(?,?,?);";
    $updateStatusQuery="UPDATE login_info SET activated=? WHERE email_address=?;";
    //statements
    $basicInfoStmt=mysqli_stmt_init($con);
    $passwordUpdateStmt=mysqli_stmt_init($con);
    $qualificationStmt=mysqli_stmt_init($con);
    $specializationStmt=mysqli_stmt_init($con);
    $affiliationStmt=mysqli_stmt_init($con);
    $scheduleStmt=mysqli_stmt_init($con);
    $updateStatusStmt=mysqli_stmt_init($con);

    if(!mysqli_stmt_prepare($basicInfoStmt, $updateBasicQuery) || !mysqli_stmt_prepare($passwordUpdateStmt, $passwordUpdateQuery) || !mysqli_stmt_prepare($qualificationStmt,$qualificationQuery) || !mysqli_stmt_prepare($specializationStmt, $specializationQuery) || !mysqli_stmt_prepare($affiliationStmt, $affiliationQuery) || !mysqli_stmt_prepare($scheduleStmt, $scheduleQuery) || !mysqli_stmt_prepare($updateStatusStmt, $updateStatusQuery))
    {
        header("location: doctorRegistration.php?error=stmtfailed");
        exit();
    }
    //binding
    mysqli_stmt_bind_param($basicInfoStmt, "ssssi", $fname, $sname, $pStatement, $active_since, $id);
    mysqli_stmt_bind_param($passwordUpdateStmt,"ss", $hashedPw, $email);
    mysqli_stmt_bind_param($qualificationStmt, "isss", $id, $qname, $iname, $pdate);
    mysqli_stmt_bind_param($affiliationStmt,"isssss",$id, $hname, $hcity, $hcountry, $start_date,$end_date);
    mysqli_stmt_bind_param($updateStatusStmt, "ss",$activated, $email);

    //executing
    mysqli_stmt_execute($basicInfoStmt);
    mysqli_stmt_execute($passwordUpdateStmt);
    mysqli_stmt_execute($qualificationStmt);
    mysqli_stmt_execute($affiliationStmt);
    foreach($specialty_list as $specialization)
    {
        mysqli_stmt_bind_param($specializationStmt, "ii", $id, $specialization);
        mysqli_stmt_execute($specializationStmt);
    }
    foreach($daysofweek as $day=>$value)
    {
        mysqli_stmt_bind_param($scheduleStmt, "isi", $id, $day, $value);
        mysqli_stmt_execute($scheduleStmt);
    }
    mysqli_stmt_execute($updateStatusStmt);

    mysqli_stmt_close($basicInfoStmt);
    mysqli_stmt_close($passwordUpdateStmt);
    mysqli_stmt_close($qualificationStmt);
    mysqli_stmt_close($affiliationStmt);
    mysqli_stmt_close($specializationStmt);
    mysqli_stmt_close($scheduleStmt);
    mysqli_stmt_close($updateStatusStmt);

    header("location:logout.php");
    exit();
}


?>