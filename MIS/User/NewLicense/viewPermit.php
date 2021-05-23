<?php
if (isset($_GET['userID'])) {
    $uid = ($_GET['userID']);
    $type = "application/pdf";
    $name = "pdf";
    $con = mysqli_connect("localhost", "root", "", "dlms");

    $query = "SELECT document FROM permit WHERE user_id = $uid";
    $result = mysqli_query($con, $query) or die('Error, query failed');

    list($content) = mysqli_fetch_array($result);
    header("Content-Disposition: inline; filename=$name");
    header("Content-type: $type");
    echo $content;
}
?> 