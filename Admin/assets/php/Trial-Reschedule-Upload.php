<?php
require_once 'config.php';


$date1 = $date2 = $date3 = $date4 = $date5 = $date6 = $date7 = $nic = $uid = $full_name = $attempt = $result = null;
$time1 = $time2 = $time3 = $time4 = $time5 = $time6 = $time7 = null;
$location1 = $location2 = $location3 = $location4 = $location5 = $location6 = $location7 = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $full_name = $_SESSION['full_name'];
    $attempt = $_SESSION['attempt'];
    $nic = $_SESSION['nic'];

    $new_records = mysqli_query($link,"SELECT * FROM trial_exam WHERE user_id ='".$uid."'");
    $one_row = mysqli_fetch_assoc($new_records);

    $records = mysqli_query($link,"SELECT * FROM trial_result WHERE user_id ='".$uid."'");
    $row = mysqli_fetch_assoc($records);

    // $resultA1 = $row['resultA1'];
    // $resultA = $row['resultA'];
    // $resultB1 = $row['resultB1'];
    // $resultB = $row['resultB'];
    // $resultC1 = $row['resultC1'];
    // $resultC = $row['resultC'];
    // $resultCE = $row['resultCE'];
    // $resultD1 = $row['resultD1'];
    // $resultD = $row['resultD'];
    // $resultDE = $row['resultDE'];
    // $resultG1 = $row['resultG1'];
    // $resultG = $row['resultG'];
    // $resultJ = $row['resultJ'];

    $date1 = $one_row['date1'];
    $date2 = $one_row['date2'];
    $date3 = $one_row['date3'];
    $date4 = $one_row['date4'];
    $date5 = $one_row['date5'];
    $date6 = $one_row['date6'];
    $date7 = $one_row['date7'];

    $time1 = $one_row['time1'];
    $time2 = $one_row['time2'];
    $time3 = $one_row['time3'];
    $time4 = $one_row['time4'];
    $time5 = $one_row['time5'];
    $time6 = $one_row['time6'];
    $time7 = $one_row['time7'];

    $location1 = $one_row['location1'];
    $location2 = $one_row['location2'];
    $location3 = $one_row['location3'];
    $location4 = $one_row['location4'];
    $location5 = $one_row['location5'];
    $location6 = $one_row['location6'];
    $location7 = $one_row['location7'];

    if(isset($_POST['date1']))
    $date1 = $_POST['date1'];

    if(isset($_POST['time1']))
    $time1 = $_POST['time1'];

    if(isset($_POST['location1']))
    $location1 = $_POST['location1'];

    if(isset($_POST['date2']))
    $date2 = $_POST['date2'];

    if(isset($_POST['time2']))
    $time2 = $_POST['time2'];

    if(isset($_POST['location2']))
    $location2 = $_POST['location2'];

    if(isset($_POST['date3']))
    $date3 = $_POST['date3'];

    if(isset($_POST['time3']))
    $time3 = $_POST['time3'];

    if(isset($_POST['location3']))
    $location3 = $_POST['location3'];

    if(isset($_POST['date4']))
    $date4 = $_POST['date4'];

    if(isset($_POST['time4']))
    $time4 = $_POST['time4'];

    if(isset($_POST['location4']))
    $location4 = $_POST['location4'];

    if(isset($_POST['date5']))
    $date5 = $_POST['date5'];

    if(isset($_POST['time5']))
    $time5 = $_POST['time5'];

    if(isset($_POST['location5']))
    $location5 = $_POST['location5'];

    if(isset($_POST['date6']))
    $date6 = $_POST['date6'];

    if(isset($_POST['time6']))
    $time6 = $_POST['time6'];

    if(isset($_POST['location6']))
    $location6 = $_POST['location6'];

    if(isset($_POST['date7']))
    $date7 = $_POST['date7'];
    
    if(isset($_POST['time7']))
    $time7 = $_POST['time7'];

    if(isset($_POST['location7']))
    $location7 = $_POST['location7'];
    
    //default date values
    if($date1 == NULL)
    $date1 = "2000-01-01";

    if($date2 == NULL)
    $date2 = "2000-01-01";

    if($date3 == NULL)
    $date3 = "2000-01-01";

    if($date4 == NULL)
    $date4 = "2000-01-01";

    if($date5 == NULL)
    $date5 = "2000-01-01";

    if($date6 == NULL)
    $date6 = "2000-01-01";

    if($date7 == NULL)
    $date7 = "2000-01-01";

    $update_new = mysqli_query($link,"UPDATE trial_exam SET date1='".$date1."' ,time1 ='".$time1."',location1 = '".$location1."'
        ,date2 = '".$date2."',time2 = '".$time2."',location2 = '".$location2."',date3 = '".$date3."' ,time3 = '".$time3."'
        ,location3 = '".$location3."', date4 = '".$date4."', time4 = '".$time4."',location4 = '".$location4."',
        date5 = '".$date5."', time5 = '".$time5."',location5 = '".$location5."', date6 = '".$date6."', time6 = '".$time6."',
        location6 = '".$location6."', date7 = '".$date7."', time7 = '".$time7."', location7 = '".$location7."', overall = 'N/A' WHERE user_id = '".$uid."'");
        
        if($update_new){
            header("location:Trial-Reschedule-Added.php");
        }
        else{
            echo ("Error". mysqli_error($link));
        }


    

    // Close connection
    $link->close();
}

?>