<?php
session_start();
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $contactNo = $_POST["contactNo"];
    $NICno = $_POST["NICno"];
    $gender = $_POST["gender"];
    $id = $_SESSION["userid"];

    require_once '../../includes/db.inc.php';
    require_once '../../includes/functions.inc.php';

    if ($gender != 'Male' && $gender != 'Female' && $gender != 'Other') {
        header("location:  renewaldashboard.php?error=invalidGender");
        exit();
    }

    if (invalidUid($username) !== false) {
        header("location:  renewaldashboard.php?error=invaliduid");
        exit();
    }

    if (invalidName($name) !== false) {
        header("location:  renewaldashboard.php?error=invalidFormat");
        exit();
    }

    if (invalidNIC($NICno) !== false) {
        header("location:  renewaldashboard.php?error=invalidNIC");
        exit();
    }

    if (invalidTelNo($contactNo) !== false) {
        header("location:  renewaldashboard.php?error=invalidNo");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location:  renewaldashboard.php?error=invalidemail");
        exit();
    }

    if (uidTaken($link, $id, $username, $email) !== false) {
        header("location:  renewaldashboard.php?error=uidtaken");
        exit();
    }

    updateUser($link, $id, $username, $name, $gender, $NICno, $email, $contactNo);

}
else{
    header("location: renewaldashboard.php");
    exit();
}
?>