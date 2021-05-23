
<?php
require_once 'admin-header.php';

$query_tot = "SELECT  COUNT(user_id) FROM users ";
$query_tot = mysqli_query($link, $query_tot);
$row_count = mysqli_fetch_assoc($query_tot);
$total_users = $row_count["COUNT(user_id)"];

$admin_tot = "SELECT  COUNT(admin_id) FROM admin ";
$admin_tot = mysqli_query($link, $admin_tot);
$admin_count = mysqli_fetch_assoc($admin_tot);
$total_admin = $admin_count["COUNT(admin_id)"];

$query_new = "SELECT  COUNT(user_id) FROM user_details ";
$query_new = mysqli_query($link, $query_new);
$row_count_new = mysqli_fetch_assoc($query_new);
$total_new = $row_count_new["COUNT(user_id)"];

$query_new = "SELECT  COUNT(user_id) FROM user_details WHERE status='Pending' ";
$query_new = mysqli_query($link, $query_new);
$row_count_new = mysqli_fetch_assoc($query_new);
$total_new_pending = $row_count_new["COUNT(user_id)"];

$query_renew = "SELECT  COUNT(user_id) FROM user_details_renewal  ";
$query_renew = mysqli_query($link, $query_renew);
$row_count_renew = mysqli_fetch_assoc($query_renew);
$total_renew = $row_count_renew["COUNT(user_id)"];

$query_renew = "SELECT  COUNT(user_id) FROM user_details_renewal WHERE status='Pending' ";
$query_renew = mysqli_query($link, $query_renew);
$row_count_renew = mysqli_fetch_assoc($query_renew);
$total_renew_pending = $row_count_renew["COUNT(user_id)"];

$query_learners = "SELECT  COUNT(learners_id) FROM learners ";
$query_learners = mysqli_query($link, $query_learners);
$row_count_learners = mysqli_fetch_assoc($query_learners);
$total_learners = $row_count_learners["COUNT(learners_id)"];

$exam_written_pending = "SELECT COUNT(user_id) FROM written_payment WHERE scheduled = 'No' AND paid = 'Yes'";
$exam_written_pending = mysqli_query($link, $exam_written_pending);
$row_written_pending = mysqli_fetch_assoc($exam_written_pending);
$total_written_pending = $row_written_pending["COUNT(user_id)"];

$exam_written_results = "SELECT COUNT(user_id) FROM written_exam WHERE result='N/A'";
$exam_written_results = mysqli_query($link, $exam_written_results);
$row_written_results = mysqli_fetch_assoc($exam_written_results);
$total_written_results = $row_written_results["COUNT(user_id)"];

$exam_trial_schedule = "SELECT COUNT(user_id) FROM written_exam WHERE result = 'Pass' AND trial_scheduled = 'No'";
$exam_trial_schedule = mysqli_query($link, $exam_trial_schedule);
$row_trial_schedule = mysqli_fetch_assoc($exam_trial_schedule);
$total_trial_schedule = $row_trial_schedule["COUNT(user_id)"];

$exam_trial_reschedule = "SELECT COUNT(user_id) FROM trial_exam WHERE overall = 'Fail' AND user_id IN (SELECT user_id FROM trial_result WHERE paid = 'Yes') ";
$exam_trial_reschedule = mysqli_query($link, $exam_trial_reschedule);
$row_trial_reschedule = mysqli_fetch_assoc($exam_trial_reschedule);
$total_trial_reschedule = $row_trial_reschedule["COUNT(user_id)"];

$exam_trial_results = "SELECT COUNT(user_id) FROM trial_exam WHERE overall='N/A'";
$exam_trial_results = mysqli_query($link, $exam_trial_results);
$row_trial_results = mysqli_fetch_assoc($exam_trial_results);
$total_trial_results = $row_trial_results["COUNT(user_id)"];

$exam_study = "SELECT COUNT(fileid) FROM tbl_uploads";
$exam_study = mysqli_query($link, $exam_study);
$row_study = mysqli_fetch_assoc($exam_study);
$total_study = $row_study["COUNT(fileid)"];

$query_newlicense = "SELECT status, count(*) as number FROM user_details GROUP BY status";
$result_newlicense = mysqli_query($link, $query_newlicense);

$query_renew = "SELECT status, count(*) as number FROM user_details_renewal GROUP BY status";
$result_renew = mysqli_query($link, $query_renew);

 
$sqln = "SELECT COUNT(user_id) FROM user_details_renewal 
WHERE status='Approved' AND Issuing_State IS NULL ";
$sqln = mysqli_query($link, $sqln);
$row_n = mysqli_fetch_assoc($sqln);
$total_pr = $row_n["COUNT(user_id)"];


$sqlrr = "SELECT COUNT(user_id) FROM trial_result 
WHERE Issued_state IS NULL 
AND (
                    
                    trial_result.resultA1='Pass' OR     trial_result.resultA='Pass' OR   trial_result.resultB1='Pass' OR   trial_result.resultB='Pass' OR   trial_result.resultC1='Pass' OR   trial_result.resultC='Pass' OR
                    trial_result.resultCE='Pass' OR   trial_result.resultD1='Pass' OR   trial_result.resultD='Pass' OR   trial_result.resultDE='Pass' OR   trial_result.resultG1='Pass' OR   trial_result.resultG='Pass' OR
                    trial_result.resultJ='Pass')
