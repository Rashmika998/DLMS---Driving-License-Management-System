<?php

session_start();
unset($_SESSION[""]);
//session_unset();
//session_destroy();

header("location: ../../Main/user-login.php");
exit();