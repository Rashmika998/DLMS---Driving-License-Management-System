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

    if ($gender != 1 && $gender != 2 ) {
        header("location: dashboard.php?error=invalidGender");
        exit();
    }

    if (invalidUid($username) !== false) {
        header("location: dashboard.php?error=invaliduid");
        exit();
    }

    if (invalidName($name) !== false) {
        header("location: dashboard.php?error=invalidFormat");
        exit();
    }

    if (invalidNIC($NICno) !== false) {
        header("location: dashboard.php?error=invalidNIC");
        exit();
    }

    if (invalidTelNo($contactNo) !== false) {
        header("location: dashboard.php?error=invalidNo");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: dashboard.php?error=invalidemail");
        exit();
    }

    if (uidTaken($link, $id, $username, $email) !== false) {
        header("location: dashboard.php?error=uidtaken");
        exit();
    }

    updateUser($link, $id, $username, $name, $gender, $NICno, $email, $contactNo);

}
else{
    header("location: dashboard.php");
    exit();
}
?>