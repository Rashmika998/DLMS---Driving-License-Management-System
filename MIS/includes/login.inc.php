<?php
function test(){
    //session_start();
    if (isset($_POST["submit"])) {

        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];  

        require_once 'db.inc.php';
        require_once 'functions.inc.php';    

        loginUser($link,$username,$pwd);
    }

    else {
        header("location: ../../Main/user-login.php");
        exit();
    }
}

?>