<?php

    
    $u_id=$_POST['user_id'];

    if(isset($_POST['session1_Bike'])){
        $session1_Bike=$_POST['session1_Bike'];
    }

    else{
        $session1_Bike='2000-01-01 00:00:00';
    }

    if(isset($_POST['session2_Bike'])){
        $session2_Bike=$_POST['session2_Bike'];
    }

    else{
        $session2_Bike='2000-01-01 00:00:00';
    }

    //////////////////////////////////////

    if(isset($_POST['session1_TW'])){
        $session1_TW=$_POST['session1_TW'];
    }

    else{
        $session1_TW='2000-01-01 00:00:00';
    }

    if(isset($_POST['session2_TW'])){
        $session2_TW=$_POST['session2_TW'];
    }

    else{
        $session2_TW='2000-01-01 00:00:00';
    }

    //////////////////////////////////////////////////////

    if(isset($_POST['session1_Car'])){
        $session1_Car=$_POST['session1_Car'];
    }

    else{
        $session1_Car='2000-01-01 00:00:00';
    }

    if(isset($_POST['session2_car'])){
        $session2_Car=$_POST['session2_Car'];
    }

    else{
        $session2_Car='2000-01-01 00:00:00';
    }

    //////////////////////////////////////////////////////



    if(isset($_POST['session1_Van'])){
        $session1_Van=$_POST['session1_Van'];
    }

    else{
        $session1_Van='2000-01-01 00:00:00';
    }

    if(isset($_POST['session2_Van'])){
        $session2_Van=$_POST['session2_Van'];
    }

    else{
        $session2_Van='2000-01-01 00:00:00';
    }

    //////////////////////////////////////////////////////


    if(isset($_POST['session1_Bus'])){
        $session1_Bus=$_POST['session1_Bus'];
    }

    else{
        $session1_Bus='2000-01-01 00:00:00';
    }

    if(isset($_POST['session2_Bus'])){
        $session2_Bus=$_POST['session2_Bus'];
    }

    else{
        $session2_Bus='2000-01-01 00:00:00';
    }

    //////////////////////////////////////////////////////



    if(isset($_POST['session1_Truck'])){
        $session1_Truck=$_POST['session1_Truck'];
    }

    else{
        $session1_Truck='2000-01-01 00:00:00';
    }

    if(isset($_POST['session2_Truck'])){
        $session2_Truck=$_POST['session2_Truck'];
    }

    else{
        $session2_Truck='2000-01-01 00:00:00';
    }

//////////////////////////////////////////////////////


 
    $con = mysqli_connect("localhost", "root", "", "dlms");
    $sql = "UPDATE users_learners SET bike_s1 = '" . $session1_Bike . "' , bike_s2 = '" . $session2_Bike . "', threeWheeler_s1 = '" . $session1_TW . "' , ThreeWheeler_s2 = '" . $session2_TW . "',car_s1 = '" . $session1_Car . "' , car_s2 = '" . $session2_Car . "', 
    van_s1 = '" . $session1_Van . "' , van_s2 = '" . $session2_Van. "',
    truck_s1 = '" . $session1_Truck . "' , truck_s2 = '" . $session2_Truck . "',
    bus_s1 = '" . $session1_Bus . "' , bus_s2 = '" . $session2_Bus . "',
    scheduled='1'  WHERE  user_id='" . $u_id . "'";
    $update = mysqli_query($con, $sql);


    if ($update) {
        echo "success";
    } else {
        $e=mysqli_error($con);
        echo $e;//"Something went wrong when executing. Please try again later.";
    }
?>
