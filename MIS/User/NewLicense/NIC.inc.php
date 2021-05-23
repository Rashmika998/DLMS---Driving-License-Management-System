<?php
require_once '../../includes/db.inc.php';
session_start();
$id = $_SESSION["userid"];
ob_start();
set_time_limit(0);

$state  = "";
$success=0;
$photo_status='';

if (isset($_POST['btn-upload'])) {


  $filename = $_FILES['file']['name'];
  if($filename==null){
    $success=2;
    header("Location: NIC.php?error=none");
  }

  else{

  $tmpname = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_type = $_FILES['file']['type'];

  $ext = pathinfo($filename, PATHINFO_EXTENSION);


  $fp      = fopen($tmpname, 'r');
  $content = fread($fp, filesize($tmpname));
  $content = addslashes($content);
  fclose($fp);

 
  if (
    $ext == "png" || $ext == "PNG" || $ext == "JPG" || $ext == "jpg" || $ext == "jpeg" || $ext == "JPEG"
    || $ext == "pdf" || $ext == "PDF" || $ext == "doc" || $ext == "DOC" || $ext == "docx" || $ext == "DOCX"
    || $ext == "XLS" || $ext == "xls" || $ext == "XLSX" || $ext == "xlsx" || $ext == "xlsm" || $ext == "XLSM" || $ext == "TXT"
  ) {
    
    $photo_status='Pending';
    $sql = "UPDATE user_details SET nic_copy = '$content', nic_status = '$photo_status' WHERE user_id = '$id';";
    $i = mysqli_query($link, $sql);
    
    if ($i == 1) {

      $success = 1;

      mysqli_close($link);
    } else {
      mysqli_close($link);
      $success=2;
    }
  } 
  else {
    mysqli_close($link);
    $state = 'File Format might not be supported, please check and try again';
  }
}
        header("location: NIC.php?error=none");
        exit();
}
else{
    header("location: NIC.php");
    exit();
}
?>