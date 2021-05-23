<?php
require_once "config.php";

$user_id = $_GET['user_id'];

$record_result = mysqli_query($link,"SELECT * FROM trial_result WHERE user_id ='".$user_id."'");
$row_result = mysqli_fetch_assoc($record_result);

$resultA1 = $row_result['resultA1'];
$resultA = $row_result['resultA'];
$resultB1 = $row_result['resultB1'];
$resultB = $row_result['resultB'];
$resultC1 = $row_result['resultC1'];
$resultC = $row_result['resultC'];
$resultCE = $row_result['resultCE'];
$resultD1 = $row_result['resultD1'];
$resultD = $row_result['resultD'];
$resultDE = $row_result['resultDE'];
$resultG1 = $row_result['resultG1'];
$resultG = $row_result['resultG'];
$resultJ = $row_result['resultJ'];

    if(isset($_POST['resultA1']))
    $resultA1 = $_POST['resultA1'];

    if(isset($_POST['resultA']))
    $resultA = $_POST['resultA'];

    if(isset($_POST['resultB1']))
    $resultB1 = $_POST['resultB1'];

    if(isset($_POST['resultB']))
    $resultB = $_POST['resultB'];

    if(isset($_POST['resultC1']))
    $resultC1 = $_POST['resultC1'];

    if(isset($_POST['resultC']))
    $resultC = $_POST['resultC'];

    if(isset($_POST['resultCE']))
    $resultCE = $_POST['resultCE'];

    if(isset($_POST['resultD1']))
    $resultD1 = $_POST['resultD1'];

    if(isset($_POST['resultD']))
    $resultD = $_POST['resultD'];

    if(isset($_POST['resultDE']))
    $resultDE = $_POST['resultDE'];

    if(isset($_POST['resultG1']))
    $resultG1 = $_POST['resultG1'];

    if(isset($_POST['resultG']))
    $resultG = $_POST['resultG'];

    if(isset($_POST['resultJ']))
    $resultJ = $_POST['resultJ'];


    $update_new = mysqli_query($link,"UPDATE trial_result SET resultA1='".$resultA1."' ,resultA ='".$resultA."',resultB1 = '".$resultB1."'
    ,resultB = '".$resultB."',resultC1 = '".$resultC1."',resultC = '".$resultC."',resultC1 = '".$resultC1."' ,resultCE = '".$resultCE."'
    ,resultD1 = '".$resultD1."', resultD = '".$resultD."', resultDE = '".$resultDE."',resultG1 = '".$resultG1."',
    resultG = '".$resultG."', resultG = '".$resultG."',resultJ = '".$resultJ."' WHERE user_id = '".$user_id."'");
    

if($update_new){
    if($resultA1 == 'Fail' || $resultA == 'Fail' || $resultB1 == 'Fail' || $resultB == 'Fail' || $resultC1 == 'Fail'
    || $resultC == 'Fail' || $resultCE == 'Fail' || $resultD1 == 'Fail' || $resultD == 'Fail' || $resultDE == 'Fail'
     || $resultG1 == 'Fail' || $resultG == 'Fail' || $resultG1 == 'Fail'){
       $update = mysqli_query($link, "UPDATE trial_exam SET overall = 'Fail' WHERE user_id = '".$user_id."'");

       $update_pay = mysqli_query($link, "UPDATE trial_result SET paid = 'No' WHERE user_id = '".$user_id."'");
     }

    else
    $update = mysqli_query($link, "UPDATE trial_exam SET overall = 'Pass' WHERE user_id = '".$user_id."'");


    header("Location: Trial-Reschedule-Results-Added.php");
    exit();
}

else {
    echo "Something went wrong when executing. Please try again later.";
}

//Close connection
$link->close();