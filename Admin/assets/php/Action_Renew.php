
<?php
date_default_timezone_set('Asia/Colombo');

require_once 'config.php';


if (isset($_POST['action']) && $_POST['action'] == 'approve_license') {
    
    $u_id=$_POST['id'];

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET license_status = 'Approved' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);
    if ($update!=1) {
        echo "Something goes wrong";
    } 
  
}

if (isset($_POST['action']) && $_POST['action'] == 'approve_medical') {
    
    $u_id=$_POST['id'];

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET medical_status = 'Approved' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);
    if ($update!=1) {
        echo "Something goes wrong";
    } 
  
}

if (isset($_POST['action']) && $_POST['action'] == 'approve_photo') {
    
    $u_id=$_POST['id'];

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET photo_status = 'Approved' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);
    if ($update!=1) {
        echo "Something goes wrong";
    } 
  
}


if (isset($_POST['action']) && $_POST['action'] == 'reject_photo') {
    
    $u_id=$_POST['id'];

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET photo_status = 'Rejected' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);
    if ($update!=1) {
        echo "Something goes wrong";
    } 
  
}



if (isset($_POST['action']) && $_POST['action'] == 'reject_medical') {
    
    $u_id=$_POST['id'];

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET medical_status = 'Rejected' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);
    if ($update!=1) {
        echo "Something goes wrong";
    } 
  
}

if (isset($_POST['action']) && $_POST['action'] == 'reject_license') {
    $date = date('Y-m-d H:i:s');

    $u_id=$_POST['id'];

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET license_status = 'Rejected'   WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);
    if ($update!=1) {
        echo "Something goes wrong";
    } 
  
}

if (isset($_POST['action']) && $_POST['action'] == 'Approve_Application') {
    $date = date('Y-m-d H:i:s');

    $u_id=$_POST['id'];

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET status = 'Approved'  , created_at='".$date."' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);

    if ($update!=1) {
        echo "success";
    } 
    else {
        echo "Something goes wrong";
    } 

    
  
}


if (isset($_POST['action']) && $_POST['action'] == 'reject_Application') {
    
    $u_id=$_POST['id'];
    $feedback=$_POST['feedback'];
    $date = date('Y-m-d H:i:s');

    // Prepare an insert statement
    $sql = "UPDATE user_details_renewal SET status = 'Rejected' , Description ='".$feedback."' , created_at='".$date."' WHERE  user_id=$u_id";
    $update = mysqli_query($link, $sql);

    if ($update==1) {
        echo  "success";   
     } 
    else {
        echo  "Something goes wrong";
    } 

    
  
}



?>