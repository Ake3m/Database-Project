<?php
include_once("connection.php");
include_once("doctorFunctions.php")
session_start();


if(isset($_POST['regsiterDoctor']))
{
    //BASIC INFORMATION
    $first_name=$_POST['fname'];
    $surname=$_POST['sname'];
    $personal_statement=$_POST['pStatement'];
    $active_since=$POST['active_since_date'];
    //ACCOUNTINFORMATION
    $newPassword=$_POST['password'];
    $newPassword2=$_POST['password2'];
    //MEDICAL EXPERIENCE INFORMATION
    $quaification_name=$_POST['qualification_name'];
    $institude_name=$_POST['institute_name'];
    $procurementDate=$_POST['pdate'];
    $speciality_list=$_POST['specialty'];
    //HOSPITAL INFORMATION
    $hospital_name=$_POST['hospital_name'];
    $hospital_city=$_POST['hospital_city'];
    $hospital_country=$_POST['hospital_country'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    //SCHEDULE INFORMATION
    $monday=$_POST['monday'];
    $tuesday=$_POST['tuesday'];
    $wednesday=$_POST['wednesday'];
    $thursday=$_POST['thursday'];
    $friday=$_POST['friday'];
    



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/registrationstyle.css"/>
    <title>Complete Registration</title>
</head>
<body>
    <h1>Complete the registration</h1>
    <p>In order to be visible to patients for booking, you must complete the registration process.</p>
    <form method="post">
        <h2>Basic Information</h2>
        <p>Some fields have already been filled for you. However, you can make changes if there are any inaccuracies.</p>

        <?php
        $user_data=$_SESSION['user_data'];
        $fname=$user_data['first_name'];
        $sname=$user_data['last_name'];
        echo"<p>Email: ".$user_data['email_address']."</p>";
        echo "<label for=\"fname\">First Name: </label>";
        echo "<input id=\"fname\" type=\"text\" value=\"".$fname."\" name=\"fname\">";
        echo "<label for=\"sname\">Last Name: </label>";
        echo "<input id=\"sname\" type=\"text\" value=\"".$sname."\" name=\"sname\">";
        
        ?>
        <p>The personal statement is basically a formal introduction. It helps give patients an idea of your background</p>
        
        <label for="personal_statment">Personal Statement</label>
        <textarea id="personal_statment" name="pStatement" rows="20" cols="100" required></textarea>
        <p>The active since field refers to the year in which you began practicing medicine.</p>
        <label for="active_since">Active since</label>
        <input id="active_since" type="date" name="active_since_date" required>
        <h2>Account Information</h2>
        <p>Please change your default password</p>
        <label for="password">Password</label>
        <input id="password" name="newpassword"type="password" placeholder="Password" required>
        <label for="password2">Please enter password again.</label>
        <input id="password2" name="newpassword2" type="password" placeholder="Password" required>
        <h2>Medical Experience Information</h2>
        <p>This section is for filling out information regarding your medical experience to help patients better understand what you do.</p>
        <h3>Qualifications</h3>
        <p>Please input your highest level qualification below. Other qualifications can be added after the registration process.</p>
        <label for="qname">Name of Qualification</label>
        <input type="text" id="qname" name="qualification_name" required placeholder="Qualification">
        <label for="iname">Name of Institute</label>
        <input type="text" id="iname" name="institute_name" required placeholder="Institute name">
        <label for="pdate">Procurment date</p>
        <input id="pdate" name="pdate" type="date" required">
        <h3>Specialization Information</h3>
        <fieldset class="specialization_box">
            <legend>Choose your specializations</legend>
            <?php
                $getSpecializations="SELECT * FROM specialization;";
                $results=mysqli_query($con,$getSpecializations);
                if($results && mysqli_num_rows($results)>0)
                {
                    while($row=mysqli_fetch_assoc($results))
                    {
                        $id=$row['id'];
                        $special_option=$row['specialization_name'];
                        echo "
                        <input id=\"specialty".$id."\" type=\"checkbox\" name=\"specialty\" value=\"".$id."\">
                        <label for=\"specialty".$id."\">".$special_option."</label>
                        <br>
                        ";
                    }
                }
            ?>
        </fieldset>
        <h3>Hospital affiliation</h3>
        <p>Input information regarding your hospital affiliations</p>
        <label for="hospital_name">Hospital name</label><input id="hospital_name" type="text" name="hospital_name">
        <label for="hospital_city">Hospital city</label><input id="hospital_city" type="text" name="hospital_city">
        <label for="hospital_country">Hospital country</label><input id="hospital_country"type="text" name="hospital_country">
        <label for="start_date">Start date</label>
        <input id="start_date" type="date" name="start_date" required>
        <label for="end_date">End date</label><input id="end_date"type="date" name="end_date">
        <p>Note: If still affiliated, leave the end date blank</p>
        <h2>Work Schedule</h2>
        <p>Please select the days the clinic has assigned you to work.</p>
        <table class="schedule">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Shift</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monday</td>
                    <td>
                        <input id="monday1" type="radio" name="monday" value="1">
                        <label for="monday">Morning</label>
                        <input id="monday2" type="radio" name="monday" value="2">
                        <label for="monday2">Evening</label>
                        <input id="monday3" type="radio" name="monday" value="3">
                        <label for="monday3">All day</label>
                        <input id="monday4" type="radio" name="monday" value="4">
                        <label for="monday4">Day off</label>
                    </td>
                </tr>
                <tr>
                    <td>Tuesday</td>
                    <td>
                        <input id="tuesday1" type="radio" name="tuesday" value="1">
                        <label for="tuesday">Morning</label>
                        <input id="tuesday2" type="radio" name="tuesday" value="2">
                        <label for="tuesday2">Evening</label>
                        <input id="tuesday3" type="radio" name="tuesday" value="3">
                        <label for="tuesday3">All day</label>
                        <input id="tuesday4" type="radio" name="tuesday" value="4">
                        <label for="tuesday4">Day off</label>
                    </td>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <td>
                        <input id="wednesday1" type="radio" name="wednesday" value="1">
                        <label for="wednesday">Morning</label>
                        <input id="wednesday2" type="radio" name="wednesday" value="2">
                        <label for="wednesday2">Evening</label>
                        <input id="wednesday3" type="radio" name="wednesday" value="3">
                        <label for="wednesday3">All day</label>
                        <input id="wednesday4" type="radio" name="wednesday" value="4">
                        <label for="wednesday4">Day off</label>
                    </td>
                </tr>
                <tr>
                    <td>Thursday</td>
                    <td>
                        <input id="thursday1" type="radio" name="thursday" value="1">
                        <label for="thursday">Morning</label>
                        <input id="thursday2" type="radio" name="thursday" value="2">
                        <label for="thursday2">Evening</label>
                        <input id="thursday3" type="radio" name="thursday" value="3">
                        <label for="thursday3">All day</label>
                        <input id="thursday4" type="radio" name="thursday" value="4">
                        <label for="thursday4">Day off</label>
                    </td>
                </tr>
                <tr>
                    <td>Friday</td>
                    <td>
                        <input id="friday1" type="radio" name="friday" value="1">
                        <label for="friday">Morning</label>
                        <input id="friday2" type="radio" name="friday" value="2">
                        <label for="friday2">Evening</label>
                        <input id="friday3" type="radio" name="friday" value="3">
                        <label for="friday3">All day</label>
                        <input id="friday4" type="radio" name="friday" value="4">
                        <label for="friday4">Day off</label>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <p>Please verify all the information before submitting</p>
        <input type="submit" name="registerDoctor" value="Submit">
    </form>
</body>
</html>