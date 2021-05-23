<?php
ob_start();

require_once 'admin-header.php';

$user_id = $_GET['user_id'];

$full_name = $uid =  $attempt = $location = $capacity = $date = $time ="";

$location_err = $username_err = $name_err = "";

$records = mysqli_query($link,"SELECT * FROM written_exam WHERE user_id ='".$user_id."'");
$row = mysqli_fetch_assoc($records);

?>


<div class="right_col" role="main">
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4 pt-12">
            <h4 class="text-center font-weight-bold">View Schedule</h4>
            <hr class="my-3" />
            <div class="px-3 needs-validation">
                <div class="form-group">
                    <input type="number" class="form-control" name="uid" placeholder="Enter the location"
                        value="<?php echo $row['user_id']; ?>" hidden>
                </div><br>
                <div class="form-group">
                    <label>User Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name']; ?>"
                        disabled>
                </div><br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Attempt</label>
                        <input type="text" class="form-control" name="attempt" value="<?php echo $row['attempt']; ?>"
                            disabled>
                    </div><br>

                    <div class="form-group col-md-6">
                        <label>Location Capacity</label>
                        <input type="number" class="form-control" name="capacity"
                            value="<?php echo $row['capacity']; ?>" disabled>
                    </div><br>
                </div><br>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location" value="<?php echo $row['location']; ?>"
                        disabled>
                </div><br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="<?php echo $row['date']; ?>"
                            disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label style="font-size: 14px;">Time</label>
                        <input type="text" class="form-control" name="time" value="<?php echo $row['time']; ?>"
                            disabled>
                    </div>
                </div>

                <br>
                <hr class="my-3" />
                <h4 class="text-center font-weight-bold">Add Results</h4>
                <br>
                <label style="font-size: 14px;">*Click the Buttons according to the Results</label>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <button class="btn btn-success btn-lg btn-block myBtn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal1">Pass</button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Results</h5>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to add Pass as the result?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="Written-Results-Pass.php?user_id=<?php echo $row['user_id']?>"><button
                                                type="button" class="btn btn-success">Yes</button></a>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-md-6">
                        <button class="btn btn-danger btn-lg btn-block myBtn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal2">Fail</button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Results</h5>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to add Fail as the result?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="Written-Results-Fail.php?user_id=<?php echo $row['user_id']?>"><button
                                                type="button" class="btn btn-danger">Yes</button></a>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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