";
$sqlrr = mysqli_query($link, $sqlrr);
$row_rr = mysqli_fetch_assoc($sqlrr);
$total_ri = $row_rr["COUNT(user_id)"];

?>

<script src="Header/vendors/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Status', 'Number'],
            <?php
            while ($row_license = mysqli_fetch_array($result_newlicense)) {
                echo "['" . $row_license["status"] . "', " . $row_license["number"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'New License Applications',
            is3D: true,
            pieHole: 0.5,
            chartArea: {
                left: 10,
                top: 20,
                width: "100%",
                height: "100%"
            }



        };
        var chart = new google.visualization.PieChart(document.getElementById('new_license'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Status', 'Number'],
            <?php
            while ($row_license = mysqli_fetch_array($result_renew)) {
                echo "['" . $row_license["status"] . "', " . $row_license["number"] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'License Renewal Applications',
            is3D: true,
            pieHole: 0.5,
            chartArea: {
                left: 10,
                top: 20,
                width: "100%",
                height: "100%"
            }



        };
        var chart = new google.visualization.PieChart(document.getElementById('renew_license'));
        chart.draw(data, options);
    }
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
<div class="right_col" role="main">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3 text-light">
                    <div class="card border shadow-lg  p-2">
                        <button class="btn" data-toggle="modal" data-target="#regiUsers">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: green;"><i class="fa fa-users fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_users; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Registered Users</h5>
                        </button>
                    </div>

                    <div class="card border shadow-lg  p-2">
                        <button class="btn" data-toggle="modal" data-target="#learners">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: red;"><i class="fa fa-taxi fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_learners; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Driving Schools</h5>
                        </button>
                    </div>


                    <div class="card border shadow-lg  p-2">
                        <a class="btn" data-toggle="modal" data-target="#admin">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: #FFA812;"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_admin; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Administrators</h5>
                        </a>
                    </div>
                </div>

                <div class="card-deck mt-3 text-light text-center font-weight-bold">

                    <div class="card border shadow-lg  p-2">
                        <a class="btn" role="button" href="Admin-NLicense.php">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: blue;"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_new_pending; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">New License Applications Pending</h5>
                        </a>
                    </div>

                    <div class="card border shadow-lg  p-2">
                        <a class="btn" role="button" href="Admin-Renewal.php">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: #008B8B;"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_renew_pending; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Renew License Applications Pending</h5>
                        </a>
                    </div>
                </div>

                <div class="card-deck mt-3 text-light text-center font-weight-bold">
                    <div class="card border shadow-lg  p-2">
                        <button class="btn" data-toggle="modal" data-target="#wschedule">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: #E75480;"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_written_pending; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Written Exam Schedule Pending</h5>
                        </button>
                    </div>

                    <div class="card border shadow-lg  p-2">
                        <button class="btn" data-toggle="modal" data-target="#wresults">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: #A0785A;"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_written_results; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Written Exam Results Pending</h5>
                        </button>
                    </div>
                    <div class="card border shadow-lg  p-2">
                        <button class="btn" data-toggle="modal" data-target="#tschedule">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: #69359C;"><i class="fa fa-car fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_trial_schedule; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Trial Exam Schedule Pending</h5>
                        </button>
                    </div>

                    <div class="card border shadow-lg  p-2">
                        <button class="btn" data-toggle="modal" data-target="#trschedule">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: #03C03C;"><i class="fa fa-repeat fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_trial_reschedule; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Trial Exam Re-Schedule Pending</h5>
                        </button>
                    </div>

                    <div class="card border shadow-lg  p-2">
                        <button class="btn" data-toggle="modal" data-target="#tresults">
                            <div class="row-gutter sm">
                                <div class="col-md-2" style="float:left;color: #FFDF00;"><i class="fa fa-list-alt fa-2x" aria-hidden="true"></i></div>
                                <div class="col-md-8">
                                    <h3><?php echo $total_trial_results; ?></h3>
                                </div>
                            </div><br><br><br>
                            <h5 style="color: grey;">Trial Exam Results Pending</h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="admin" tabindex="-1" aria-labelledby="adminLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="color: white;background-color: #FFA812;">
                        <h5 class="modal-title" id="adminLabel">Administrators</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="adTable">
                                <thead>
                                    <tr>
                                        <th>UserName</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <?php
                                $db = mysqli_connect("localhost", "root", "", "dlms");
                                $records_ad = mysqli_query($db, "SELECT user_id, gender, user_name FROM users");

                                $result_ad = $db->query("SELECT admin_photo FROM admin WHERE  admin_id='" . $data['admin_id'] . "'");

                                $records_ad = mysqli_query($db, "SELECT * FROM admin");

                                while ($data_ad = mysqli_fetch_array($records_ad)) {
                                ?>
                                    <tr>
                                        <td>
                                            <!-- <img style="width: 50px;" 
                        src="data:image/png;charset=utf8;base64,
                         <?php echo base64_encode($data_ad['admin_photo']); ?>" /> -->
                                            <?php if ($result_ad->num_rows > 0 && $data_ad['admin_photo'] != null) { ?>
                                                <?php while ($row_ad = $result_ad->fetch_assoc()) { ?>
                                                    <img style="width: 50px;" src="data:admin_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row_ad['admin_photo']); ?>" />
                                                <?php } ?>
                                            <?php } else { ?>

                                                <img src="Header/production/images/admin.png" style="width: 50px;" alt="...">
                                            <?php } ?>

                                            &nbsp;&nbsp;<?php echo $data_ad['admin_name']; ?>

                                        </td>
                                        <td><?php echo $data_ad['admin_name'] ?></td>
                                        <td>
                                            <?php echo $data_ad['admin_email'] ?>
                                        </td>

                                        <td><?php echo $data_ad['created_at'] ?></td>
                                    </tr>

                                <?php
                                }

                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="regiUsers" tabindex="-1" aria-labelledby="regiUsersLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success" style="color: white;">
                        <h5 class="modal-title" id="regiUsersLabel">Registered Users</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                    <div class="row  mb-4">
                       
                            <div class="col  ">
                                <div class="float-right">
                                    <form method="post" action="users_export.php">
                                        <div class="input-daterange">
                                            <div class="col-md-4 mt-2">
                                                <input type="text" name="ustart_date" class="form-control" readonly placeholder="start date" />
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <input type="text" name="uend_date" class="form-control" readonly placeholder="end date" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <input type="submit" name="export_users" value="Export to Excel" class="btn btn-info btn-sm" />
                                        </div>
                                    </form>
                                </div>
                            </div>

                   
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="regiTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th style="text-align: center;">Profile</th>
                                    </tr>
                                </thead>
                                <?php
                                $db = mysqli_connect("localhost", "root", "", "dlms");
                                $records_r = mysqli_query($db, "SELECT user_id, gender, user_name FROM users");

                                while ($data_r = mysqli_fetch_array($records_r)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($data_r['gender'] == "1") { ?>
                                                <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                            <?php
                                            } else if ($data_r['gender'] == "2") { ?>
                                                <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                            <?php
                                            } else { ?>
                                                <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                            <?php
                                            }

                                            ?>
                                            &nbsp;&nbsp;<?php echo $data_r['user_name']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-success btn-sm" href="User-View-Profile.php?user_id=<?php echo $data_r['user_id'] ?>">View
                                                <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                }

                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="learners" tabindex="-1" aria-labelledby="learnersLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger" style="color: white;">
                        <h5 class="modal-title" id="learnersLabel">Driving Schools</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row  mb-4">
                       
                            <div class="col  ">
                                <div class="float-right">
                                    <form method="post" action="learners_export.php">
                                        <div class="input-daterange">
                                            <div class="col-md-4 mt-2">
                                                <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <input type="submit" name="export" value="Export to Excel" class="btn btn-danger btn-sm" />
                                        </div>
                                    </form>
                                </div>
                            </div>

                   
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="learnersTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th style="text-align: center;">Profile</th>
                                    </tr>
                                </thead>
                                <?php
                                $records_l = mysqli_query($db, "SELECT learners_id, learners_photo, learners_name FROM learners");
                                while ($data_l = mysqli_fetch_array($records_l)) {
                                ?>
                                    <tr>
                                        <td>
                                            <img style="width: 50px;" src="data:image/png;charset=utf8;base64, <?php echo base64_encode($data_l['learners_photo']); ?>" />
                                            &nbsp;&nbsp;<?php echo $data_l['learners_name']; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-danger btn-sm" href="Driving-School-Profile.php?learners_id=<?php echo $data_l['learners_id'] ?>">View
                                                <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="wschedule" tabindex="-1" aria-labelledby="wscheduleLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="color: white;background-color: #E75480;">
                        <h5 class="modal-title" id="wscheduleLabel">Written Exam Schedule Pending</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="wscheduleTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th style="text-align: center;">Attempt</th>
                                        <th style="text-align: center;">Schedule</th>
                                    </tr>
                                </thead>
                                <?php
                                $db = mysqli_connect("localhost", "root", "", "dlms");
                                $users = mysqli_query($db, "SELECT * FROM written_payment WHERE paid = 'Yes' AND scheduled = 'No'");

                                while ($records = mysqli_fetch_array($users)) {
                                    // $_SESSION['learners_name'] = $data['learners_name'];
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $get_users = mysqli_query($db, "SELECT gender, user_name FROM users WHERE user_id = " . $records['user_id']);
                                            if ($data = mysqli_fetch_array($get_users)) {
                                                if ($data['gender'] == "1") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                                <?php
                                                } else if ($data['gender'] == "2") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                                <?php
                                                } else { ?>
                                                    <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                                <?php
                                                }
                                                ?>
                                                &nbsp;&nbsp;<a href="User-View-Profile.php?user_id=<?php echo $records['user_id'] ?>">
                                                    <?php echo $data['user_name']; ?></a>
                                        </td>
                                        <td style="text-align: center;"><?php echo $records['attempt'] ?></td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-sm" role="button" style="background-color: #E75480;color: white;" href="Written-Schedule-Add.php?user_id=<?php echo $records['user_id'] ?>">
                                                <h7 style="text-align: center;">Add&nbsp;<i class="fa fa-calendar-plus-o" aria-hidden="true"></i></h7>
                                            </a>
                                        </td>
                                <?php
                                            }
                                        }
                                ?>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="wresults" tabindex="-1" aria-labelledby="wresultsLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="color: white;background-color: #A0785A;">
                        <h5 class="modal-title" id="wresultsLabel">Written Exam Results Pending Users</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="wresultsTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th style="text-align: center;">Attempt</th>
                                        <th style="text-align: center;">Result</th>
                                    </tr>
                                </thead>
                                <?php
                                $users_wr = mysqli_query($db, "SELECT * FROM written_exam WHERE result='N/A'");

                                while ($records_wr = mysqli_fetch_array($users_wr)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $get_users = mysqli_query($db, "SELECT gender, user_name FROM users WHERE user_id = " . $records_wr['user_id']);
                                            if ($data = mysqli_fetch_array($get_users)) {
                                                if ($data['gender'] == "1") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                                <?php
                                                } else if ($data['gender'] == "2") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                                <?php
                                                } else { ?>
                                                    <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                                <?php
                                                }
                                                ?>
                                                &nbsp;&nbsp;<a href="User-View-Profile.php?user_id=<?php echo $records_wr['user_id'] ?>">
                                                    <?php echo $data['user_name']; ?></a>
                                        </td>
                                        <td style="text-align: center;"><?php echo $records_wr['attempt'] ?></td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-sm" href="Written-Results-Add.php?user_id=<?php echo $records_wr['user_id'] ?>" style="background-color: #A0785A;;">
                                                <h7 style="text-align: center;color: white;">Add&nbsp;<i class="fa fa-certificate" aria-hidden="true"></i></h7>
                                            </a>
                                        </td>
                                    </tr>

                            <?php
                                            }
                                        }
                            ?>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tschedule" tabindex="-1" aria-labelledby="tscheduleLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="color: white;background-color: #69359C;">
                        <h5 class="modal-title" id="tscheduleLabel">Trial Exam Schedule Pending Users</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="tscheduleTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th style="text-align: center;">Schedule</th>
                                    </tr>
                                </thead>
                                <?php
                                $users_ts = mysqli_query($db, "SELECT user_id FROM written_exam WHERE result = 'Pass' AND trial_scheduled = 'No'");

                                while ($records_ts = mysqli_fetch_array($users_ts)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $get_users_ts = mysqli_query($db, "SELECT gender, user_name FROM users WHERE user_id = " . $records_ts['user_id']);
                                            if ($data = mysqli_fetch_array($get_users_ts)) {
                                                if ($data['gender'] == "1") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                                <?php
                                                } else if ($data['gender'] == "2") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                                <?php
                                                } else { ?>
                                                    <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                                <?php
                                                }
                                                ?>
                                                &nbsp;&nbsp;<a href="User-View-Profile.php?user_id=<?php echo $records_ts['user_id'] ?>">
                                                    <?php echo $data['user_name']; ?></a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a class="btn btn-sm" style="background-color: #69359C;color: white;" href="Trial-Schedule-Add.php?user_id=<?php echo $records_ts['user_id'] ?>">
                                                <h7 style="text-align: center;">Add&nbsp;<i class="fa fa-calendar-plus-o" aria-hidden="true"></i></h7>

                                            </a>
                                        </td>
                                    </tr>

                            <?php
                                            }
                                        }
                            ?>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="trschedule" tabindex="-1" aria-labelledby="trscheduleLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="color: white;background-color: #03C03C;">
                        <h5 class="modal-title" id="trscheduleLabel">Trial Exam Re-Schedule Pending Users</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="trscheduleTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th style="text-align: center;">Re-Schedule</th>
                                    </tr>
                                </thead>
                                <?php
                                $users_trs = mysqli_query($db, "SELECT user_id FROM trial_exam WHERE overall = 'Fail'");

                                while ($records_trs = mysqli_fetch_array($users_trs)) {
                                    $uid = $records_trs['user_id'];
                                    $users_trs_new = mysqli_query($db, "SELECT paid FROM trial_result WHERE user_id = '$uid'");
                                    $data_pending = mysqli_fetch_array($users_trs_new);
                                    if ($data_pending['paid'] === 'Yes') {
                                ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $get_users_trs = mysqli_query($db, "SELECT gender, user_name FROM users WHERE user_id = " . $records_trs['user_id']);

                                                if ($data = mysqli_fetch_array($get_users_trs)) {
                                                    if ($data['gender'] == "1") { ?>
                                                        <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                                    <?php
                                                    } else if ($data['gender'] == "2") { ?>
                                                        <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                                    <?php
                                                    } else { ?>
                                                        <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                                    <?php
                                                    }
                                                    ?>
                                                    &nbsp;&nbsp;<a href="User-View-Profile.php?user_id=<?php echo $records_trs['user_id'] ?>">
                                                        <?php echo $data['user_name']; ?></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm" style="background-color: #03C03C;" href="Trial-Reschedule-Add.php?user_id=<?php echo $records_trs['user_id'] ?>">
                                                    <h7 style="text-align: center;">Re Schedule&nbsp;<i class="fa fa-calendar-plus-o" aria-hidden="true"></i></h7>
                                                </a>
                                            </td>
                                        </tr>

                            <?php
                                                }
                                            }
                                        }
                            ?>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tresults" tabindex="-1" aria-labelledby="tresultsLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="color: white;background-color: #FFDF00;">
                        <h5 class="modal-title" id="tresultsLabel">Trial Exam Results Pending Users</h5>
                        <button type="button" class="btn" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" style="font-size: 14px;" id="tpendingTable">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th style="text-align: center;">Result</th>
                                    </tr>
                                </thead>
                                <?php
                                $users_tr = mysqli_query($db, "SELECT user_id FROM trial_exam WHERE overall='N/A'");

                                while ($records_tr = mysqli_fetch_array($users_tr)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $get_users_tr = mysqli_query($db, "SELECT gender, user_name FROM users WHERE user_id = " . $records_tr['user_id']);
                                            if ($data = mysqli_fetch_array($get_users_tr)) {
                                                if ($data['gender'] == "1") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                                <?php
                                                } else if ($data['gender'] == "2") { ?>
                                                    <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                                <?php
                                                } else { ?>
                                                    <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                                <?php
                                                }
                                                ?>
                                                &nbsp;&nbsp;<a href="User-View-Profile.php?user_id=<?php echo $records_tr['user_id'] ?>">
                                                    <?php echo $data['user_name']; ?></a>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                                $one_users_tr = mysqli_query($db, "SELECT attempt FROM trial_exam WHERE user_id = " . $records_tr['user_id']);
                                                $one_records_tr = mysqli_fetch_array($one_users_tr);
                                                if ($one_records_tr['attempt'] == '1') {
                                            ?>
                                                <a style="background-color: #FFDF00;" class="btn" href="Trial-Results-Add.php?user_id=<?php echo $records_tr['user_id'] ?>">
                                                    <h7 style="text-align: center;">Add&nbsp;<i class="fa fa-certificate" aria-hidden="true"></i></h7>
                                                </a>
                                            <?php
                                                } else {
                                            ?>
                                                <a style="background-color: #FFDF00;" class="btn" href="Trial-Reschedule-Results-Add.php?user_id=<?php echo $records_tr['user_id'] ?>">
                                                    <h7 style="text-align: center;">Add&nbsp;<i class="fa fa-certificate" aria-hidden="true"></i></h7>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>

                            <?php
                                            }
                                        }
                            ?>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="card border-secondary mb-3">

                    <h5 class="card-header d-flex justify-content-between">
                        Stats
                    </h5>
                    <div class="card-body text-secondary ">
                        <div class="row">
                            <div class="card col-lg-5">
                                <a href="Reports.php">
                                    <div class="card-body">
                                        <span>
                                            <h3>11</h3><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp;Reports Available
                                        </span>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-1"></div>
                            <div class="card col-lg-6">
                                <a href="Admin-StudyMaterials.php">
                                    <div class="card-body">
                                        <span>
                                            <h3><?php echo $total_study ?></h3><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Uploaded Study Materials
                                        </span>
                                    </div>
                                </a>
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="card col-lg-5">
                            <a href="Admin-Issue.php">
                                <div class="card-body">
                                    <span>
                                        <h3><?php echo $total_pr?></h3><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Pending License Renewals
                                    </span>
                                </div>
                            </a>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="card col-lg-6">
                                <a href="Admin-Renewal.php">
                                <a href="NL_Issue.php">
                                    <div class="card-body">
                                        <span>
                                            <h3><?php echo $total_ri ?></h3><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;Pending New License Issuals
                                        </span>
                                    </div>
                                </a>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-secondary mb-3">

                    <h5 class="card-header d-flex justify-content-between">
                        Percentage of Application Status
                    </h5>
                    <br><br>
                    <div class="card-body text-secondary ">
                        <div class="col-lg-6">
                            <div id="new_license" style="width: 100%;"></div>
                        </div>

                        <div class="col-lg-6">
                            <div id="renew_license" style="width: 100%;"></div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
        <br>
        <div class="row">
            <div class=" col-md-4 mb-3">
                <div class="card border-secondary mb-3">

                    <h5 class="card-header d-flex justify-content-between">
                        Written Examination Results (User Attempts with Distiction Pass)
                    </h5>
                    <div class="card-body text-secondary ">
                        <?php
                        $att1_Fail = $att1_Pass = $att2_Fail = $att2_Pass = $att3_Fail = $att3_Pass = $total = 0;
                        $wri_res = mysqli_query($link, "SELECT * FROM written_exam WHERE result ='Pass' OR result = 'No'");
                        while ($data_res = mysqli_fetch_array($wri_res)) {
                            if ($data_res['attempt'] == 1) {
                                if ($data_res['result'] == 'Pass') {
                                    $att1_Pass++;
                                } else {
                                    $att1_Fail++;
                                }
                            } else if ($data_res['attempt'] == 2) {
                                if ($data_res['result'] == 'Pass') {
                                    $att2_Pass++;
                                } else {
                                    $att2_Fail++;
                                }
                            } else if ($data_res['attempt'] == 3) {
                                if ($data_res['result'] == 'Pass') {
                                    $att3_Pass++;
                                } else {
                                    $att3_Fail++;
                                }
                            }
                        }
                        $total = $att1_Pass + $att1_Fail + $att2_Pass + $att2_Fail + $att3_Pass + $att3_Fail;
                        $tot_methods =  array();
                        array_push($tot_methods, "Attempt 01", "Attempt 02", "Attempt 03");
                        $tot =  array();
                        //array_push($tot, $att1_Pass,$att1_Fail,$att2_Pass,$att2_Fail,$att3_Pass,$att3_Fail);
                        array_push(
                            $tot,
                            number_format(100 * $att1_Pass / $total, 2),
                            number_format(100 * $att2_Pass / $total, 2),
                            number_format(100 * $att3_Pass / $total, 2)
                        );
                        ?>
                        <canvas id="chartjs_bar"></canvas>
                    </div>
                </div>

            </div>
            <div class=" col-md-8 mb-3">
                <div class="card border-secondary mb-3">

                    <h5 class="card-header d-flex justify-content-between">
                        Trial Examination Results Pass in the Attempt 1
                    </h5>
                    <div class="card-body text-secondary ">
                        <?php
                        $A1 = $A = $B1 = $B = $C1 = $C = $CE = $D1 = $D = $DE = $G1 = $G = $J = 0;
                        $a1_A = $a2_A = $a3_A = $a1_A1 = $a2_A1 = $a3_A1 = $a1_B = $a2_B = $a3_B = $a1_B1 = $a2_B1 = $a3_B1 =
                            $a1_C = $a2_C = $a3_C = $a1_C1 = $a2_C1 = $a3_C1 = $a1_CE = $a2_CE = $a3_CE = $a1_D = $a2_D = $a3_D =
                            $a1_D1 = $a2_D1 = $a3_D1 = $a1_DE = $a2_DE = $a3_DE = $a1_G1 = $a2_G1 = $a3_G1 = $a1_G = $a2_G = $a3_G =
                            $a1_J = $a2_J = $a3_J = 0;



                        $tri_res = mysqli_query($link, "SELECT * FROM trial_result");
                        while ($data_tri = mysqli_fetch_array($tri_res)) {
                            if ($data_tri['resultA1'] == 'Pass') {
                                if ($data_tri['attemptA1'] == 1) {
                                    $A1++;
                                    $a1_A1++;
                                } else if ($data_tri['attemptA1'] == 2) {
                                    $a2_A1++;
                                } else if ($data_tri['attemptA1'] == 3) {
                                    $a3_A1++;
                                }
                            }

                            if ($data_tri['resultA'] == 'Pass') {
                                if ($data_tri['attemptA'] == 1) {
                                    $A++;
                                    $a1_A++;
                                } else if ($data_tri['attemptA'] == 2) {
                                    $a2_A++;
                                } else if ($data_tri['attemptA'] == 3) {
                                    $a3_A++;
                                }
                            }

                            if ($data_tri['resultB1'] == 'Pass') {
                                if ($data_tri['attemptB1'] == 1) {
                                    $B1++;
                                    $a1_B1++;
                                } else if ($data_tri['attemptB1'] == 2) {
                                    $a2_B1++;
                                } else if ($data_tri['attemptB1'] == 3) {
                                    $a3_B1++;
                                }
                            }

                            if ($data_tri['resultB'] == 'Pass') {
                                if ($data_tri['attemptB'] == 1) {
                                    $B++;
                                    $a1_B++;
                                } else if ($data_tri['attemptB'] == 2) {
                                    $a2_B++;
                                } else if ($data_tri['attemptB'] == 3) {
                                    $a3_B++;
                                }
                            }

                            if ($data_tri['resultC1'] == 'Pass') {
                                if ($data_tri['attemptC1'] == 1) {
                                    $C1++;
                                    $a1_C1++;
                                } else if ($data_tri['attemptC1'] == 2) {
                                    $a2_C1++;
                                } else if ($data_tri['attemptC1'] == 3) {
                                    $a3_C1++;
                                }
                            }

                            if ($data_tri['resultC'] == 'Pass') {
                                if ($data_tri['attemptC'] == 1) {
                                    $C++;
                                    $a1_C++;
                                } else if ($data_tri['attemptC'] == 2) {
                                    $a2_C++;
                                } else if ($data_tri['attemptC'] == 3) {
                                    $a3_C++;
                                }
                            }

                            if ($data_tri['resultCE'] == 'Pass') {
                                if ($data_tri['attemptCE'] == 1) {
                                    $CE++;
                                    $a1_CE++;
                                } else if ($data_tri['attemptCE'] == 2) {
                                    $a2_CE++;
                                } else if ($data_tri['attemptCE'] == 3) {
                                    $a3_CE++;
                                }
                            }

                            if ($data_tri['resultD1'] == 'Pass') {
                                if ($data_tri['attemptD1'] == 1) {
                                    $D1++;
                                    $a1_D1++;
                                } else if ($data_tri['attemptD1'] == 2) {
                                    $a2_D1++;
                                } else if ($data_tri['attemptD1'] == 3) {
                                    $a3_D1++;
                                }
                            }

                            if ($data_tri['resultD'] == 'Pass') {
                                if ($data_tri['attemptD'] == 1) {
                                    $D++;
                                    $a1_D++;
                                } else if ($data_tri['attemptD'] == 2) {
                                    $a2_D++;
                                } else if ($data_tri['attemptD'] == 3) {
                                    $a3_D++;
                                }
                            }

                            if ($data_tri['resultDE'] == 'Pass') {
                                if ($data_tri['attemptDE'] == 1) {
                                    $DE++;
                                    $a1_DE++;
                                } else if ($data_tri['attemptDE'] == 2) {
                                    $a2_DE++;
                                } else if ($data_tri['attemptDE'] == 3) {
                                    $a3_DE++;
                                }
                            }

                            if ($data_tri['resultG1'] == 'Pass') {
                                if ($data_tri['attemptG1'] == 1) {
                                    $G1++;
                                    $a1_G1++;
                                } else if ($data_tri['attemptG1'] == 2) {
                                    $a2_G1++;
                                } else if ($data_tri['attemptG1'] == 3) {
                                    $a3_G1++;
                                }
                            }

                            if ($data_tri['resultG'] == 'Pass') {
                                if ($data_tri['attemptG'] == 1) {
                                    $G++;
                                    $a1_G++;
                                } else if ($data_tri['attemptG'] == 2) {
                                    $a2_G++;
                                } else if ($data_tri['attemptG'] == 3) {
                                    $a3_G++;
                                }
                            }

                            if ($data_tri['resultJ'] == 'Pass') {
                                if ($data_tri['attemptJ'] == 1) {
                                    $J++;
                                    $a1_J++;
                                } else if ($data_tri['attemptJ'] == 2) {
                                    $a2_J++;
                                } else if ($data_tri['attemptJ'] == 3) {
                                    $a3_J++;
                                }
                            }
                        }

                        $tot_Vmethods =  array();
                        array_push($tot_Vmethods, "A1", "A", "B1", "B", "C1", "C", "CE", "D1", "D", "DE", "G1", "G", "J");
                        $tot_types =  array();
                        array_push($tot_types, $A1, $A, $B1, $B, $C1, $C, $CE, $D1, $D, $DE, $G1, $G, $J);
                        ?>
                        <canvas id="chart2js_bar"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class=" col-md-12 mb-3">
                <div class="card border-secondary mb-3">

                    <h5 class="card-header d-flex justify-content-between">
                        Trial Stats in Each Vehicle Type
                    </h5>

                    <?php
                    $tA = $a1_A + $a2_A + $a3_A;
                    $tA1 = $a1_A1 + $a2_A1 + $a3_A1;
                    $tB1 = $a1_B1 + $a2_B1 + $a3_B1;
                    $tB = $a1_B + $a2_B + $a3_B;
                    $tC1 = $a1_C1 + $a2_C1 + $a3_C1;
                    $tC = $a1_C + $a2_C + $a3_C;
                    $tCE = $a1_CE + $a2_CE + $a3_CE;
                    $tD1 = $a1_D1 + $a2_D1 + $a3_D1;
                    $tD = $a1_D + $a2_D + $a3_D;
                    $tDE = $a1_DE + $a2_DE + $a3_DE;
                    $tG1 = $a1_G1 + $a2_G1 + $a3_G1;
                    $tG = $a1_G + $a2_G + $a3_G;
                    $tJ = $a1_J + $a2_J + $a3_J;
                    $tot_A1 =  array();
                    array_push(
                        $tot_A1,
                        number_format(100 * $a1_A1 / $tA1, 2),
                        number_format(100 * $a2_A1 / $tA1, 2),
                        number_format(100 * $a3_A1 / $tA1, 2)
                    );

                    $tot_A =  array();
                    array_push(
                        $tot_A,
                        number_format(100 * $a1_A / $tA, 2),
                        number_format(100 * $a2_A / $tA, 2),
                        number_format(100 * $a3_A / $tA, 2)
                    );

                    $tot_B1 =  array();
                    array_push(
                        $tot_B1,
                        number_format(100 * $a1_B1 / $tB1, 2),
                        number_format(100 * $a2_B1 / $tB1, 2),
                        number_format(100 * $a3_B1 / $tB1, 2)
                    );

                    $tot_B =  array();
                    array_push(
                        $tot_B,
                        number_format(100 * $a1_B / $tB, 2),
                        number_format(100 * $a2_B / $tB, 2),
                        number_format(100 * $a3_B / $tB, 2)
                    );

                    $tot_C1 =  array();
                    array_push(
                        $tot_C1,
                        number_format(100 * $a1_C1 / $tC1, 2),
                        number_format(100 * $a2_C1 / $tC1, 2),
                        number_format(100 * $a3_C1 / $tC1, 2)
                    );

                    $tot_C =  array();
                    array_push(
                        $tot_C,
                        number_format(100 * $a1_C / $tC, 2),
                        number_format(100 * $a2_C / $tC, 2),
                        number_format(100 * $a3_C / $tC, 2)
                    );

                    $tot_CE =  array();
                    array_push(
                        $tot_CE,
                        number_format(100 * $a1_CE / $tCE, 2),
                        number_format(100 * $a2_CE / $tCE, 2),
                        number_format(100 * $a3_CE / $tCE, 2)
                    );

                    $tot_D1 =  array();
                    array_push(
                        $tot_D1,
                        number_format(100 * $a1_D1 / $tD1, 2),
                        number_format(100 * $a2_D1 / $tD1, 2),
                        number_format(100 * $a3_D1 / $tD1, 2)
                    );

                    $tot_D =  array();
                    array_push(
                        $tot_D,
                        number_format(100 * $a1_D / $tD, 2),
                        number_format(100 * $a2_D / $tD, 2),
                        number_format(100 * $a3_D / $tD, 2)
                    );

                    $tot_DE =  array();
                    array_push(
                        $tot_DE,
                        number_format(100 * $a1_DE / $tDE, 2),
                        number_format(100 * $a2_DE / $tDE, 2),
                        number_format(100 * $a3_DE / $tDE, 2)
                    );

                    $tot_G1 =  array();
                    array_push(
                        $tot_G1,
                        number_format(100 * $a1_G1 / $tG1, 2),
                        number_format(100 * $a2_G1 / $tG1, 2),
                        number_format(100 * $a3_G1 / $tG1, 2)
                    );

                    $tot_G =  array();
                    array_push(
                        $tot_G,
                        number_format(100 * $a1_G / $tG, 2),
                        number_format(100 * $a2_G / $tG, 2),
                        number_format(100 * $a3_G / $tG, 2)
                    );

                    $tot_J =  array();
                    array_push(
                        $tot_J,
                        number_format(100 * $a1_J / $tJ, 2),
                        number_format(100 * $a2_J / $tJ, 2),
                        number_format(100 * $a3_J / $tJ, 2)
                    );
                    ?>

                    <div class="card-body text-secondary ">
                        <div class="card-deck mt-3 text-light">
                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/1.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">A1</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/22.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">A</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/3.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">B1</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/4.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">B</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/5.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">C1</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/5.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">C1</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/6.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">C</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/7.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">CE</h5>
                                </button>
                            </div>
                        </div>
                        <div class="card-deck mt-3 text-light">
                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/8.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">D1</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/9.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">D</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/10.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">DE</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/11.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">G1</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/11.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">G</h5>
                                </button>
                            </div>

                            <div class="card border shadow-lg  p-2">
                                <button class="btn" data-toggle="modal" data-target="#regiUsers">
                                    <div class="row-gutter sm">
                                        <div class="col-md-2" style="float:left;"><img
                                                src="Header/production/images/12.png"></div>
                                    </div><br><br><br>
                                    <h5 style="color: grey;">J</h5>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</div>

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

