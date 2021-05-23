<?php
require_once 'admin-header.php';

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
<div class="right_col" role="main">
    <!-- Add Admin -->
    <div class="row justify-content-center wrapper">
        <div class="col-lg-12 bg-white p-7 pt-12">
            <div class="row gutters-sm">
                <div class=" col-md-8 mb-3">
                    <h4 class="text-center font-weight-bold">Added Trial Schedules</h4>
                    <hr class="my-3" />
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header bg-info" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="false" aria-controls="collapseOne"
                                        style="color: white;text-decoration: none;">
                                        A1 &nbsp;&nbsp;<img src="Header/production/images/1.png"><br>
                                        A &nbsp;&nbsp;<img src="Header/production/images/22.png">
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="ATable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $d1 = date_create("2000-01-01");
                            $d1 = date_format($d1,"Y-m-d");
                            $records1 = mysqli_query($db,"SELECT * FROM trial_exam WHERE date1 != 'null' AND date1 != '$d1'");
                            
                            while($data1=mysqli_fetch_array($records1)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data1['user_id']?>">
                                                        <?php echo $data1['full_name'];?></a></td>
                                                <td><?php echo $data1['attempt'];?></td>
                                                <td><?php echo $data1['location1'];?></td>
                                                <td><?php echo $data1['date1'];?></td>
                                                <td><?php echo $data1['time1'];?></td>
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
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo"
                                        style="color: white;text-decoration: none;">
                                        B1 &nbsp;&nbsp;<img src="Header/production/images/3.png"><br>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="B1Table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records2 = mysqli_query($db,"SELECT * FROM trial_exam WHERE date2 != 'null' AND date2 != '$d1'");
                            while($data2=mysqli_fetch_array($records2)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data2['user_id']?>">
                                                        <?php echo $data2['full_name'];?></a></td>
                                                <td><?php echo $data2['attempt'];?></td>
                                                <td><?php echo $data2['location2'];?></td>
                                                <td><?php echo $data2['date2'];?></td>
                                                <td><?php echo $data2['time2'];?></td>
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
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree"
                                        style="color: white;text-decoration: none;">
                                        B &nbsp;&nbsp;<img src="Header/production/images/4.png"><br>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="BTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records3 = mysqli_query($db,"SELECT * FROM trial_exam WHERE date3 != 'null' AND date3 != '$d1'");
                            while($data3=mysqli_fetch_array($records3)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data3['user_id']?>">
                                                        <?php echo $data3['full_name'];?></a></td>
                                                <td><?php echo $data3['attempt'];?></td>
                                                <td><?php echo $data3['location3'];?></td>
                                                <td><?php echo $data3['date3'];?></td>
                                                <td><?php echo $data3['time3'];?></td>
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
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour"
                                        style="color: white;text-decoration: none;">
                                        C1 &nbsp;&nbsp;<img src="Header/production/images/5.png"><br>
                                        C &nbsp;&nbsp;<img src="Header/production/images/6.png"><br>
                                        CE &nbsp;&nbsp;<img src="Header/production/images/7.png"><br>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="CTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records4 = mysqli_query($db,"SELECT * FROM trial_exam WHERE date4 != 'null' AND date4 != '$d1'");
                            while($data4=mysqli_fetch_array($records4)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data4['user_id']?>">
                                                        <?php echo $data4['full_name'];?></a></td>
                                                <td><?php echo $data4['attempt'];?></td>
                                                <td><?php echo $data4['location4'];?></td>
                                                <td><?php echo $data4['date4'];?></td>
                                                <td><?php echo $data4['time4'];?></td>
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
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive"
                                        style="color: white;text-decoration: none;">
                                        D1 &nbsp;&nbsp;<img src="Header/production/images/8.png"><br>
                                        D &nbsp;&nbsp;<img src="Header/production/images/9.png"><br>
                                        DE &nbsp;&nbsp;<img src="Header/production/images/10.png"><br>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseFive" class="collapse show" aria-labelledby="headingFive"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="DTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records5 = mysqli_query($db,"SELECT * FROM trial_exam WHERE date5 != 'null' AND date5 != '$d1'");
                            while($data5=mysqli_fetch_array($records5)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data5['user_id']?>">
                                                        <?php echo $data5['full_name'];?></a></td>
                                                <td><?php echo $data5['attempt'];?></td>
                                                <td><?php echo $data5['location5'];?></td>
                                                <td><?php echo $data5['date5'];?></td>
                                                <td><?php echo $data5['time5'];?></td>
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
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSix"
                                        aria-expanded="false" aria-controls="collapseSix"
                                        style="color: white;text-decoration: none;">
                                        G1 &nbsp;&nbsp;<img src="Header/production/images/11.png"><br>
                                        G &nbsp;&nbsp;<img src="Header/production/images/12.png">
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseSix" class="collapse show" aria-labelledby="headingSix"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="GTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records6 = mysqli_query($db,"SELECT * FROM trial_exam WHERE date6 != 'null' AND date6 != '$d1'");
                            while($data6=mysqli_fetch_array($records6)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data6['user_id']?>">
                                                        <?php echo $data6['full_name'];?></a></td>
                                                <td><?php echo $data6['attempt'];?></td>
                                                <td><?php echo $data6['location6'];?></td>
                                                <td><?php echo $data6['date6'];?></td>
                                                <td><?php echo $data6['time6'];?></td>
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
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven"
                                        aria-expanded="false" aria-controls="collapseSeven">
                                        J &nbsp;&nbsp;<img src="Header/production/images/13.png"><br>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="JTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records7 = mysqli_query($db,"SELECT * FROM trial_exam WHERE date7 != 'null' AND date7 != '$d1'");
                            while($data7=mysqli_fetch_array($records7)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data7['user_id']?>">
                                                        <?php echo $data7['full_name'];?></a></td>
                                                <td><?php echo $data7['attempt'];?></td>
                                                <td><?php echo $data7['location7'];?></td>
                                                <td><?php echo $data7['date7'];?></td>
                                                <td><?php echo $data7['time7'];?></td>
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
                <div class=" col-md-4 mb-3">
                    <div class="row justify-content-center">
                        <?php
require_once 'calender.php'; 
?>
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
<script src="Header/vendors/jquery/dist/jquery.min.js"></script>

<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/dt-1.10.24/r-2.2.7/sc-2.0.3/sp-1.2.2/datatables.min.js"></script>
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

</body>

</html>