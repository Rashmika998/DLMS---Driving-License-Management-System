<?php
require_once 'admin-header.php';

if(isset($_GET['date'])){
    $s_date = $_GET['date'];
    $_SESSION['date'] = $s_date;
}

else{
    $s_date = $_SESSION['date'];
}

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
<div class="right_col" role="main">
    <div class="row justify-content-center wrapper">
        <div class="col-lg-12 bg-white p-4 pt-12">
            <div class="row gutters-sm">
                <div class=" col-md-8 mb-3">
                    <h4 class="text-center font-weight-bold">Written Exam Schedules for <?php echo $s_date ?></h4>
                    <hr class="my-3" />
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="false" aria-controls="collapseOne">
                                        09.00 a.m - 10.00 a.m &nbsp;&nbsp;<i class="fa fa-clock-o"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="1Table">
                                            <thead>
                                                <tr>
                                                    <th>User Full Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th style="text-align: center;">Result</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records = mysqli_query($db,"SELECT * FROM written_exam WHERE date = '$s_date' AND time = '09.00 a.m - 10.00 a.m'");
                            while($data=mysqli_fetch_array($records)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data['user_id']?>">
                                                        <?php echo $data['full_name'];?></a></td>
                                                <td><?php echo $data['attempt'];?></td>
                                                <td><?php echo $data['location'];?></td>
                                                <td style="text-align: center;"><?php
                                    if($data['result'] == 'Pass'){
                                        ?>
                                                    <div class="btn btn-success">Pass</div>
                                                    <?php
                                    }
                                    else{
                                        ?>
                                                    <div class="btn btn-danger">Fail</div>
                                                    <?php
                                    }
                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                            }
                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        11.00 a.m - 12.00 p.m &nbsp;&nbsp;<i class="fa fa-clock-o"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="2Table">
                                            <thead>
                                                <tr>
                                                    <th>User Full Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th style="text-align: center;">Result</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records = mysqli_query($db,"SELECT * FROM written_exam WHERE date = '$s_date' AND time = '11.00 a.m - 12.00 p.m'");
                            while($data=mysqli_fetch_array($records)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data['user_id']?>">
                                                        <?php echo $data['full_name'];?></a></td>
                                                <td><?php echo $data['attempt'];?></td>
                                                <td><?php echo $data['location'];?></td>
                                                <td style="text-align: center;"><?php
                                    if($data['result'] == 'Pass'){
                                        ?>
                                                    <div class="btn btn-success">Pass</div>
                                                    <?php
                                    }
                                    else{
                                        ?>
                                                    <div class="btn btn-danger">Fail</div>
                                                    <?php
                                    }
                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                            }
                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        01.00 p.m - 02.00 p.m &nbsp;&nbsp;<i class="fa fa-clock-o"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="3Table">
                                            <thead>
                                                <tr>
                                                    <th>User Full Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th style="text-align: center;">Result</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records = mysqli_query($db,"SELECT * FROM written_exam WHERE date = '$s_date' AND time = '01.00 p.m - 02.00 p.m'");
                            while($data=mysqli_fetch_array($records)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data['user_id']?>">
                                                        <?php echo $data['full_name'];?></a></td>
                                                <td><?php echo $data['attempt'];?></td>
                                                <td><?php echo $data['location'];?></td>
                                                <td style="text-align: center;"><?php
                                    if($data['result'] == 'Pass'){
                                        ?>
                                                    <div class="btn btn-success">Pass</div>
                                                    <?php
                                    }
                                    else{
                                        ?>
                                                    <div class="btn btn-danger">Fail</div>
                                                    <?php
                                    }
                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                            }
                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        03.00 p.m - 04.00 p.m &nbsp;&nbsp;<i class="fa fa-clock-o"
                                            aria-hidden="true"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="collapseFour"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-hover" style="font-size: 14px;"
                                            id="4Table">
                                            <thead>
                                                <tr>
                                                    <th>User Full Name</th>
                                                    <th>Attempt</th>
                                                    <th>Location</th>
                                                    <th style="text-align: center;">Result</th>
                                                </tr>
                                            </thead>
                                            <?php
                            $db = mysqli_connect("localhost","root","","dlms");
                            $records = mysqli_query($db,"SELECT * FROM written_exam WHERE date = '$s_date' AND time = '03.00 p.m - 04.00 p.m'");
                            while($data=mysqli_fetch_array($records)){
                                ?>
                                            <tr>
                                                <td><a
                                                        href="User-View-Profile.php?user_id=<?php echo $data['user_id']?>">
                                                        <?php echo $data['full_name'];?></a></td>
                                                <td><?php echo $data['attempt'];?></td>
                                                <td><?php echo $data['location'];?></td>
                                                <td style="text-align: center;"><?php
                                    if($data['result'] == 'Pass'){
                                        ?>
                                                    <div class="btn btn-success">Pass</div>
                                                    <?php
                                    }
                                    else{
                                        ?>
                                                    <div class="btn btn-danger">Fail</div>
                                                    <?php
                                    }
                                    ?>
                                                </td>
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
    $('#1Table').DataTable();
});

$(document).ready(function() {
    $('#2Table').DataTable();
});

$(document).ready(function() {
    $('#3Table').DataTable();
});

$(document).ready(function() {
    $('#4Table').DataTable();
});
</script>

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>