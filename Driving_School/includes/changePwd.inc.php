<?php
session_start();

if (isset($_POST["submit"])) {
    $pwd = $_POST["npwd"];
    $Rpwd = $_POST["nrpwd"];
    $id = $_SESSION["learnersid"];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if (pwdMatch($pwd, $Rpwd) !== false) {
        header("location: ../Dashboard.php?error=missmatchpwd");
        exit();
    }

    changePWD($link, $id, $pwd);

}
else{
    header("location: ../Dashboard.php");
    exit();
}
?>