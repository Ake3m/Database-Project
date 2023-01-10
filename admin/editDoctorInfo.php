<?php
include_once("adminHeader.php");
include_once("../connection.php");
include_once("../doctorFunctions.php");

$doctor_id=$_GET['doctor_id'];

if(isset($_POST['update']))
{
   

    $first_name=$_POST['fname'];
    $surname=$_POST['sname'];
    $personal_statement=$_POST['pStatement'];
    $active_since=$_POST['active_since_date'];

    $quaification_name=$_POST['qualification_name'];
    $institute_name=$_POST['institute_name'];
    $procurementDate=$_POST['pdate'];


    $hospital_name=$_POST['hospital_name'];
    $hospital_city=$_POST['hospital_city'];
    $hospital_country=$_POST['hospital_country'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];

    if(!empty($end_date)){
        if(checkDates($start_date, $end_date)!==false)
        {
            header("location: editDoctorInfo.php?error=dateError");
            exit();
        }
    }
    editInformation($con, $doctor_id, $first_name, $surname,$personal_statement,$active_since,$quaification_name, $institute_name, $procurementDate, $hospital_name,$hospital_city,$hospital_country,$start_date,$end_date);
}

if(isset($_POST['cancel']))
{
    header("location: manageDoctor.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Information</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
<main id="box">
    <h1>Edit Doctor Information</h1>
    <form method="post">
        <h2>Basic Information</h2>
        <?php
        $query="SELECT * 
        FROM doctor_information INNER JOIN hospital_affiliation ON doctor_information.doctor_id=hospital_affiliation.doctor_id
        INNER JOIN qualification ON doctor_information.doctor_id=qualification.doctor_id INNER JOIN doctor_specialization ON doctor_information.doctor_id=doctor_specialization.doctor_id WHERE doctor_information.doctor_id=\"".$doctor_id."\";";
        $result=mysqli_query($con, $query);
        $row=mysqli_fetch_assoc($result);
        ?>
        <label for="fname">First Name </label>
        <input id="fname" type="text" value="<?php echo $row['first_name']?>" name="fname">
        <label for="sname">Last Name</label>
        <input id="sname" type="text" value=" <?php echo $row['last_name']?>"" name="sname">
        
        
        <label for="personal_statment">Personal Statement</label>
        <textarea id="personal_statment" name="pStatement" rows="10" cols="60" required><?php echo $row['professional_statement']?></textarea>
        
        <label for="active_since">Active since</label>
        <input id="active_since" type="date" value="<?php echo $row['active_since']?>" name="active_since_date" required>
        <h2>Medical Experience Information</h2>
        
        <h3>Qualifications</h3>
        <p>Please input the doctor's HIGEST level qualification below.</p>
        <label for="qname">Name of Qualification</label>
        <input type="text" id="qname" value="<?php echo $row['qualification_name'] ?>" name="qualification_name" required placeholder="Qualification">
        <label for="iname">Name of Institute</label>
        <input type="text" id="iname" value="<?php echo $row['institute_name'] ?>" name="institute_name" required placeholder="Institute name">
        <label for="pdate">Procurment date</p>
        <input id="pdate" value="<?php echo $row['procurement_date'] ?>" name="pdate" type="date" required">
        
        <h3>Hospital affiliation</h3>
        <label for="hospital_name">Hospital name</label><input id="hospital_name" type="text" value="<?php echo $row['hospital_name'] ?>" name="hospital_name" required>
        <label for="hospital_city">Hospital city</label><input id="hospital_city" type="text" value="<?php echo $row['city'] ?>" name="hospital_city" required>
        <label for="hospital_country">Hospital country</label><input id="hospital_country"type="text" value="<?php echo $row['country'] ?>" name="hospital_country" required>
        <label for="start_date">Start date</label>
        <input id="start_date" type="date" value="<?php echo $row['start_date'] ?>" name="start_date" required>
        <label for="end_date">End date</label><input id="end_date"type="date" value="<?php echo $row['end_date'] ?>" name="end_date">
        <p>Note: If still affiliated, leave the end date blank</p>
        
        <p>Please verify all the information before submitting</p>
        <input type="submit" name="update" value="Submit">
    </form>
    <form method="post">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    </main>
</body>
</html>