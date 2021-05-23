<?php
session_start();
if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $contactNo = $_POST["contactNo"];
    $NICno = $_POST["NICno"];
    $gender = $_POST["gender"];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if ($gender != 'Male' && $gender != 'Female' && $gender != 'Other') {
        header("location: ../User/register.php?error=invalidGender");
        exit();
    }

    if (invalidUid($username) !== false) {
        header("location: ../User/register.php?error=invaliduid");
        exit();
    }

    if (invalidName($name) !== false) {
        header("location: ../User/register.php?error=invalidFormat");
        exit();
    }

    if (invalidNIC($NICno) !== false) {
        header("location: ../User/register.php?error=invalidNIC");
        exit();
    }

    if (invalidTelNo($contactNo) !== false) {
        header("location: ../User/register.php?error=invalidNo");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../User/register.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../User/register.php?error=missmatchpwd");
        exit();
    }

    if (uidExists($link, $username, $email) !== false) {
        header("location: ../User/register.php?error=uidexist");
        exit();
    }

    createUser($link, $username, $name, $pwd, $gender, $NICno, $email, $contactNo);
}
else{
    header("location: ../User/register.php");
    exit();
}
?>