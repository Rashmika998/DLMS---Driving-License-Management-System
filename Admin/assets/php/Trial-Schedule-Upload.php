<?php
ob_start();
require_once 'admin-header.php';

$date1 = $date2 = $date3 = $date4 = $date5 = $date6 = $date7 = $nic = $uid = $full_name = $attempt = $result = null;
$time1 = $time2 = $time3 = $time4 = $time5 = $time6 = $time7 = null;
$location = $location1 = $location2 = $location3 = $location4 = $location5 = $location6 = $location7 = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $full_name = $_SESSION['full_name'];
    $attempt = $_SESSION['attempt'];
    $location = trim($_POST['location']);
    $nic = $_SESSION['nic'];

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

    
        
        // Prepare an insert statement
        $sql = "INSERT INTO trial_exam (user_id, full_name, attempt, nic, date1, time1, location1, date2, time2, 
        location2, date3, time3, location3, date4, time4, location4, date5, time5, location5, 
        date6, time6, location6, date7, time7, location7) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?)";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            if ($stmt->bind_param("issssssssssssssssssssssss",$param_uid, $param_name, $param_attempt, $param_nic,
            $param_date1, $param_time1, $param_location1, $param_date2, $param_time2, $param_location2, 
            $param_date3, $param_time3, $param_location3, $param_date4, $param_time4, $param_location4,
            $param_date5, $param_time5, $param_location5, $param_date6, $param_time6, $param_location6, 
            $param_date7, $param_time7, $param_location7))

            // Set parameters
            $param_uid = $uid;
            $param_name = $full_name;
            $param_attempt = $attempt;
            $param_nic = $nic;

            $param_date1 = $date1;
            $param_time1 = $time1;
            $param_location1 = $location1;

            $param_date2 = $date2;
            $param_time2 = $time2;
            $param_location2 = $location2;

            $param_date3 = $date3;
            $param_time3 = $time3;
            $param_location3 = $location3;

            $param_date4 = $date4;
            $param_time4 = $time4;
            $param_location4 = $location4;

            $param_date5 = $date5;
            $param_time5 = $time5;
            $param_location5 = $location5;

            $param_date6 = $date6;
            $param_time6 = $time6;
            $param_location6 = $location6;
            
            $param_date7 = $date7;
            $param_time7 = $time7;
            $param_location7 = $location7;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $update = mysqli_query($link, "UPDATE written_exam SET trial_scheduled = 'Yes' WHERE user_id = '".$uid."'");
                if($update){
                   header("Location: Trial-Schedule-Added?user_id=$uid");
                   exit();
                }
               
            } else {

                echo ("Something went wrong when executing. Please try again later.". mysqli_error($link));
            }

            // Close statement
            $stmt->close();
        }
        else
        echo "Something went wrong when preparing. Please try again later.";
    

    // Close connection
    $link->close();
}

ob_end_flush();
?>


<div class="right_col" role="main"></div>

<!-- footer content -->
<footer>
    <div class="pull-right">
        Driving License Management System
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>


    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-success">

                </div>
              
                <div class="modal-body">
                    Trial Details Document Uploaded Successfully
                </div>
                <div class="modal-footer">
                    <a href="Admin-Dashboard.php"><button type="button" class="btn btn-success">Ok</button></a>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-success">

                    <i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
              
                <div class="modal-body">
                    Upload Failed; Please Try Again
                </div>
                <div class="modal-footer">
                    <a href="Admin-Dashboard.php"><button type="button" class="btn btn-danger">Ok</button></a>

                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            var success = "<?php print($success); ?>";

            if (success == 1) {
                $('#myModal').modal('show');

            }
            else{
                $('#myModal2').modal('show');

            }

        });
    </script>


    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="Header/build/js/custom.min.js"></script>

</body>



</html>
