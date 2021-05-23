<?php
ob_start();

require_once 'admin-header.php';

$user_id = $_GET['user_id'];

$full_name = $uid =  $attempt = $location = $capacity = $date = $time ="";

$location_err = $username_err = $name_err = "";

$records = mysqli_query($link,"SELECT * FROM users WHERE user_id ='".$user_id."'");
$row = mysqli_fetch_assoc($records);

$_SESSION['full_name'] = $row['full_name'];
$new_records = mysqli_query($link,"SELECT * FROM written_payment WHERE user_id ='".$user_id."'");
$one_row = mysqli_fetch_assoc($new_records);

$_SESSION['attempt'] = $one_row['attempt'];
?>


<div class="right_col" role="main">
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4 pt-12">
            <h4 class="text-center font-weight-bold">Add Schedule For Written Exam</h4>
            <hr class="my-3" />
            <form action="Written-Schedule-Upload.php" method="POST"
                class="px-3 needs-validation" id="admin_add">
                <div class="form-group">
                    <input type="number" class="form-control" name="uid" placeholder="Enter the location"
                        value="<?php echo $row['user_id']; ?>" hidden>
                </div><br>
                <div class="form-group">
                    <label>User Name</label>
                    <?php

                    if ($username_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $name_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }
                    ?>
                    <input type="text" class="form-control" name="user_name" placeholder="Enter User Name"
                        value="<?php echo $row['user_name']; ?>" disabled>
                </div><br>

                <div class="form-group">
                    <label>User Full Name</label>
                    <?php

                    if ($name_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $name_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }
                    ?>
                    <input type="text" class="form-control" name="full_name" 
                        value="<?php echo $row['full_name']; ?>" placeholder="Enter User Full Name" disabled>
                </div><br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Attempt</label>
                        <input type="text" class="form-control" name="attempt" value="<?php echo $one_row['attempt']; ?>" 
                        disabled>
                    </div><br>

                    <div class="form-group col-md-6">
                        <label>Capacity</label>
                        <input type="number" class="form-control" name="capacity" placeholder="Enter the No of Students"
                            required>
                    </div><br>
                </div><br>

                <div class="form-group">
                    <label>Location</label>
                    <?php

                    if ($location_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $location_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }
                    ?>
                    <input type="text" class="form-control" name="location" placeholder="Enter the location"
                        value="<?php echo $location; ?>" required>
                </div><br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Enter the Date" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label style="font-size: 14px;">Time</label>
                        <select id="time" name="time" class="form-control">
                            <option value="09.00 a.m - 10.00 a.m">09.00 a.m - 10.00 a.m</option>
                            <option value="11.00 a.m - 12.00 p.m">11.00 a.m - 12.00 p.m</option>
                            <option value="01.00 p.m - 02.00 p.m">01.00 p.m - 02.00 p.m</option>
                            <option value="03.00 p.m - 04.00 p.m">03.00 p.m - 04.00 p.m</option>
                        </select>
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block myBtn" type="submit " name="submit">Add
                        Schedule</button>
                </div>

                <hr class="my-3" />

            </form>
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
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>