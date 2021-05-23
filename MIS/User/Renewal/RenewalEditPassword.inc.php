<?php
session_start();
if (isset($_POST["submit"])) {
    $npwd = $_POST["newpwd"];
    $confnpwd = $_POST["confirmnewpwd"];
    $id = $_SESSION["userid"];

    require_once '../../includes/db.inc.php';
    require_once '../../includes/functions.inc.php';

    if (pwdMatch($npwd, $confnpwd) !== false) {
        header("location: renewaldashboard.php?error=passwordmissmatch");
        exit();
    }

    changePWD($link, $id, $npwd);

}
else{
    header("location: renewaldashboard.php");
    exit();
}
?>