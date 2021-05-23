<?php
require_once 'admin-header.php';

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />
<div class="right_col" role="main">
    <!-- Add Admin -->
    <div class="row justify-content-center wrapper">
        <div class="col-lg-12 bg-white p-4 pt-12">
            <div class="row gutters-sm">
                <div class=" col-md-7 mb-3">
                    <h4 class="text-center font-weight-bold">Written Exam Added Results</h4>
                    <hr class="my-3" />
                    <p style="color: blue; font-size: 14px;">Exams conducted dates are shown</p>
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-hover" style="font-size: 14px;" id="resTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <?php
            $db = mysqli_connect("localhost","root","","dlms");
            $records = mysqli_query($db,"SELECT DISTINCT date FROM written_exam WHERE result = 'Pass' OR result = 'Fail' ORDER BY date DESC");
            while($data=mysqli_fetch_array($records)){
                ?>
                            <tr>
                                <td>
                                    <a href="Prev-Written-One-Result.php?date=<?php echo $data['date']?>">
                                        <div style="font-size: 17px;">
                                            <?php echo $data['date'];?>&nbsp;&nbsp;<i class="fa fa-calendar"
                                                aria-hidden="true"></i>
                                            <p style="float: right;"><i class="fa fa-chevron-right"
                                                    aria-hidden="true"></i></p>
                                        </div>
                                    </a>

                                </td>
                            </tr>
                            <?php
            }
            ?>
                        </table>
                    </div>
                </div>
                <div class=" col-md-5 mb-3">
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