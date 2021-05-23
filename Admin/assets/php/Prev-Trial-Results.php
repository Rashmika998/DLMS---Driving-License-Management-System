<?php


require_once 'admin-header.php';


?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="Header/vendors/jquery/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<div class="right_col" role="main">
    <!-- Add Admin -->
    <div class="row justify-content-center wrapper">
        <div class="col-lg-10 bg-white p-7 pt-12">
            <h4 class="text-center font-weight-bold">Added Trial Results</h4>
            <hr class="my-3" />


            <div class="row mb-3">

                <div class="col-12 mx-auto">
                    <div class="float-right">
                        <form method="post" action="trial_results_export.php" >

                            <div class="col-md-2 mt-2">
                                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div id="accordion">
                <div class="card">
                    <div class="card-header bg-info" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color: white;text-decoration: none;">
                                A1 &nbsp;&nbsp;<img src="Header/production/images/1.png"><br>
                                A &nbsp;&nbsp;<img src="Header/production/images/22.png">
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-hover" style="font-size: 14px;" id="ATable">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="text-align:left">Name</th>
                                            <th>Types</th>
                                            <th>Attempt</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $db = mysqli_connect("localhost", "root", "", "dlms");
                                    $records1 = mysqli_query($db, "SELECT * FROM trial_result WHERE resultA1 != '' OR resultA != ''");

                                    while ($data1 = mysqli_fetch_array($records1)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="text-align: left;"><a href="User-View-Profile.php?user_id=<?php echo $data1['user_id'] ?>">
                                                    <?php
                                                    $user_id = $data1['user_id'];

                                                    $records = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
                                                    $row = mysqli_fetch_assoc($records);

                                                    $record_details = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $user_id . "'");
                                                    $row_details = mysqli_fetch_assoc($record_details);
                                                    echo $row['full_name']; ?></a></td>
                                            <td><?php
                                                if ($row_details['A1'] == 1) {
                                                ?><p style="font-size: 14px;"><?php echo "A1"; ?></p><?php
                                                                                                    }

                                                                                                    if ($row_details['A'] == 1) {
                                                                                                        ?><p style="font-size: 14px;"><?php echo "A"; ?></p>
                                            </td><?php
                                                                                                    }
                                                    ?>
                                        <td><?php
                                            if ($row_details['A1'] == 1) {
                                            ?><p style="font-size: 14px;"><?php echo $data1['attemptA1']; ?></p><?php

                                                                                                            }
                                                                                                            if ($row_details['A'] == 1) {
                                                                                                                ?><p style="font-size: 14px;"><?php echo $data1['attemptA']; ?></p><?php
                                                                                                                                                                                }
                                                                                                                                                                                    ?>
                                        <td><?php
                                            if ($row_details['A1'] == 1) {
                                                if ($data1['resultA1'] == 'Pass') {
                                            ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                } else {
                                                                                                                                    ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                            }
                                                                                                                                                                                                        }

                                                                                                                                                                                                        if ($row_details['A'] == 1) {
                                                                                                                                                                                                            if ($data1['resultA'] == 'Pass') {
                                                                                                                                                                                                                ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                            } ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="card">
                    <div class="card-header bg-primary" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: white;text-decoration: none;">
                                B1 &nbsp;&nbsp;<img src="Header/production/images/3.png"><br>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-hover" style="font-size: 14px;" id="B1Table">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="text-align:left">Name</th>
                                            <th>Types</th>
                                            <th>Attempt</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $db = mysqli_connect("localhost", "root", "", "dlms");
                                    $records2 = mysqli_query($db, "SELECT * FROM trial_result WHERE resultB1 != ''");
                                    while ($data2 = mysqli_fetch_array($records2)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="text-align: left;"><a href="User-View-Profile.php?user_id=<?php echo $data2['user_id'] ?>">
                                                    <?php
                                                    $user_id = $data2['user_id'];

                                                    $records = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
                                                    $row = mysqli_fetch_assoc($records);

                                                    $record_details = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $user_id . "'");
                                                    $row_details = mysqli_fetch_assoc($record_details);
                                                    echo $row['full_name']; ?></a></td>
                                            <td>
                                                <p style="font-size: 14px;"><?php echo "B1"; ?></p><?php

                                                                                                    ?>
                                            </td>
                                            <td><?php
                                                ?><p style="font-size: 14px;"><?php echo $data2['attemptB1']; ?></p><?php
                                                                                                                    ?></td>
                                            <td><?php
                                                if ($data2['resultB1'] == 'Pass') {
                                                ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                    } else {
                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                } ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="card">
                    <div class="card-header bg-warning" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="color: white;text-decoration: none;">
                                B &nbsp;&nbsp;<img src="Header/production/images/4.png"><br>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-hover" style="font-size: 14px;" id="BTable">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="text-align:left">Name</th>
                                            <th>Types</th>
                                            <th>Attempt</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $db = mysqli_connect("localhost", "root", "", "dlms");
                                    $records3 = mysqli_query($db, "SELECT * FROM trial_result WHERE resultB != ''");
                                    while ($data3 = mysqli_fetch_array($records3)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="text-align: left;"><a href="User-View-Profile.php?user_id=<?php echo $data3['user_id'] ?>">
                                                    <?php
                                                    $user_id = $data3['user_id'];

                                                    $records = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
                                                    $row = mysqli_fetch_assoc($records);

                                                    $record_details = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $user_id . "'");
                                                    $row_details = mysqli_fetch_assoc($record_details);
                                                    echo $row['full_name']; ?></a></td>
                                            <td>
                                                <p style="font-size: 14px;"><?php echo "B"; ?></p><?php
                                                                                                    ?>
                                            </td>
                                            <td><?php
                                                ?><p style="font-size: 14px;"><?php echo $data3['attemptB']; ?></p><?php
                                                                                                                    ?></td>
                                            <td><?php
                                                if ($data3['resultB'] == 'Pass') {
                                                ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                    } else {
                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                }
                                                                                                                                                                                                                    ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="card">
                    <div class="card-header bg-success" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="color: white;text-decoration: none;">
                                C1 &nbsp;&nbsp;<img src="Header/production/images/5.png"><br>
                                C &nbsp;&nbsp;<img src="Header/production/images/6.png"><br>
                                CE &nbsp;&nbsp;<img src="Header/production/images/7.png"><br>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-hover" style="font-size: 14px;" id="CTable">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="text-align:left">Name</th>
                                            <th>Types</th>
                                            <th>Attempt</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $db = mysqli_connect("localhost", "root", "", "dlms");
                                    $records4 = mysqli_query($db, "SELECT * FROM trial_result WHERE resultC1 != '' OR resultC != '' OR resultCE != ''");
                                    while ($data4 = mysqli_fetch_array($records4)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="text-align: left;"><a href="User-View-Profile.php?user_id=<?php echo $data4['user_id'] ?>">
                                                    <?php
                                                    $user_id = $data4['user_id'];

                                                    $records = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
                                                    $row = mysqli_fetch_assoc($records);

                                                    $record_details = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $user_id . "'");
                                                    $row_details = mysqli_fetch_assoc($record_details);
                                                    echo $row['full_name']; ?></a></td>
                                            <td><?php
                                                if ($row_details['C1'] == 1) {
                                                ?><p style="font-size: 14px;"><?php echo "C1"; ?></p><?php
                                                                                                    }

                                                                                                    if ($row_details['C'] == 1) {
                                                                                                        ?><p style="font-size: 14px;"><?php echo "C"; ?></p><?php
                                                                                                                                                        }

                                                                                                                                                        if ($row_details['CE'] == 1) {
                                                                                                                                                            ?><p style="font-size: 14px;"><?php echo "CE"; ?></p><?php
                                                                                                                                                                                                                }
                                                                                                                                                                                                                    ?></td>
                                            <td><?php
                                                if ($row_details['C1'] == 1) {
                                                ?><p style="font-size: 14px;"><?php echo $data4['attemptC1']; ?></p><?php
                                                                                                                }

                                                                                                                if ($row_details['C'] == 1) {
                                                                                                                    ?><p style="font-size: 14px;"><?php echo $data4['attemptC']; ?></p><?php
                                                                                                                                                                                    }

                                                                                                                                                                                    if ($row_details['CE'] == 1) {
                                                                                                                                                                                        ?><p style="font-size: 14px;"><?php echo $data4['attemptCE']; ?></p><?php
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                            ?></td>
                                            <td><?php
                                                if ($row_details['C1'] == 1) {
                                                    if ($data4['resultC1'] == 'Pass') {
                                                ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                    } else {
                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                }
                                                                                                                                                                                                            }

                                                                                                                                                                                                            if ($row_details['C'] == 1) {
                                                                                                                                                                                                                if ($data4['resultC'] == 'Pass') {
                                                                                                                                                                                                                    ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                                                                                                if ($row_details['CE'] == 1) {
                                                                                                                                                                                                                                                                                                                                                                                    if ($data4['resultCE'] == 'Pass') {
                                                                                                                                                                                                                                                                                                                                                                                        ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="card">
                    <div class="card-header bg-danger" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="color: white;text-decoration: none;">
                                D1 &nbsp;&nbsp;<img src="Header/production/images/8.png"><br>
                                D &nbsp;&nbsp;<img src="Header/production/images/9.png"><br>
                                DE &nbsp;&nbsp;<img src="Header/production/images/10.png"><br>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-hover" style="font-size: 14px;" id="DTable">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="text-align:left">Name</th>
                                            <th>Types</th>
                                            <th>Attempt</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $db = mysqli_connect("localhost", "root", "", "dlms");
                                    $records5 = mysqli_query($db, "SELECT * FROM trial_result WHERE resultD1 != '' OR resultD != ''
                            OR resultDE != ''");
                                    while ($data5 = mysqli_fetch_array($records5)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="text-align: left;"><a href="User-View-Profile.php?user_id=<?php echo $data5['user_id'] ?>">
                                                    <?php
                                                    $user_id = $data5['user_id'];

                                                    $records = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
                                                    $row = mysqli_fetch_assoc($records);

                                                    $record_details = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $user_id . "'");
                                                    $row_details = mysqli_fetch_assoc($record_details);
                                                    echo $row['full_name']; ?></a></td>
                                            <td><?php
                                                if ($row_details['D1'] == 1) {
                                                ?><p style="font-size: 14px;"><?php echo "D1"; ?></p><?php
                                                                                                    }

                                                                                                    if ($row_details['D'] == 1) {
                                                                                                        ?><p style="font-size: 14px;"><?php echo "D"; ?></p><?php
                                                                                                                                                        }

                                                                                                                                                        if ($row_details['DE'] == 1) {
                                                                                                                                                            ?><p style="font-size: 14px;"><?php echo "DE"; ?></p><?php
                                                                                                                                                                                                                }
                                                                                                                                                                                                                    ?></td>
                                            <td><?php
                                                if ($row_details['D1'] == 1) {
                                                ?><p style="font-size: 14px;"><?php echo $data5['attemptD1']; ?></p><?php
                                                                                                                }

                                                                                                                if ($row_details['D'] == 1) {
                                                                                                                    ?><p style="font-size: 14px;"><?php echo $data5['attemptD']; ?></p><?php
                                                                                                                                                                                    }

                                                                                                                                                                                    if ($row_details['DE'] == 1) {
                                                                                                                                                                                        ?><p style="font-size: 14px;"><?php echo $data5['attemptDE']; ?></p><?php
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                            ?></td>
                                            <td><?php
                                                if ($row_details['D1'] == 1) {
                                                    if ($data5['resultD1'] == 'Pass') {
                                                ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                    } else {
                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                }
                                                                                                                                                                                                            }

                                                                                                                                                                                                            if ($row_details['D'] == 1) {
                                                                                                                                                                                                                if ($data5['resultD'] == 'Pass') {
                                                                                                                                                                                                                    ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                            ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                                                                                                if ($row_details['DE'] == 1) {
                                                                                                                                                                                                                                                                                                                                                                                    if ($data5['resultDE'] == 'Pass') {
                                                                                                                                                                                                                                                                                                                                                                                        ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p>
                                                        </p><?php
                                                                                                                                                                                                                                                                                                                                                                                    } else {
                                                            ?><p style="color: red; font-size: 14px;"><?php echo 'FailS'; ?></p><?php
                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                } ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="card">
                    <div class="card-header bg-secondary" id="headingSix">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" style="color: white;text-decoration: none;">
                                G1 &nbsp;&nbsp;<img src="Header/production/images/11.png"><br>
                                G &nbsp;&nbsp;<img src="Header/production/images/12.png">
                            </button>
                        </h5>
                    </div>

                    <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-hover" style="font-size: 14px;" id="GTable">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="text-align:left">Name</th>
                                            <th>Types</th>
                                            <th>Attempt</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $db = mysqli_connect("localhost", "root", "", "dlms");
                                    $records6 = mysqli_query($db, "SELECT * FROM trial_result WHERE resultG1 != '' OR resultG != ''");
                                    while ($data6 = mysqli_fetch_array($records6)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="text-align: left;"><a href="User-View-Profile.php?user_id=<?php echo $data6['user_id'] ?>">
                                                    <?php
                                                    $user_id = $data6['user_id'];

                                                    $records = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
                                                    $row = mysqli_fetch_assoc($records);

                                                    $record_details = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $user_id . "'");
                                                    $row_details = mysqli_fetch_assoc($record_details);
                                                    echo $row['full_name']; ?></a></td>
                                            <td><?php
                                                if ($row_details['G1'] == 1) {
                                                ?><p style="font-size: 14px;"><?php echo "G1"; ?></p><?php
                                                                                                    }

                                                                                                    if ($row_details['G'] == 1) {
                                                                                                        ?><p style="font-size: 14px;"><?php echo "G"; ?></p>
                                            </td><?php
                                                                                                    }
                                                    ?>
                                        <td><?php
                                            if ($row_details['G1'] == 1) {
                                            ?><p style="font-size: 14px;"><?php echo $data6['attemptG1']; ?></p><?php

                                                                                                            }
                                                                                                            if ($row_details['G'] == 1) {
                                                                                                                ?><p style="font-size: 14px;"><?php echo $data6['attemptG']; ?></p><?php
                                                                                                                                                                                }
                                                                                                                                                                                    ?>
                                        <td><?php
                                            if ($row_details['G1'] == 1) {
                                                if ($data6['resultG1'] == 'Pass') {
                                            ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                } else {
                                                                                                                                    ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                            }
                                                                                                                                                                                                        }

                                                                                                                                                                                                        if ($row_details['G'] == 1) {
                                                                                                                                                                                                            if ($data6['resultG'] == 'Pass') {
                                                                                                                                                                                                                ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                            } ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br><br>

                <div class="card">
                    <div class="card-header" id="headingSeven" style="background-color: #AEC6CF;">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                J &nbsp;&nbsp;<img src="Header/production/images/13.png"><br>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-hover" style="font-size: 14px;" id="JTable">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="text-align:left">Name</th>
                                            <th>Types</th>
                                            <th>Attempt</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $db = mysqli_connect("localhost", "root", "", "dlms");
                                    $records7 = mysqli_query($db, "SELECT * FROM trial_result WHERE resultJ != ''");
                                    while ($data7 = mysqli_fetch_array($records7)) {
                                    ?>
                                        <tr style="text-align: center;">
                                            <td style="text-align: left;"><a href="User-View-Profile.php?user_id=<?php echo $data7['user_id'] ?>">
                                                    <?php
                                                    $user_id = $data7['user_id'];

                                                    $records = mysqli_query($link, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
                                                    $row = mysqli_fetch_assoc($records);

                                                    $record_details = mysqli_query($link, "SELECT * FROM user_details WHERE user_id ='" . $user_id . "'");
                                                    $row_details = mysqli_fetch_assoc($record_details);
                                                    echo $row['full_name']; ?></a></td>
                                            <td>
                                                <p style="font-size: 14px;"><?php echo "J"; ?></p><?php
                                                                                                    ?>
                                            </td>
                                            <td><?php
                                                ?><p style="font-size: 14px;"><?php echo $data7['attemptJ']; ?></p><?php
                                                                                                                    ?></td>
                                            <td><?php
                                                if ($data7['resultJ'] == 'Pass') {
                                                ?><p style="color:green;"><i class="fa fa-check-circle-o" aria-hidden="true"></i></p><?php
                                                                                                                                    } else {
                                                                                                                                        ?><p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i></p><?php
                                                                                                                                                                                                                }
                                                                                                                                                                                                                    ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        $('#ATable').DataTable();
    });

    $(document).ready(function() {
        $('#BTable').DataTable();
    });

    $(document).ready(function() {
        $('#B1Table').DataTable();
    });

    $(document).ready(function() {
        $('#CTable').DataTable();
    });

    $(document).ready(function() {
        $('#DTable').DataTable();
    });

    $(document).ready(function() {
        $('#GTable').DataTable();
    });

    $(document).ready(function() {
        $('#JTable').DataTable();
    });
</script>

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>

</body>

</html>