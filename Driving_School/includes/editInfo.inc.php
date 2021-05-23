<?php
session_start();
require_once 'db.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $province= $_POST['province'];
    $location=$_POST['location'];
    $email = $_POST["email"];
    $contactNo = $_POST["contactNo"];
    $website=$_POST['web_site'];
    $capacity=$_POST['capacity'];

    $id = $_SESSION["learnersid"];

    $price = "SELECT * FROM learners WHERE learners_id = '$id'";

   $result = mysqli_query($link, $price);
    $row = mysqli_fetch_assoc($result);


    if(isset($_POST["vehicle1"])){
        $vehicle1 = $_POST["vehicle1"];
        $bike_P = $_POST['bike_P'];
    }
    else{
        $vehicle1= $row['vehicle1'];
        $bike_P = $row['bike_P'];
    }


    if(isset($_POST["vehicle2"])){
        $vehicle2 = $_POST["vehicle2"];
        $threeWheeler_P = $_POST['threeWheeler_P'];
    }
    else{
        $vehicle2=$row['vehicle2'];
        $threeWheeler_P = $row['threeWheeler_P'];
    }

    if(isset($_POST["vehicle3"])){
        $vehicle3 = $_POST["vehicle3"];
        $car_P = $_POST['car_P'];
    }
    else{
        $vehicle3=$row['vehicle3'];
        $car_P = $row['car_P'];
    }

    if(isset($_POST["vehicle4"])){
        $vehicle4 = $_POST["vehicle4"];
        $van_P = $_POST['van_P'];
    }
    else{
        $vehicle4=$row['vehicle4'];
        $van_P = $row['van_P'];
    }

    if(isset($_POST["vehicle5"])){
        $vehicle5 = $_POST["vehicle5"];
        $truck_P = $_POST['truck_P'];
    }
    else{
        $vehicle5=$row['vehicle5'];
        $truck_P = $row['truck_P'];
    }

    if(isset($_POST["vehicle6"])){
        $vehicle6 = $_POST["vehicle6"];
        $bus_P = $_POST['bus_P'];
    }
    else{
        $vehicle6=$row['vehicle6'];
        $bus_P = $row['bus_P'];
    }



    if (invalidName($name) !== false) {
        header("location: ../Dashboard.php?error=invalidFormat");
        exit();
    }


    if (invalidTelNo($contactNo) !== false) {
        header("location: ../Dashboard.php?error=invalidNo");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../Dashboard.php?error=invalidemail");
        exit();
    }

   
    if (locationTaken($link, $id, $location) !== false) {
        header("location: ../Dashboard.php?error=locationtaken");
        exit();
    }

    
    if (emailTaken($link, $id, $email) !== false) {
        header("location: ../Dashboard.php?error=emailtaken");
        exit();
    }

   // echo ("S");
    updateUser($link, $id,$name, $province,$location,$email, $contactNo ,$website,$capacity,$vehicle1,$bike_P,$vehicle2,$threeWheeler_P,$vehicle3,$car_P,$vehicle4,$van_P,$vehicle5,$truck_P,$vehicle6,$bus_P);

}
else{
    header("location: ../Dashboard.php");
    exit();
}
?>