<?php
session_start();
$_SESSION['amount']=0;
if (isset($_POST["submit"])) {
    $id = $_SESSION["userid"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $dob = $_POST["dob"];
    $A1 = 0;
    $A = 0;
    $B1 = 0;
    $B = 0;
    $C1 = 0;
    $C = 0;
    $CE = 0;
    $D1 = 0;
    $D = 0;
    $DE = 0;
    $G1 = 0;
    $G = 0;
    $J = 0;
    $count =0;

    if (isset($_POST['A1'])) {
        $A1 = 1;
        $count++;
    } 
    if (isset($_POST['A'])) {
        $A = 1;
        $count++;
    }
    if (isset($_POST['B1'])) {
        $B1 = 1;
        $count++;
    }
    if (isset($_POST['B'])) {
        $B = 1;
        $count++;
    }
    if (isset($_POST['C1'])) {
        $C1 = 1;
        $count++;
    }
    if (isset($_POST['C'])) {
        $C = 1;
        $count++;
    }
    if (isset($_POST['CE'])) {
        $CE = 1;
        $count++;
    }
    if (isset($_POST['D1'])) {
        $D1 = 1;
        $count++;
    }
    if (isset($_POST['D'])) {
        $D = 1;
        $count++;
    }
    if (isset($_POST['DE'])) {
        $DE = 1;
        $count++;
    }
    if (isset($_POST['G1'])) {
        $G1 = 1;
        $count++;
    }
    if (isset($_POST['GE'])) {
        $GE = 1;
        $count++;
    }
    if (isset($_POST['J'])) {
        $J = 1;
        $count++;
    }

    require_once '../../includes/db.inc.php';

    if ($count == 0) {
        header("location: RegisterForLicense.php?error=selectType");
        exit();
    }

    if($_SESSION['update']== 0){ //new user 

        $sql = "INSERT INTO user_details (user_id, address, province, dob, A1, A, B1, B, C1, C,	CE,	D1,	D, DE, G1, G, J,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($link);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: RegisterForLicense.php?error=stmtfailed");
            exit();
        }
         $status='Pending';
        mysqli_stmt_bind_param($stmt,"ssssssssssssssssss", $id, $address, $province, $dob, $A1, $A, $B1, $B, $C1, $C, $CE, $D1, $D, $DE, $G1, $G, $J,$status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql = "UPDATE users SET type = ? WHERE user_id = ?";
        $stmt = mysqli_stmt_init($link);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: RegisterForLicense.php?error=stmtfailed");
            exit();
        }
        $state = 'New';
        mysqli_stmt_bind_param($stmt,"ss", $state, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: RegisterForLicense.php?error=none");
        exit();

    }

    else if($_SESSION['update']== 1){//update rejected form
        $sql = "UPDATE user_details SET address =?, province =?, dob =?, A1 =?, A =?, B1 =?, B =?, C1 =?, C =?,	CE =?,	D1 =?,	D =?, DE =?, G1 =?, G =?, J =?, status =? WHERE user_id = ?";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: RegisterForLicense.php?error=stmtfailed");
            exit();
        }
        $state = 'Pending';
        mysqli_stmt_bind_param($stmt,"ssssssssssssssssss",$address, $province, $dob, $A1, $A, $B1, $B, $C1, $C, $CE, $D1, $D, $DE, $G1, $G, $J,$state,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        header("Location: RegisterForLicense.php?error=Updated");
        exit();
    }
}
else{
    header("Location: RegisterForLicense.php");
    exit();
}