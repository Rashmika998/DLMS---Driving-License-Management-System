<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function invalidName($name){
    $result = true;
    if (!preg_match("/^([a-zA-Z' ]+)$/",$name)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result; 
} 



function invalidTelNo($contactNo){
    $result = true;
    if(strlen($contactNo) == 10 && is_numeric($contactNo)){
        $result = false;
    }
    return $result;; 
} 

function invalidEmail($email){
    $result = true; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
} 



////////////////////////////
function pwdMatch($pwd, $pwdRepeat){
    $result = true; 
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
} 

///////////////////////////////////
function uidExists($link,  $email){
    
    $sql = "SELECT * FROM learners WHERE  learners_email = ?;";
    $stmt = mysqli_stmt_init($link);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
     
}

function locationTaken($link, $id, $location){
    $sql = "SELECT * FROM learners WHERE (learners_address=?) AND learners_id != ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $location,$id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}



function nameTaken($link, $id, $name){
    $sql = "SELECT * FROM learners WHERE (learners_name = ? ) AND learners_id != ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $name, $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


function emailTaken($link, $id, $email){
    $sql = "SELECT * FROM learners WHERE ( learners_email = ? ) AND learners_id != ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",  $email, $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

/////////////////////////////////////
function loginUser($conn,$userEmail,$pwd){
    $uidExists = uidExists($conn, $userEmail);

    if ($uidExists == false) {
        header("location: index.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["learners_password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
   
        header("location: index.php?error=wronglogin");
        exit();
    }
    else {
        session_start();
        $_SESSION["learnersid"]= $uidExists["learners_id"];
        $_SESSION["learnersname"]= $uidExists["learners_name"];
        header("location: Dashboard.php"); //logged in page
        exit();
    }
}

/////////////////////////////////////////////////
function sendEmail($email, $body, $subject)
{
    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'dlmslk2021@gmail.com';                     // SMTP username
        $mail->Password   = 'DLMS2021';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('dlmslk2021@gmail.com', 'E-License');
        $mail->addAddress($email, $name);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'logo.jpg');    // Optional name
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function updateUser($link, $id,$name,$province,$location,$email, $contactNo ,$website,$capacity,$vehicle1,$bike_P,$vehicle2,$threeWheeler_P,$vehicle3,$car_P,$vehicle4,$van_P,$vehicle5,$truck_P,$vehicle6,$bus_P){
   // $name="ssss";
  // $truck_P=null;
  // echo $id,$name,$province,$location,$email, $contactNo ,$website,$capacity,$vehicle1,$bike_P,$vehicle2,$threeWheeler_P,$vehicle3,$car_P,$vehicle4,$van_P,$vehicle5,$truck_P,$vehicle6,$bus_P;
    $sql = "UPDATE learners SET learners_name = '$name', learners_province = '$province', learners_address = '$location', learners_email = '$email', learners_contact = '$contactNo', learners_website ='$website', max_students='$capacity',
    vehicle1='".$vehicle1."', bike_P='".$bike_P."', vehicle2='".$vehicle2."', threeWheeler_P='".$threeWheeler_P."', 
    vehicle3='".$vehicle3."', car_P='".$car_P."', vehicle4='".$vehicle4."', van_P='".$van_P."', vehicle5='".$vehicle5."',truck_P='".$truck_P."' ,  vehicle6='".$vehicle6."',bus_P='".$bus_P."' WHERE learners_id = $id";


    if (mysqli_query($link,$sql)) {
        header("location: ../Dashboard.php?error=none");
        exit();
    }
    $e=mysqli_error($link);
    echo $e;
    // header("Location: ../Dashboard.php?error=$e");
    // exit();
}

///////////////////
function checkSamePWD($link, $id){
    
    $sql = "SELECT * FROM learners WHERE learners_id = ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../Dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);     
}

//////////////////////////////////
function changePWD($link, $id, $pwd)
{
    $checkSamePWD = checkSamePWD($link, $id);

    $pwdHashed = $checkSamePWD["learners_password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        $sql = "UPDATE learners SET learners_password = ? WHERE learners_id = ?";
        $stmt = mysqli_stmt_init($link);

        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: ../Dashboard.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt,"ss",$hashedPwd,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../Dashboard.php?error=nonePWD");
        exit();

    }
    else {
        header("location: ../Dashboard.php?error=samePWD");
        exit();
    }
}

///////////////////
function invalidEmaildouble($email){
    $result = true; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result;
}

///////////////////////////////
function uidExistsdouble($link, $email){
    $sql = "SELECT * FROM learners WHERE  learners_email = ?";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

////////////////////////////////////////
function sendOTP($link,$email){

    $randstr = uniqid($email);
    $body = "Hello ! <br>Your temporary password is <strong>" .$randstr."</strong>.<br>Please reset your password once you logged in.";
    
    $sql = "UPDATE learners SET learners_password = ? WHERE  learners_email = ?;";
    $stmt = mysqli_stmt_init($link);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($randstr, PASSWORD_DEFAULT); //hashing auto updates
    mysqli_stmt_bind_param($stmt,"ss",$hashedPwd,$email);
    mysqli_stmt_execute($stmt);

    $subject ="Recover Password";
    sendEmail($email, $body, $subject);

    header("location: ../index.php?error=modal");
    exit();   
}
?>