<!-- jQuery -->

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/r-2.2.7/sc-2.0.3/sp-1.2.2/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#wscheduleTable').DataTable();
    });

    $(document).ready(function() {
        $('#regiTable').DataTable();
    });

    $(document).ready(function() {
        $('#learnersTable').DataTable();
    });

    $(document).ready(function() {
        $('#adTable').DataTable();
    });

    $(document).ready(function() {
        $('#wresultsTable').DataTable();
    });

    $(document).ready(function() {
        $('#tscheduleTable').DataTable();
    });

    $(document).ready(function() {
        $('#trscheduleTable').DataTable();
    });

    $(document).ready(function() {
        $('#tpendingTable').DataTable();
    });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById("chartjs_bar").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($tot_methods); ?>,
            datasets: [{
                backgroundColor: [
                    "#2ec551",
                    "#ff407b",
                    "#ffc750",
                    "#5969ff",
                    "#ff004e",
                    "#7040fa"

                ],
                data: <?php echo json_encode($tot); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',

                labels: {
                    fontColor: '#71748d',
                    fontSize: 14,
                }
            },


        }
    });

    var ctx = document.getElementById("chart2js_bar").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($tot_Vmethods); ?>,
            datasets: [{
                backgroundColor: [
                    "#ff407b",
                    "#ffc750",
                    "#5969ff",
                    "#ff004e",
                    "#C19A6B",
                    "#2ec551",
                    "#966FD6",
                    "#FF9966",
                    "#008B8B",
                    "#FFA812",
                    "#30D5CB",
                    "#CC4E5C",
                    "#3B444B"

                ],
                data: <?php echo json_encode($tot_types); ?>,
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',

                labels: {
                    fontColor: '#71748d',
                    fontSize: 14,
                }
            },


        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>



<!-- Bootstrap -->
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>