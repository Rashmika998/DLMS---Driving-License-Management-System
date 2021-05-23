<?php

require_once 'admin-header.php'; 

$user_id = $_GET['user_id'];

$full_name = $uid =  $attempt = $location = $capacity = $date = $time ="";

$location_err = $username_err = $name_err = "";

$records = mysqli_query($link,"SELECT * FROM users WHERE user_id ='".$user_id."'");
$row = mysqli_fetch_assoc($records);
$_SESSION['full_name'] = $row['full_name'];
$_SESSION['nic'] = $row['nic'];

$details = mysqli_query($link,"SELECT * FROM user_details WHERE user_id ='".$user_id."'");
$row_details = mysqli_fetch_assoc($details);

$new_records = mysqli_query($link,"SELECT * FROM written_payment WHERE user_id ='".$user_id."'");
$one_row = mysqli_fetch_assoc($new_records);

$_SESSION['attempt'] = $one_row['attempt'];

?>


<div class="right_col" role="main">
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4 pt-12">
            <h4 class="text-center font-weight-bold">Add Schedule For Trial Exam</h4>
            <hr class="my-3" />
            <form action="Trial-Schedule-Upload.php" method="POST" class="px-3 needs-validation" >
                <div class="form-group">
                    <input type="number" class="form-control" name="uid" 
                        value="<?php echo $row['user_id']; ?>" hidden>
                </div><br>
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" class="form-control" name="user_name" placeholder="Enter User Name"
                        value="<?php echo $row['user_name']; ?>" disabled>
                </div><br>

                <div class="form-group">
                    <label>User Full Name</label>
                    <input type="text" class="form-control" name="full_name" placeholder="Enter Full Name"
                        value="<?php echo $row['full_name']; ?>" disabled>
                </div><br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Attempt</label>
                        <input type="text" class="form-control" name="attempt" value="<?php echo $one_row['attempt'];?>" disabled>
                    </div><br>
                    <div class="form-group col-md-6">
                        <label>NIC</label>
                        <input type="text" class="form-control" name="nic" value="<?php echo $row['nic']; ?>" disabled>
                    </div>
                </div><br><br>

                <div class="form-group">
                    <label>*Date and time allocation for the applied vehicle classes. Applied vehicle classes are shown.</label>
                    <?php
                    if($row_details['A1'] == 1 || $row_details['A'] == 1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                        <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "A1";?><img src="Header/production/images/1.png">
                            <br><?php echo "A ";?><img src="Header/production/images/22.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" name="date1" placeholder="Enter the Date">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <select id="time1" name="time1" class="form-control">
                                <option value="08.30 a.m - 10.30 a.m">08.30 a.m - 10.30 a.m</option>
                                <option value="10.30 a.m - 12.30 p.m">10.30 a.m - 12.30 p.m</option>
                                <option value="01.30 p.m - 03.30 p.m">01.30 p.m - 03.30 p.m</option>
                                <option value="03.30 p.m - 05.30 p.m">03.30 p.m - 05.30 p.m</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" name="location1" placeholder="Location">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['B1'] == 1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                        <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "B1";?><img src="Header/production/images/3.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" name="date2" placeholder="Enter the Date">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <select id="time2" name="time2" class="form-control">
                                <option value="08.30 a.m - 10.30 a.m">08.30 a.m - 10.30 a.m</option>
                                <option value="10.30 a.m - 12.30 p.m">10.30 a.m - 12.30 p.m</option>
                                <option value="01.30 p.m - 03.30 p.m">01.30 p.m - 03.30 p.m</option>
                                <option value="03.30 p.m - 05.30 p.m">03.30 p.m - 05.30 p.m</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" name="location2" placeholder="Location">
                        </div>
                    </div><br>
                    <?php
                    }
                    if($row_details['B'] == 1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                        <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "B ";?><img src="Header/production/images/4.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" name="date3" placeholder="Enter the Date">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <select id="time3" name="time3" class="form-control">
                                <option value="08.30 a.m - 10.30 a.m">08.30 a.m - 10.30 a.m</option>
                                <option value="10.30 a.m - 12.30 p.m">10.30 a.m - 12.30 p.m</option>
                                <option value="01.30 p.m - 03.30 p.m">01.30 p.m - 03.30 p.m</option>
                                <option value="03.30 p.m - 05.30 p.m">03.30 p.m - 05.30 p.m</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" name="location3" placeholder="Location">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['C1'] == 1 || $row_details['C'] == 1 || $row_details['CE'] == 1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                        <label style="color: blue;">Vehicle Class</label><br>
                            <?php echo "C1";?><img src="Header/production/images/5.png"><br>
                            <?php echo "C ";?><img src="Header/production/images/6.png"><br>
                            <?php echo "CE";?><img src="Header/production/images/7.png"><br>
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" name="date4" placeholder="Enter the Date">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <select id="time4" name="time4" class="form-control">
                                <option value="08.30 a.m - 10.30 a.m">08.30 a.m - 10.30 a.m</option>
                                <option value="10.30 a.m - 12.30 p.m">10.30 a.m - 12.30 p.m</option>
                                <option value="01.30 p.m - 03.30 p.m">01.30 p.m - 03.30 p.m</option>
                                <option value="03.30 p.m - 05.30 p.m">03.30 p.m - 05.30 p.m</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" name="location4" placeholder="Location">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['D1'] == 1 || $row_details['D'] == 1 || $row_details['DE'] == 1){
                       ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                        <label style="color: blue;">Vehicle Class</label><br>
                            <?php echo "D1";?><img src="Header/production/images/8.png"><br>
                            <?php echo "D ";?><img src="Header/production/images/9.png"><br>
                            <?php echo "DE";?><img src="Header/production/images/10.png"><br>
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" name="date5" placeholder="Enter the Date">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <select id="time5" name="time5" class="form-control">
                                <option value="08.30 a.m - 10.30 a.m">08.30 a.m - 10.30 a.m</option>
                                <option value="10.30 a.m - 12.30 p.m">10.30 a.m - 12.30 p.m</option>
                                <option value="01.30 p.m - 03.30 p.m">01.30 p.m - 03.30 p.m</option>
                                <option value="03.30 p.m - 05.30 p.m">03.30 p.m - 05.30 p.m</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" name="location5" placeholder="Location">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['G1'] == 1 || $row_details['G'] == 1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                        <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "G1";?><img src="Header/production/images/11.png">
                            <br><?php echo "G ";?><img src="Header/production/images/12.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" name="date6" placeholder="Enter the Date">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <select id="time6" name="time6" class="form-control">
                                <option value="08.30 a.m - 10.30 a.m">08.30 a.m - 10.30 a.m</option>
                                <option value="10.30 a.m - 12.30 p.m">10.30 a.m - 12.30 p.m</option>
                                <option value="01.30 p.m - 03.30 p.m">01.30 p.m - 03.30 p.m</option>
                                <option value="03.30 p.m - 05.30 p.m">03.30 p.m - 05.30 p.m</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" name="location6" placeholder="Location">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['J'] == 1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                        <label style="color: blue;">Vehicle Class</label>
                            <br><br><?php echo "J ";?><img src="Header/production/images/13.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" name="date7" placeholder="Enter the Date">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <select id="time7" name="time7" class="form-control">
                                <option value="08.30 a.m - 10.30 a.m">08.30 a.m - 10.30 a.m</option>
                                <option value="10.30 a.m - 12.30 p.m">10.30 a.m - 12.30 p.m</option>
                                <option value="01.30 p.m - 03.30 p.m">01.30 p.m - 03.30 p.m</option>
                                <option value="03.30 p.m - 05.30 p.m">03.30 p.m - 05.30 p.m</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" name="location7" placeholder="Location">
                        </div>
                    </div>
                    <?php
                    }

                    ?>
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


<style>
    label{
        font-size: 13px;
    }
    </style>
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