<?php
    $servername="localhost";
    $username="root";
    $password="password";
    $dbname="club";

    $connect=new mysqli($servername, $username, $password, $dbname);

    if($connect->connect_error)
    {
        die("Connection failed:".$connect->connect_error);
    }
    else
    {
        echo "Connectted succesfully";
    }
    

    $sql="SELECT ID, name, sex, email, TEL FROM member";
    $result=$connect->query($sql);

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<br> ID=".$row['ID']."<br>Name=".$row['name']."<br>Sex=".$row['sex']."<br>Email=".$row['email']."<br>Tel=".$row['TEL'];
            echo "<hr>";
        }
    }
    else{
        echo "0 results";
    }

    $connect->close();

?>