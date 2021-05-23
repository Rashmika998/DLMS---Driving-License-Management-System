<?php
session_start();
if (isset($_POST["submit"])) {
    $pwd = $_POST["npwd"];
    $Rpwd = $_POST["nrpwd"];
    $id = $_SESSION["userid"];

    require_once '../../includes/db.inc.php';
    require_once '../../includes/functions.inc.php';

    if (pwdMatch($pwd, $Rpwd) !== false) {
        header("location: dashboard.php?error=missmatchpwd");
        exit();
    }

    changePWD($link, $id, $pwd);

}
else{
    header("location: dashboard.php");
    exit();
}
?>