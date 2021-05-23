<?php


if (isset($_GET['userID']) && isset($_GET['type'])   && isset($_GET['pid'])) {


    $uid = ($_GET['userID']);
    $type = "application/pdf";
    $pid = ($_GET['pid']); //id are assigned for pdfs
    $name = "pdf";

    $con = mysqli_connect("localhost", "root", "", "dlms");

    if ($pid == 1) { //nic
        $query = "SELECT nic_copy FROM user_details WHERE user_id = $uid";
        $result = mysqli_query($con, $query) or die('Error, query failed');

        list($content) = mysqli_fetch_array($result);
        header("Content-Disposition: inline; filename=$name");
        ////header("Content-length: $size");
        header("Content-type: $type");
        echo $content;
    }


    if ($pid == 2) { //birth certificate

        $query = "SELECT birth_certificate FROM user_details WHERE user_id = $uid";
        $result = mysqli_query($con, $query) or die('Error, query failed');

        list($content) = mysqli_fetch_array($result);
        header("Content-Disposition: inline; filename=$name");
        ////header("Content-length: $size");
        header("Content-type: $type");
        echo $content;
    
    }
    if ($pid == 3) { //medical

        $query = "SELECT medical FROM user_details WHERE user_id = $uid";
        $result = mysqli_query($con, $query) or die('Error, query failed');

        list($content) = mysqli_fetch_array($result);
        header("Content-Disposition: inline; filename=$name");
        ////header("Content-length: $size");
        header("Content-type: $type");
        echo $content;
    }
    
} else if (isset($_GET['userID']) && isset($_GET['type'])) {  //retrive image

    $con = mysqli_connect("localhost", "root", "", "dlms");

    $uid = ($_GET['userID']);

    $name = "image";
    $type1 = "image";

    $query = "SELECT user_photo FROM user_details WHERE user_id = $uid";
    $result = mysqli_query($con, $query) or die('Error, query failed');

    list($content) = mysqli_fetch_array($result);
    header("Content-Disposition: inline; filename=$name");
    ////header("Content-length: $size");
    header("Content-type: $type1");
    echo $content;






    exit;
}