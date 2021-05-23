
<?php
require_once "config.php";

$user_id = $_GET['user_id'];

$attempt = mysqli_query($link, "SELECT attempt FROM written_payment WHERE user_id = '$user_id'");

$exam_result = "";

$update = mysqli_query($link, "UPDATE written_exam SET result = 'Pass' WHERE user_id = '$user_id'");

if($update){
    header("Location: Written-Results-Added.php?user_id=$user_id");
    exit();
}

else {
    echo "Something went wrong when executing. Please try again later.";
}
  
// Close connection
$link->close();

?>
