<?php
session_start();
$_SESSION['amount']=0;
if (isset($_POST["submit"])) {
    $id = $_SESSION["userid"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $dob = $_POST["dob"];
   

   

    require_once '../../includes/db.inc.php';



    if($_SESSION['update']== 0){ //new user 

        $sql = "INSERT INTO user_details_renewal (status,user_id, address, province, dob) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($link);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: RenewalRegistration.php?error=stmtfailed");
            exit();
        }
        $state = 'Pending';
        mysqli_stmt_bind_param($stmt,"sisss", $state,$id,$address,$province,$dob);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


        $sql = "UPDATE users SET type='Renew' WHERE user_id=?";
        $stmt = mysqli_stmt_init($link);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: RenewalRegistration.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        
        header("location: RenewalRegistration.php?error=updatedtousers");
        exit();

    }

   else if($_SESSION['update']== 1){//update rejected form
        $sql = "UPDATE user_details_renewal SET address =?, province =?, dob =?, status = ? WHERE user_id = ?";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: RenewalRegistration.php?error=stmtfailed");
            exit();
        }
        $state = 'Pending';
        mysqli_stmt_bind_param($stmt,"ssssi",$address, $province, $dob, $state,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
     
        $sql = "UPDATE users SET type='Renew' WHERE user_id=?;";
        $stmt = mysqli_stmt_init($link);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: RenewalRegistration.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"s",$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: RenewalRegistration.php?error=updatedtousers");
        exit();

    }
}
else{
    header("Location: RenewalRegistration.php");
    exit();
}