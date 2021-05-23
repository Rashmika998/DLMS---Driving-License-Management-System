<?php
session_start();
require_once 'config.php'; 
$u_id = $_GET['user_id'];

$del = mysqli_query($link,"DELETE FROM users_learners WHERE user_id = '$u_id'");

if($del)
header("location:users.php");

?>
