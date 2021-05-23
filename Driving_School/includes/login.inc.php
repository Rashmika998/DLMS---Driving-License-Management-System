<?php
function test(){
    //session_start();
    if (isset($_POST["submit"])) {

        $userEmail = $_POST["user_email"];
        $pwd = $_POST["pwd"];  

        require_once 'db.inc.php';
        require_once 'functions.inc.php';    

        loginUser($link,$userEmail,$pwd);
    }

    else {
        header("location: index.php");
        exit();
    }
}

?>