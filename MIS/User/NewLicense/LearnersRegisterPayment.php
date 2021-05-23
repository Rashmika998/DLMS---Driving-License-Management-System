<?php
session_start();
require_once '../../includes/db.inc.php';
require_once '../../vendor/autoload.php';
require_once '../../includes/functions.inc.php';

$l_id = $_SESSION['learners_id'];
$l_name = $_SESSION['learners_name'];
$id = $_SESSION["userid"];
$email=$_SESSION['email'];
$name=$_SESSION['name'];
    
\Stripe\Stripe::setApiKey('sk_test_51I2wZ8EG7KGMl4QwyFek7A5Tdi5HmY1zhvfDZXF3tOg5nmEthyYa0TiQqhU36ElpmdQYHdrvRC4ywfzOJZQEWi1p00U56ikRwn');
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
$token = $POST['stripeToken'];
date_default_timezone_set('Asia/Colombo');
$dt = date('Y-m-d H:i:s');

if($_SESSION['student']==0)//insert
{
    $sql = "INSERT INTO payments (token,user_id,amount,paid_at,Description) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($link);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
        exit();
    }
        
    $Description ="Paid package(s) fee for ".$l_name." - ".$_SESSION['bike_M']."  ".$_SESSION['threeWheeler_M']."  ".$_SESSION['car_M']."  ".$_SESSION['van_M']."  ".$_SESSION['truck_M']."  ".$_SESSION['bus_M'];
        
    mysqli_stmt_bind_param($stmt,"sssss",$token,$id ,$_SESSION['amount1'], $dt,$Description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "INSERT INTO users_learners (user_id, learners_id, bike, threeWheeler, car, van, truck, bus, amount) VALUES (?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
    exit();
    }

    mysqli_stmt_bind_param($stmt,"sssssssss", $id, $l_id, $_SESSION['bike'], $_SESSION['threeWheeler'] , $_SESSION['car'], $_SESSION['van'], $_SESSION['truck'] , $_SESSION['bus'] ,$_SESSION['amount1']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $subject =$l_name." Payment Confirmation";
    $body="Hello " .$name. "! <br>Your payment to ".$l_name." has been successfully transferred. Transaction details are shown below.<br><br>
    <table class='0 border'>
    <tr>
            <td>Voucher reference no</td>
            <td>:</td>
            <td>".$token."</td>
        </tr> 
        <tr>
            <td>Payment method</td>
            <td>:</td>
            <td>Online</td>
        </tr> 
        <tr>
            <td>Amount</td>
            <td>:</td>
            <td>".$_SESSION['amount1'].".00 LKR</td>
        </tr> 
        <tr>
            <td>Driving School</td>
            <td>:</td>
            <td>".$l_name."</td>
        </tr> 
        <tr>
            <td>Registered package(s)</td>
            <td>:</td>
            <td>".$_SESSION['bike_M']."  ".$_SESSION['threeWheeler_M']."  ".$_SESSION['car_M']."  ".$_SESSION['van_M']."  ".$_SESSION['truck_M']."  ".$_SESSION['bus_M']."</td>
        </tr> 
        <tr>
            <td>Date & Time</td>
            <td>:</td>
            <td>".$dt."</td>
        </tr> 
        </table><br><br>Thank you";
    sendEmail($email, $name, $body, $subject);

    header("location: LearnersProfile.php?learners_id=".$l_id."&error=none");
    exit();    
}

if($_SESSION['student']==1)//update
{
    $sql = "INSERT INTO payments (token,user_id,amount,paid_at,Description) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($link);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
        exit();
    }
        
    $Description ="Paid package(s) fee for ".$l_name." - ".$_SESSION['bike_M']."  ".$_SESSION['threeWheeler_M']."  ".$_SESSION['car_M']."  ".$_SESSION['van_M']."  ".$_SESSION['truck_M']."  ".$_SESSION['bus_M'];
        
    mysqli_stmt_bind_param($stmt,"sssss",$token,$id ,$_SESSION['amount'], $dt,$Description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($_SESSION['bike_U']==1)
    {
        $sql = "UPDATE users_learners SET bike =?, amount =? WHERE user_id = ? AND learners_id = ?;";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['bike'], $_SESSION['amount2'],  $id, $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if($_SESSION['threeWheeler_U']==1)
    {
        $sql = "UPDATE users_learners SET threeWheeler =?, amount =? WHERE user_id = ? AND learners_id = ?;";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['threeWheeler'], $_SESSION['amount2'],  $id, $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if($_SESSION['car_U'] ==1)
    {
        $sql = "UPDATE users_learners SET car =?, amount =? WHERE user_id = ? AND learners_id = ?;";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['car'], $_SESSION['amount2'],  $id, $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if($_SESSION['van_U'] ==1)
    {
        $sql = "UPDATE users_learners SET van =?, amount =? WHERE user_id = ? AND learners_id = ?;";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['van'], $_SESSION['amount2'],  $id, $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if($_SESSION['truck_U'] ==1)
    {
        $sql = "UPDATE users_learners SET truck =?, amount =? WHERE user_id = ? AND learners_id = ?;";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['truck'], $_SESSION['amount2'],  $id, $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if($_SESSION['bus_U']==1)
    {
        $sql = "UPDATE users_learners SET bus =?, amount =? WHERE user_id = ? AND learners_id = ?;";
        $stmt = mysqli_stmt_init($link);
    
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: LearnersProfile.php?learners_id=".$l_id."&error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['bus'], $_SESSION['amount2'],  $id, $l_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $subject =$l_name." Payment Confirmation";
    $body="Hello " .$name. "! <br>Your payment to ".$l_name." has been successfully transferred. Transaction details are shown below.<br><br>
    <table class='0 border'>
    <tr>
            <td>Voucher reference no</td>
            <td>:</td>
            <td>".$token."</td>
        </tr> 
        <tr>
            <td>Payment method</td>
            <td>:</td>
            <td>Online</td>
        </tr> 
        <tr>
            <td>Amount</td>
            <td>:</td>
            <td>".$_SESSION['amount'].".00 LKR</td>
        </tr> 
        <tr>
            <td>Driving School</td>
            <td>:</td>
            <td>".$l_name."</td>
        </tr> 
        <tr>
            <td>Registered package(s)</td>
            <td>:</td>
            <td>".$_SESSION['bike_M']."  ".$_SESSION['threeWheeler_M']."  ".$_SESSION['car_M']."  ".$_SESSION['van_M']."  ".$_SESSION['truck_M']."  ".$_SESSION['bus_M']."</td>
        </tr> 
        <tr>
            <td>Date & Time</td>
            <td>:</td>
            <td>".$dt."</td>
        </tr> 
        </table><br><br>Thank you";
        sendEmail($email, $name, $body, $subject);
        header("location: LearnersProfile.php?learners_id=".$l_id."&error=none");
        exit();  
}
?>