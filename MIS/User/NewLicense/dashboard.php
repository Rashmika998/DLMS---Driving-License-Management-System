<?php
//session_start();
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION['userid'];
$attempt = $location = $date = $time =  $msg = $Examresult = $slip = $trialSlip = '';
$scheduled = 0;
$_SESSION['banned'] = '';

//checking whether written exam slip is ready or not
$sql = "SELECT * FROM written_exam_slip WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    $slip = "<strong><a class='text-light' href='viewWrittenSlip.php?userID=$id; &type=pdf'><i class='fa fa-hand-o-right' aria-hidden='true'></i> Click here to view your written exam slip</a></strong><br>";
}

//checking whether written exam slip is ready or not
$sql = "SELECT * FROM trial_slip WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    $trialSlip = "<strong><a class='text-light' href='viewTrialSlip.php?userID=$id; &type=pdf'><i class='fa fa-hand-o-right' aria-hidden='true'></i> Click here to view your practical exam slip</a></strong><br>";
}

//written stat
$sql = "SELECT * FROM written_exam WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    $attempt = $row['attempt'];
    $location = $row['location'];
    $date = $row['date'];
    $time = $row['time'];
    $Examresult = $row['result'];
    if ($row['result'] == "N/A") {
        $Examresult = 'Not Attempted';
    }
    if ($attempt == 1 || $attempt == 2) {
        if ($row['result'] == "Fail") {
            $_SESSION['amount'] = 250;
            $msg = "<strong><a class='text-light' href='writtenExams.php'><i class='fa fa-hand-o-right' aria-hidden='true'></i> Go to exams for more details </a></strong><br>";
        }
    }
    if ($attempt == 3 && $row['result'] == "Fail") {
        $msg = "<strong><i class='fa fa-hand-o-right' aria-hidden='true'></i> Sorry, You've failed in all 3 attempts.<br>You can no longer apply for Driver's License.</strong><br>";
        $_SESSION['banned'] = 'disabled';
    }
}

//checking whether exam scheduled or not
$sql = "SELECT * FROM written_payment WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['scheduled'] == 'Yes') {
        $scheduled = 1;
    }
}

if ($scheduled == 0) {
    $msg = "<h6>Your written exams aren't scheduled yet.</h6><br>";
}

