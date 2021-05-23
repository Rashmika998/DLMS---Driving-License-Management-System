
<?php
require_once "config.php";

$user_id = $_GET['user_id'];

$attempt = mysqli_query($link, "SELECT attempt FROM written_payment WHERE user_id = '$user_id'");


$update = mysqli_query($link, "UPDATE written_exam SET result = 'Fail' WHERE user_id = '$user_id'");

$another_attempt = mysqli_query($link, "UPDATE written_payment SET attempt = '$attempt', paid = 'No', scheduled = 'No' WHERE user_id = '$user_id'");

if($update && $another_attempt){
    header("Location: Written-Results-Added.php");
    exit();
}

else {
    echo "Something went wrong when executing. Please try again later.";
}

// Close connection
$link->close();
