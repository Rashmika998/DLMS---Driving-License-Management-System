<?php
if (isset($_POST["submit"])) {

    $email = $_POST["recoverEmail"];
    $username = $_POST["uid"];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    
    if (invalidEmaildouble($email) !== false) {
        header("location: ../../Main/user-login.php?error=invalidemailmodal");
        exit();
    }

    if (uidExistsdouble($link, $username, $email) == false) {
        header("location: ../../Main/user-login.php?error=invalidinfomodal");
        exit();
    }

    sendOTP($link,$email, $username);
}

else{
    header("location: ../../Main/user-login.php");
    exit();
}
?> 