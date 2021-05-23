<?php
ob_start();

require_once 'admin-header.php';

$user_id = $_GET['user_id'];

$full_name = $uid =  $attempt = $location = $capacity = $date = $time ="";

$location_err = $username_err = $name_err = "";

$record_details = mysqli_query($link,"SELECT * FROM trial_exam WHERE user_id ='".$user_id."'");
$row_details = mysqli_fetch_assoc($record_details);

$record_result = mysqli_query($link,"SELECT * FROM trial_result WHERE user_id ='".$user_id."'");
$row_result = mysqli_fetch_assoc($record_result);

$_SESSION['attempt'] = $row_details['attempt'];

?>


<div class="right_col" role="main">
    <div class="row justify-content-center wrapper">
        <div class="col-lg-10 bg-white p-4 pt-12">
            <h4 class="text-center font-weight-bold">Schedule</h4>
            <hr class="my-3" />
            <div class="px-3 needs-validation">
                <div class="form-group">
                    <input type="number" class="form-control" name="uid" placeholder="Enter the location"
                        value="<?php echo $row_details['user_id']; ?>" hidden>
                </div><br>
                <div class="form-group">
                    <label>User Full Name</label>
                    <input type="text" class="form-control" name="full_name"
                        value="<?php echo $row_details['full_name']; ?>" disabled>
                </div><br>

                <div class="form-group">
                    <label>*Applied vehicle classes and their schedules are shown.</label>
                    <?php
                    $d1 = date_create("2000-01-01");
                    $d1 = date_format($d1,"Y-m-d");
                    if($row_details['date1'] !=null && $row_details['date1'] != $d1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "A1";?><img src="Header/production/images/1.png">
                            <br><?php echo "A ";?><img src="Header/production/images/22.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" disabled value="<?php echo $row_details['date1']?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <input type="text" class="form-control" disabled value="<?php echo $row_details['time1']?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" disabled
                                value="<?php echo $row_details['location1']?>">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['date2'] != null && $row_details['date2'] != $d1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "B1";?><img src="Header/production/images/3.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" disabled value="<?php echo $row_details['date2']?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <input type="text" class="form-control" disabled value="<?php echo $row_details['time2']?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" disabled
                                value="<?php echo $row_details['location2']?>">
                        </div>
                    </div><br>
                    <?php
                    }
                    if($row_details['date3'] != null && $row_details['date3'] != $d1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "B ";?><img src="Header/production/images/4.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" disabled value="<?php echo $row_details['date3']?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <input type="text" class="form-control" disabled value="<?php echo $row_details['time3']?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" disabled
                                value="<?php echo $row_details['location3']?>">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['date4'] != null && $row_details['date4'] != $d1){
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
                            <input type="date" class="form-control" disabled value="<?php echo $row_details['date4']?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <input type="text" class="form-control" disabled value="<?php echo $row_details['time4']?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" disabled
                                value="<?php echo $row_details['location4']?>">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['date5'] != null && $row_details['date5'] != $d1){
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
                            <input type="date" class="form-control" disabled value="<?php echo $row_details['date5']?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <input type="text" class="form-control" disabled value="<?php echo $row_details['time5']?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" disabled
                                value="<?php echo $row_details['location5']?>">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['date6'] != null && $row_details['date6'] != $d1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label style="color: blue;">Vehicle Class</label>
                            <br><?php echo "G1";?><img src="Header/production/images/11.png">
                            <br><?php echo "G ";?><img src="Header/production/images/12.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" disabled value="<?php echo $row_details['date6']?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <input type="text" class="form-control" disabled value="<?php echo $row_details['time6']?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" disabled
                                value="<?php echo $row_details['location6']?>">
                        </div>
                    </div><br>
                    <?php
                    }

                    if($row_details['date7'] != null && $row_details['date7'] != $d1){
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label style="color: blue;">Vehicle Class</label>
                            <br><br><?php echo "J ";?><img src="Header/production/images/13.png">
                        </div>
                        <div class="form-group col-md-4">
                            <label style="color: blue;">Date</label>
                            <input type="date" class="form-control" disabled value="<?php echo $row_details['date7']?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label style="color: blue;">Time</label>
                            <input type="text" class="form-control" disabled value="<?php echo $row_details['time7']?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label style="color: blue;">Location</label>
                            <input type="text" class="form-control" disabled
                                value="<?php echo $row_details['location7']?>">
                        </div>
                    </div>
                    <?php
                    }
                    $records = mysqli_query($link,"SELECT * FROM user_details WHERE user_id ='".$user_id."'");
                    $row = mysqli_fetch_assoc($records);

                    $records_result = mysqli_query($link,"SELECT * FROM trial_result WHERE user_id ='".$user_id."'");
                    $row_result = mysqli_fetch_assoc($records_result);
                    ?>

                    <br>
                    <hr class="my-3" />
                    <h4 class="text-center font-weight-bold">Add Results</h4>
                    <br>
                    <form action="Trial-Results-Upload.php" method="POST" class="px-3 needs-validation">
                        <div class="form-group">
                            <label>*Applied vehicle classes are shown.</label>
                            <input type="number" class="form-control" name="uid" placeholder="Enter the location"
                                value="<?php echo $row['user_id']; ?>" hidden>
                            <br>
                            <?php
                    if($row['A1'] == 1){
                    ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "A1";?><img src="Header/production/images/1.png">
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultA1" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                    }

                    if($row['A'] == 1){
                        ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "A ";?><img src="Header/production/images/22.png">
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultA" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                        }

                        if($row['B1'] == 1 ){
                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "B1";?><img src="Header/production/images/3.png">
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultB1" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                            }

                            if($row['B'] == 1 ){
                                ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "B ";?><img src="Header/production/images/4.png">
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultB" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                                }

                                if($row['C1'] == 1){
                                    ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "C1";?><img src="Header/production/images/5.png"><br>
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultC1" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                                    }

                                    if($row['C'] == 1){
                                        ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br> <?php echo "C ";?><img src="Header/production/images/6.png"><br>
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultC" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                                        }

                                        if($row['CE'] == 1){
                                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "CE";?><img src="Header/production/images/7.png"><br>
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultCE" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                                            }

                                            if($row['D1'] == 1 ){
                                                ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "D1";?><img src="Header/production/images/8.png"><br>
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultD1" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                                                }
                                    if($row['D'] == 1){
                                                    ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "D ";?><img src="Header/production/images/9.png"><br>
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultD" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                                    }

                                    if($row['DE'] == 1){
                                        ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "DE";?><img src="Header/production/images/10.png"><br>
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultDE" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                        }

                        if($row['G1'] == 1){
                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "G1";?><img src="Header/production/images/11.png">
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultG1" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                        }

                        if($row['G'] == 1){
                           ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><?php echo "G ";?><img src="Header/production/images/12.png">
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultG" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                        }

                        if($row['J'] == 1){
                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Vehicle Class</label>
                                    <br><br><?php echo "J ";?><img src="Header/production/images/13.png">
                                </div>

                                <div class="form-group col-md-2">
                                    <label style="color: blue;">Attempt</label>
                                    <br><input type="text" class="form-control" disabled value="1">
                                </div>

                                <div class="form-group col-md-4">
                                    <label style="color: blue;">Result</label>
                                    <select name="resultJ" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="Pass">Pass</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                            </div><br>
                            <?php
                         }

                    ?>
                        </div>

                        <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block myBtn" type="submit " name="submit">Update</button>
                </div>
                    </form>

                </div>

                <hr class="my-3" />

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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
    integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
    integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
</script>

<!-- jQuery -->
<script src="Header/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>



</body>

</html>