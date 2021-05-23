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
                    <h4 class="text-center font-weight-bold">Added Results for <?php echo $s_date; ?></h4>
                    <hr class="my-3" />
                    <table class="table table-striped table-hover" style="font-size: 14px;" id="resTable">
                        <thead>
                            <tr>
                                <th>User Full Name</th>
                                <th style="text-align: center;">Attempt</th>
                                <th style="text-align: center;">Result</th>
                            </tr>
                        </thead>
                        <?php
                    $db = mysqli_connect("localhost","root","","dlms");
                    $records = mysqli_query($db,"SELECT * FROM written_exam WHERE date = '$s_date' AND result != 'N/A'");
                    while($data=mysqli_fetch_array($records)){
                    ?>
                        <tr>
                            <td><a href="User-View-Profile.php?user_id=<?php echo $data['user_id']?>">
                                    <?php
                    $records_user = mysqli_query($db,"SELECT * FROM users WHERE user_id = ".$data['user_id']);
                    $data_user=mysqli_fetch_array($records_user);
                    if($data_user['gender'] == "1"){?>
                                    <img src="https://img.icons8.com/color/50/000000/user-male-circle--v1.png" />
                                    <?php
                    }

                    else if($data_user['gender'] == "2"){?>
                                    <img src="https://img.icons8.com/color/50/000000/user-female-circle--v1.png" />
                                    <?php
                    }

                    else{?>
                                    <img src="https://img.icons8.com/material-rounded/24/000000/user.png" />
                                    <?php
                    }
                    ?>
                                    <?php echo $data['full_name'];?></a></td>
                            <td style="text-align: center;"><?php echo $data['attempt'];?></td>
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
    $('#resTable').DataTable();
});
</script>

<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>