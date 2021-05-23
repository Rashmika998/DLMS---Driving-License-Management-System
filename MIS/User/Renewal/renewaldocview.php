<?php


if (isset($_GET['userID']) && isset($_GET['type'])  && isset($_GET['pid'])) {


    $uid = ($_GET['userID']);
    $type = "application/pdf";
    $id = $_GET['pid']; //id are assigned for pdfs
    $name = "pdf";

    $con = mysqli_connect("localhost", "root", "", "dlms");

    if ($id == 1) { //prev license
        $query = "SELECT previous_license FROM user_details_renewal WHERE user_id = $uid";
        $result = mysqli_query($con, $query) or die('Error, query failed');

        list($content) = mysqli_fetch_array($result);
        header("Content-Disposition: inline; filename=$name");
        ////header("Content-length: $size");
        header("Content-type: $type");
        echo $content;
    }


    if ($id == 2) { //medical

        $query = "SELECT medical FROM user_details_renewal WHERE user_id = $uid";
        $result = mysqli_query($con, $query) or die('Error, query failed');

        list($content) = mysqli_fetch_array($result);
        header("Content-Disposition: inline; filename=$name");
        ////header("Content-length: $size");
        header("Content-type: $type");
        echo $content;
    
    }
  
    
} else if (isset($_GET['userID']) && isset($_GET['type'])) {  //get image

    $con = mysqli_connect("localhost", "root", "", "dlms");

    $uid = ($_GET['userID']);

    $name = "image";
    $type1 = "image";

    $query = "SELECT user_photo FROM user_details_renewal WHERE user_id = $uid";
    $result = mysqli_query($con, $query) or die('Error, query failed');

    list($content) = mysqli_fetch_array($result);
    header("Content-Disposition: inline; filename=$name");
    ////header("Content-length: $size");
    header("Content-type: $type1");
    echo $content;






    exit;
}