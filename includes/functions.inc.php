<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function invalidUid($username){
    $result = true;
    if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
        $result = true;
    }
    else{
        $result  = false;
    }
    return $result; 
} 

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

function invalidNIC($NICno){
    $result = true;
    if(strlen($NICno) == 10 && $NICno[9] =='V'){
        $numPart = substr($NICno, 0, 9);
        $result = !is_numeric($numPart);            
    }
    if(strlen($NICno) == 12 && is_numeric($NICno)){
        $result = false;
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

function uidExists($link, $username, $email){
    
    $sql = "SELECT * FROM users WHERE user_name = ? OR user_email = ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User/register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $username, $email);
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

function uidTaken($link, $id, $username, $email){
    $sql = "SELECT * FROM users WHERE (user_name = ? OR user_email = ?) AND user_id != ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sss", $username, $email, $id);
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

function loginUser($conn,$username,$pwd){
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists == false) {
        header("location: ../User/login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["user_password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../User/login.php?error=wronglogin");
        exit();
    }
    else {
        session_start();
        $_SESSION["userid"]= $uidExists["user_id"];
        $_SESSION["useruid"]= $uidExists["user_name"];
        header("location: ../User/selectOption.php"); //logged in page
        exit();
    }
}

function sendEmail($email, $name, $body, $subject)
{
    // Load Composer's autoloader
    require '../vendor/autoload.php';

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

function createUser($link, $username, $name, $pwd, $gender, $NICno, $email, $contactNo){
    
    $sql = "INSERT INTO users (user_name, full_name, user_password, gender, nic, user_email, contact_no) VALUES (?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../User/register.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //hashing auto updates

    mysqli_stmt_bind_param($stmt,"sssssss", $username, $name, $hashedPwd, $gender, $NICno, $email, $contactNo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    $body = "Hello " .$username. "! <br>You have signed up successfully!<br>You can now log in to your account and start using our services";
    $subject = "E-license Sign Up Email Confirmation";
    sendEmail($email, $name, $body, $subject);

    header("location: ../User/register.php?error=none");
    exit();
}

function updateUser($link, $id, $username, $name, $gender, $NICno, $email, $contactNo){
    $sql = "UPDATE users SET user_name = ?, full_name = ?, gender = ?, nic = ?, user_email = ?, contact_no =? WHERE user_id = ?";
    $stmt = mysqli_stmt_init($link);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: dashboard.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sssssss",$username,$name,$gender,$NICno,$email,$contactNo,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: dashboard.php?error=none");
    exit();
}

function checkSamePWD($link, $id){
    
    $sql = "SELECT * FROM users WHERE user_id = ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: dashboard.php?error=stmtfailed");
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

function changePWD($link, $id, $pwd)
{
    $checkSamePWD = checkSamePWD($link, $id);

    $pwdHashed = $checkSamePWD["user_password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        $sql = "UPDATE users SET user_password = ? WHERE user_id = ?";
        $stmt = mysqli_stmt_init($link);

        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: dashboard.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt,"ss",$hashedPwd,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: dashboard.php?error=nonePWD");
        exit();

    }
    else {
        header("location: dashboard.php?error=samePWD");
        exit();
    }
}

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

function uidExistsdouble($link, $username, $email){
    $sql = "SELECT * FROM users WHERE user_name = ? AND user_email = ?;";
    $stmt = mysqli_stmt_init($link);
    
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../User/login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $username, $email);
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

function sendOTP($link,$email, $username){

    $randstr = uniqid($username);
    $body = "Hello " .$username. "! <br>Your temporary password is <strong>" .$randstr."</strong>.<br>Please reset your password once you logged in.";
    
    $sql = "UPDATE users SET user_password = ? WHERE user_name = ? AND user_email = ?;";
    $stmt = mysqli_stmt_init($link);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:  ../User/login.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($randstr, PASSWORD_DEFAULT); //hashing auto updates
    mysqli_stmt_bind_param($stmt,"sss",$hashedPwd, $username, $email);
    mysqli_stmt_execute($stmt);

    $subject ="Recover Password";
    sendEmail($email, $username, $body, $subject);

    header("location: ../User/login.php?error=modal");
    exit();   
}
?>