?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <?php

                //checking whether license is ready or not
                $sql = "SELECT * FROM trial_result WHERE user_id = $id;";
                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['Issued_state'] == '1') {
                        echo "<div class='alert alert-success alert-dismissible text-center mt-2 m-0'><strong> Your Driver's License is ready to be collected! </strong></div>";
                    } else if ($row['Issued_state'] == '0') {
                        echo "<div class='alert alert-danger alert-dismissible text-center mt-2 m-0'><strong> Your Driver's License is disapproved! </strong></div>";
                    }
                }



                //checking application status
                $sql = "SELECT * FROM user_details WHERE user_id = $id;";
                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['status'] == 'Approved') {
                        echo "<div class='alert alert-success alert-dismissible text-center mt-2 m-0'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong> Your application has been approved! </strong></div>";
                    }


                    if ($row['status'] == 'Rejected') {
                        echo "<div class='alert alert-danger alert-dismissible text-center mt-2 m-0'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong> Your application has been rejected! </strong></div>";
                    }

                    if ($row['status'] == 'Pending') {
                        echo "<div class='alert alert-info alert-dismissible text-center mt-2 m-0'>
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                <strong> Your application is still processing! </strong></div>";
                    }
                }






                ?>

                <div class="card-deck mt-3 text-light text-center font-weight-bold">
                    <div class="card bg-primary">
                        <h4>Written Exam</h4>
                        <?php
                        if ($scheduled == 0) {
                            echo $msg, $slip;
                        }
                        if ($scheduled == 1) {
                            echo "
                                <table>
                                    <tr>
                                    <td>Attempt</td>
                                    <td>:</td>
                                    <td>" . $attempt . " </td>
                                    </tr>

                                    <tr>
                                    <td>Location</td>
                                    <td>:</td>
                                    <td> $location </td>
                                    </tr>

                                    <tr>
                                    <td>Date</td>
                                    <td>:</td>
                                    <td> $date </td>
                                    </tr>

                                    <tr>
                                    <td>Time</td>
                                    <td>:</td>
                                    <td> $time </td>
                                    </tr>

                                    <tr>
                                    <td>Results</td>
                                    <td>:</td>
                                    <td> $Examresult </td>
                                    </tr>
                                </table>
                                <br> 
                                $msg $slip
                                ";
                        }

                        ?>
                    </div>
                    <div class="card bg-info">
                        <h4>Practical Exam</h4>
                        <br>
                        <?php
                        $sql = "SELECT * FROM trial_exam WHERE user_id = $id ;";

                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                        $trialUser = 0; // no entry yet
                        $num = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $trialUser = 1;

                            if ($row['location1'] != NULL || $row['location2'] != NULL || $row['location3'] != NULL || $row['location4'] != NULL || $row['location5'] != NULL || $row['location6'] != NULL || $row['location7'] != NULL) {
                                echo "<h6>Your practical exam dates are scheduled.<br><br>Go to <a class='text-dark' href='trial.php'> Exams > Practical Exams </a>to view more details</h6><br>";
                            } else {
                                echo "<h6>Your practical exams aren't scheduled yet.</h6><br>";
                            }
                        }

                        if ($trialUser == 0) {
                            echo "<h6>Your practical exams aren't scheduled yet.</h6><br>";
                        }
                        echo $trialSlip;
                        ?>

                    </div>
                    <div class="card bg-success">
                        <h4>Learner's Permit</h4>
                        <br><br>
                        <?php
                        $sql = "SELECT * FROM permit WHERE user_id = $id ;";
                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                        $user = 0; // no entry yet
                        while ($row = mysqli_fetch_assoc($result)) {
                            $user = 1;
                        }
                        if ($user == 0) {
                            echo "<h6>Once your learner's permit is ready you can click here to view it</h6><br>";
                        }
                        if ($user == 1) {
                            echo "<h6>Your learner's permit is ready!<br><br><a class='text-dark' href='viewPermit.php?userID=$id; &type=pdf'><strong><i class='fa fa-hand-o-right' aria-hidden='true'></i> Click here to view</a></strong></h6><br>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3">
                    <div class="card shadow=lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                            <span class="lead align-self-center"><i class='fa fa-user'></i> Profile Details</span>
                            <a href="" data-toggle="modal" data-target="#EditProfileModal"><i class="fa fa-edit"></i></a>
                        </h5>
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "invalidGender") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while updating info: Invalid Gender! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "invaliduid") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while updating info: Invalid username format! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "invalidFormat") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while updating info: Invalid name format! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "invalidNIC") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while updating info: Invalid NIC number! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "invalidNo") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while updating info: Invalid contact number! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "invalidemail") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while updating info: Invalid email format! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "uidtaken") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while updating info: Username/Email already taken! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "stmtfailed") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Server error! Please try again. </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "none") { ?>
                                <div class="alert alert-success alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Profile info updated successfully! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "missmatchpwd") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while changing password: Mismatched entries! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "samePWD") { ?>
                                <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Error while changing password: Old password cannot be new password! </strong>
                                </div>
                            <?php } else if ($_GET["error"] == "nonePWD") { ?>
                                <div class="alert alert-success alert-dismissible text-center mt-2 m-0">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong> Password changed successfully! </strong>
                                </div>
                        <?php }
                        } ?>

                        <div class="card-body text-secondary ">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>User ID</td>
                                        <td><?php echo ($_SESSION["userid"]); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Full Name</td>
                                        <td translate='no'><?php
                                                            $id = $_SESSION["userid"];
                                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo $row["full_name"];
                                                                $_SESSION["name"] = $row["full_name"];
                                                            }
                                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>Userame</td>
                                        <td translate='no'><?php
                                                            $id = $_SESSION["userid"];
                                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo $row["user_name"];
                                                            }
                                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php
                                            $id = $_SESSION["userid"];
                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row["user_email"];
                                                $_SESSION["email"] = $row["user_email"];
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>NIC Number</td>
                                        <td translate='no'><?php
                                                            $id = $_SESSION["userid"];
                                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo $row["nic"];
                                                            }
                                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contact Number</td>
                                        <td><?php
                                            $id = $_SESSION["userid"];
                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row["contact_no"];
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php
                                            $id = $_SESSION["userid"];
                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                if ($row["gender"] == 1) {
                                                    echo "Male";
                                                }
                                                if ($row["gender"] == 2) {
                                                    echo "Female";
                                                }
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>Joined on</td>
                                        <td><?php
                                            $id = $_SESSION["userid"];
                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo $row["created_at"];
                                            }
                                            ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-transparent">
                            <p class="text-right"><a href="" data-toggle="modal" data-target="#ChangePwdModal" class="text-primary">Click here to change password</a></p>
                        </div>

                    </div>
                    <div class="card shadow-lg mb-3">
                        <h5 class="card-header d-flex justify-content-between">
                        <span class="lead align-self-center"><i class='fa fa-calendar-alt'></i> Driving School Schedule</span>                        </h5>

                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                $sql = "SELECT 
                                
                                users_learners.bike_s1, users_learners.bike_s2, users_learners.threeWheeler_s1, users_learners.threeWheeler_s2, 
                                users_learners.car_s1, users_learners.car_s2, users_learners.van_s1, users_learners.van_s2, 
                                users_learners.truck_s1, users_learners.truck_s2, users_learners.bus_s1, users_learners.bus_s2,
                                users_learners.bike, users_learners.threeWheeler, users_learners.car, users_learners.van, users_learners.truck, users_learners.bus, 
                                learners.learners_name  
                                
                                FROM users_learners, learners  WHERE users_learners.learners_id = learners.learners_id AND users_learners.user_id=$id;";

                                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                $regUser = 0; //no learners

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $regUser = 1;
                                    echo "<h6 translate='no'>" . $row['learners_name'] . "</h6><ul>";

                                    if ($row['bike'] == 1) {
                                        echo "<h6><i class='fa fa-motorcycle' aria-hidden='true'></i>&nbsp;&nbsp;Bike</h6>";
                                        if ($row['bike_s1'] == NULL && $row['bike_s2'] == NULL) {
                                            echo "Your schedule is not available yet<br><br>";
                                        } else {
                                            $dt = new DateTime($row['bike_s1']);
                                            $date1 = $dt->format('d-m-Y');
                                            $time1 = $dt->format('h:i:s A');
                                            $timestamp1 = strtotime($date1);
                                            $day1 = date('l', $timestamp1);

                                            $dt = new DateTime($row['bike_s2']);
                                            $date2 = $dt->format('d-m-Y');
                                            $time2 = $dt->format('h:i:s A');
                                            $timestamp2 = strtotime($date2);
                                            $day2 = date('l', $timestamp2);

                                            echo " Session 01: " . $day1 . ", " . $time1 . "<br>Session 02: " . $day2 . ", " . $time2 . "<br><br>";
                                        }
                                    }
                                    if ($row['threeWheeler'] == 1) {
                                        echo "<h6><img style='width: 20px;' src='https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png' />&nbsp;&nbsp;Three Wheeler</h6>";
                                        if ($row['threeWheeler_s1'] == NULL && $row['threeWheeler_s2'] == NULL) {
                                            echo "Your schedule is not available yet<br><br>";
                                        } else {
                                            $dt = new DateTime($row['threeWheeler_s1']);
                                            $date1 = $dt->format('d-m-Y');
                                            $time1 = $dt->format('h:i:s A');
                                            $timestamp1 = strtotime($date1);
                                            $day1 = date('l', $timestamp1);

                                            $dt = new DateTime($row['threeWheeler_s2']);
                                            $date2 = $dt->format('d-m-Y');
                                            $time2 = $dt->format('h:i:s A');
                                            $timestamp2 = strtotime($date2);
                                            $day2 = date('l', $timestamp2);

                                            echo "Session 01: " . $day1 . ", " . $time1 . "<br>Session 02: " . $day2 . ", " . $time2 . "<br><br>";
                                        }
                                    }
                                    if ($row['car'] == 1) {
                                        echo "<h6><i class='fa fa-car' aria-hidden='true'></i>&nbsp;&nbsp;Car</h6>";
                                        if ($row['car_s1'] == NULL && $row['car_s2'] == NULL) {
                                            echo "Your schedule is not available yet<br><br>";
                                        } else {
                                            $dt = new DateTime($row['car_s1']);
                                            $date1 = $dt->format('d-m-Y');
                                            $time1 = $dt->format('h:i:s A');
                                            $timestamp1 = strtotime($date1);
                                            $day1 = date('l', $timestamp1);

                                            $dt = new DateTime($row['car_s2']);
                                            $date2 = $dt->format('d-m-Y');
                                            $time2 = $dt->format('h:i:s A');
                                            $timestamp2 = strtotime($date2);
                                            $day2 = date('l', $timestamp2);

                                            echo "Session 01: " . $day1 . ", " . $time1 . "<br>Session 02: " . $day2 . ", " . $time2 . "<br><br>";
                                        }
                                    }
                                    if ($row['van'] == 1) {
                                        echo "<h6><i class='fa fa-shuttle-van' aria-hidden='true'></i>&nbsp;&nbsp;Van</h6>";
                                        if ($row['van_s1'] == NULL && $row['van_s2'] == NULL) {
                                            echo "Your schedule is not available yet<br><br>";
                                        } else {
                                            $dt = new DateTime($row['van_s1']);
                                            $date1 = $dt->format('d-m-Y');
                                            $time1 = $dt->format('h:i:s A');
                                            $timestamp1 = strtotime($date1);
                                            $day1 = date('l', $timestamp1);

                                            $dt = new DateTime($row['van_s2']);
                                            $date2 = $dt->format('d-m-Y');
                                            $time2 = $dt->format('h:i:s A');
                                            $timestamp2 = strtotime($date2);
                                            $day2 = date('l', $timestamp2);

                                            echo "Session 01: " . $day1 . ", " . $time1 . "<br>Session 02: " . $day2 . ", " . $time2 . "<br><br>";
                                        }
                                    }
                                    if ($row['truck'] == 1) {
                                        echo "<h6><i class='fa fa-truck' aria-hidden='true'></i>&nbsp;&nbsp;Truck</h6>";
                                        if ($row['truck_s1'] == NULL && $row['truck_s2'] == NULL) {
                                            echo "Your schedule is not available yet<br><br>";
                                        } else {
                                            $dt = new DateTime($row['truck_s1']);
                                            $date1 = $dt->format('d-m-Y');
                                            $time1 = $dt->format('h:i:s A');
                                            $timestamp1 = strtotime($date1);
                                            $day1 = date('l', $timestamp1);

                                            $dt = new DateTime($row['truck_s2']);
                                            $date2 = $dt->format('d-m-Y');
                                            $time2 = $dt->format('h:i:s A');
                                            $timestamp2 = strtotime($date2);
                                            $day2 = date('l', $timestamp2);

                                            echo "Session 01: " . $day1 . ", " . $time1 . "<br>Session 02: " . $day2 . ", " . $time2 . "<br><br>";
                                        }
                                    }
                                    if ($row['bus'] == 1) {
                                        echo "<h6><i class='fa fa-bus' aria-hidden='true'></i>&nbsp;&nbsp;Bus</h6>";
                                        if ($row['bus_s1'] == NULL && $row['bus_s2'] == NULL) {
                                            echo "Your schedule is not available yet<br><br>";
                                        } else {
                                            $dt = new DateTime($row['bus_s1']);
                                            $date1 = $dt->format('d-m-Y');
                                            $time1 = $dt->format('h:i:s A');
                                            $timestamp1 = strtotime($date1);
                                            $day1 = date('l', $timestamp1);

                                            $dt = new DateTime($row['bus_s2']);
                                            $date2 = $dt->format('d-m-Y');
                                            $time2 = $dt->format('h:i:s A');
                                            $timestamp2 = strtotime($date2);
                                            $day2 = date('l', $timestamp2);

                                            echo "Session 01: " . $day1 . ", " . $time1 . "<br>Session 02: " . $day2 . ", " . $time2 . "<br><br>";
                                        }
                                    }

                                    echo "</ul>";
                                }
                                if ($regUser == 0) {
                                    echo "<h6>You still haven't enrolled to any driving school<br><br>
                                    <a href='Learners.php'>CLICK HERE</a> TO JOIN!
                                    </h6>"; 
                                    ?>
                                    <img src="https://www.newsfirst.lk/wp-content/uploads/2016/09/Driving-school-L-board-768x427.jpg" class="d-block w-100" style="opacity: 0.5;">
                                    <?php
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--Edit Profile modal start-->
        <div class="modal fade" id="EditProfileModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h6 class="modal-title text-light">Edit Profile Info</h6>
                        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body ">
                        <form action="editInfo.inc.php" method="post">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name" value="<?php
                                                                                            $id = $_SESSION["userid"];
                                                                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                                                echo $row["full_name"];
                                                                                            }
                                                                                            ?>" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <select class="custom-select" name="gender">
                                        <option value=1>Male</option>
                                        <option value=2>Female</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Username</label>

                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control" name="uid" value="<?php
                                                                                                    $id = $_SESSION["userid"];
                                                                                                    $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                                        echo $row["user_name"];
                                                                                                    }
                                                                                                    ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Contact No</label>
                                    <input type="text" class="form-control" name="contactNo" value="<?php
                                                                                                    $id = $_SESSION["userid"];
                                                                                                    $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                                        echo $row["contact_no"];
                                                                                                    }
                                                                                                    ?>" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>NIC No</label>
                                    <input type="text" class="form-control" name="NICno" value="<?php
                                                                                                $id = $_SESSION["userid"];
                                                                                                $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                                    echo $row["nic"];
                                                                                                }
                                                                                                ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php
                                                                                                $id = $_SESSION["userid"];
                                                                                                $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                                    echo $row["user_email"];
                                                                                                }
                                                                                                ?>" required>
                            </div>

                            <div class="form-group row justify-content-center">
                                <button class="btn btn-dark" input type="submit " name="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--edit profile modal end-->

        <!--Password change modal -->
        <div class="modal fade" id="ChangePwdModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h6 class="modal-title text-light">Change Password</h6>
                        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body ">
                        <form action="changePwd.inc.php" method="post">

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="npwd" placeholder="New Password" required />
                            </div>

                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" name="nrpwd" placeholder="Confirm New Password" required>
                            </div>

                            <div class="form-group row justify-content-center">
                                <button class="btn btn-dark" input type="submit " name="submit">Change Password</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Password change modal -->

    </div>
</div>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<?php
require_once 'footer.php';
?>