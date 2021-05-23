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
 
    if ($gender != '1' && $gender != '2') {
        header("location: ../../Main/user-register.php?error=invalidGender&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (invalidUid($username) !== false) {
        header("location: ../../Main/user-register.php?error=invaliduid&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (invalidName($name) !== false) {
        header("location: ../../Main/user-register.php?error=invalidFormat&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (invalidNIC($NICno) !== false) {
        header("location: ../../Main/user-register.php?error=invalidNIC&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (invalidTelNo($contactNo) !== false) {
        header("location: ../../Main/user-register.php?error=invalidNo&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../../Main/user-register.php?error=invalidemail&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../../Main/user-register.php?error=missmatchpwd&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (uidExists($link, $username, $username) !== false) {
        header("location: ../../Main/user-register.php?error=uidexist&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    if (uidExists($link, $email, $email) !== false) {
        header("location: ../../Main/user-register.php?error=emailexist&name=$name&email=$email&username=$username&contactNo=$contactNo&NICno=$NICno");
        exit();
    }

    createUser($link, $username, $name, $pwd, $gender, $NICno, $email, $contactNo);
} 
else{
    header("location: ../../Main/user-register.php");
    exit();
}
?>