<?php
if (isset($_POST["submit"])) {

    $email = $_POST["recoverEmail"];
    $username = $_POST["uid"];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    
    if (invalidEmaildouble($email) !== false) {
        header("location: ../index.php?error=invalidemailmodal");
        exit();
    }

    if (uidExistsdouble($link, $email) == false) {
        header("location: ../index.php?error=invalidinfomodal");
        exit();
    }

    sendOTP($link,$email);
}

else{
    header("location: ../index.php");
    exit();
}
?>