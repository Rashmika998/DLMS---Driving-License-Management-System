<?php
$con = mysqli_connect("localhost", "root", "", "dlms");

if (isset($_GET['id'])) {
    
	$id = $_GET['id'];
	$query = "SELECT filename,filetype,size,data FROM tbl_uploads WHERE fileid = $id ";
	$result = mysqli_query($con, $query) or die('Error, query failed');


    list($name, $type, $size, $content) = mysqli_fetch_array($result);
    header("Content-Disposition: attachment; filename=$name");
    header("Content-length: $size");
    header("Content-type: $type");
    echo $content;



  
	exit;
}

?>