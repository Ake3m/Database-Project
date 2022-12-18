<?php
    include("connection.php");

    // $createAdminTableQuery="create table admin_login(
    //     login varchar(255) primary key,
    //     password varchar(255) not null
    // ) ";
    // if(mysqli_query($con, $createAdminTableQuery))
    // {
    //     echo "Table Created";
    // }
    // else{
    //     echo "Table may already exist";
    // }
    $query="INSERT INTO admin_login (login, password) values(?,?);";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $query))
    {
        echo "Error";
        die("Something went wrong");
    }


    $adminEmail="root";
    $adminPasword="rooroot";


    $hasedAdminPassword=password_hash($adminPasword, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $adminEmail, $hasedAdminPassword);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

?>