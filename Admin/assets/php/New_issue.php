<?php

require_once 'config.php';

date_default_timezone_set('Asia/Colombo');

$mysqli = new mysqli("localhost", "root", "", "dlms");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$date = date('Y-m-d H:i:s');

$state = "Issued";
$u_id = $_GET['user_id'];


    // Prepare an insert statement
    $sql = "UPDATE trial_result SET Issued_state = 1 , Issued_date='".$date."' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);

    if ($update==1) {
        header('Location:NL_Issue.php');
    } 
    else {
        echo "Something goes wrong";
    } 

