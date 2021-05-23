<?php
session_start();
require_once 'config.php'; 
$l_id = $_GET['learners_id'];

$del = mysqli_query($link,"DELETE FROM learners WHERE learners_id = '$l_id'");

if($del)
header("location:Driving-Schools-view.php");

?>
