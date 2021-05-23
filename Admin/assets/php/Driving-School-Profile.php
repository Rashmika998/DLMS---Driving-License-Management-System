<?php
require_once 'admin-header.php'; 
require_once 'config.php';

$l_id = $_GET['learners_id'];
$profile = mysqli_query($link,"SELECT * FROM learners WHERE learners_id ='".$l_id."'");
$row = mysqli_fetch_assoc($profile);
?>

<div class="right_col" role="main" style="font-size: 12px;">
    <div class="row justify-content-center wrapper" style="font-size: 14px;">
        <div class="col-lg-10 bg-white p-4">
            <h3 class="text-center font-weight-bold"><?php echo $row['learners_name'] ?></h3>
            <hr class="my-3" />

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="data:image/png;charset=utf8;base64, <?php echo base64_encode($row['learners_photo']);?>"
                                    alt="Learners Logo" width="150">
                                <div class="mt-3">
                                    <h4><?php echo $row['learners_name'] ?></h4>
                                    <p class="text-secondary mb-1">Driving School</p>
                                    <p class="text-muted font-size-sm"><?php echo $row['learners_address']  ?></p>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Delete Account&nbsp;<i class="fa fa-trash"
                                            aria-hidden="true"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this account?
                                                </div>
                                                <div class="modal-footer">
                                                    <a
                                                        href="Learners-Delete.php?learners_id=<?php echo $row['learners_id']?>"><button
                                                            type="button" class="btn btn-danger">Yes</button></a>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="fa fa-phone" aria-hidden="true"></i> Contact</h6>
                                <span class="text-secondary"><?php echo $row['learners_contact'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
                                <span class="text-secondary"><?php echo $row['learners_email'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="fa fa-globe" aria-hidden="true"></i> Website</h6>
                                <span class="text-secondary">
                                    <?php
                                    if(empty($row['learners_website']))
                                    echo "-";

                                     echo $row['learners_website'] ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['learners_name'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Location</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['learners_address'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Capacity</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['max_students'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vehicle Types</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                if(!empty($row['vehicle1'])){
                                    ?>
                                    <?php echo $row['vehicle1'] ?>&nbsp;&nbsp;<i class="fa fa-motorcycle"
                                        aria-hidden="true"></i><br>
                                    <?php
                                }

                                if(!empty($row['vehicle2'])){
                                    ?>
                                    <?php echo $row['vehicle2'] ?>&nbsp;&nbsp;<img style="width: 20px;"
                                        src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /><br>
                                    <?php
                                }

                                if(!empty($row['vehicle3'])){
                                    ?>
                                    <?php echo $row['vehicle3'] ?>&nbsp;&nbsp;<i class="fa fa-car"
                                        aria-hidden="true"></i><br>
                                    <?php
                                }

                                if(!empty($row['vehicle4'])){
                                    ?>
                                    <?php echo $row['vehicle4'] ?>&nbsp;&nbsp;<i class="fas fa-shuttle-van"
                                        aria-hidden="true"></i></i><br>
                                    <?php
                                }

                                if(!empty($row['vehicle5'])){
                                    ?>
                                    <?php echo $row['vehicle5'] ?>&nbsp;&nbsp;<i class="fa fa-truck"
                                        aria-hidden="true"></i><br>
                                    <?php
                                }

                                if(!empty($row['vehicle6'])){
                                    ?>
                                    <?php echo $row['vehicle6'] ?>&nbsp;&nbsp;<i class="fa fa-bus"
                                        aria-hidden="true"></i><br>
                                    <?php
                                }
                
                                 ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Joined</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['created_at'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalp">Click Here to View Prices&nbsp;
                    <i class="fa fa-star" aria-hidden="true"></i></button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalp" tabindex="-1" aria-labelledby="exampleModalLabelp"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h4 class="modal-title" id="exampleModalLabelp"> Prices</h4>
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i></button>
                                </div>
                                <div class="modal-body">
                                   
                                    <?php
                                if(!empty($row['vehicle1'])){
                                    ?>
                                    <?php echo $row['vehicle1']; ?>&nbsp;&nbsp;<i class="fa fa-motorcycle"
                                        aria-hidden="true"></i>
                                        <div style="float: right;padding-right: 10px;">
                                    <?php echo ("Rs.".$row['bike_P']."/=");?></div>    
                                        <br><br>
                                    <?php
                                }

                                if(!empty($row['vehicle2'])){
                                    ?>
                                    <?php echo $row['vehicle2'] ?>&nbsp;&nbsp;<img style="width: 20px;"
                                        src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" />
                                        <div style="float: right;padding-right: 10px;">
                                    <?php echo ("Rs.".$row['threeWheeler_P']."/=");?></div>  <br><br>
                                    <?php
                                }

                                if(!empty($row['vehicle3'])){
                                    ?>
                                    <?php echo $row['vehicle3'] ?>&nbsp;&nbsp;<i class="fa fa-car"
                                        aria-hidden="true"></i>
                                        <div style="float: right;padding-right: 10px;">
                                    <?php echo ("Rs.".$row['car_P']."/=");?></div>  
                                    <br><br>
                                    <?php
                                }

                                if(!empty($row['vehicle4'])){
                                    ?>
                                    <?php echo $row['vehicle4'] ?>&nbsp;&nbsp;<i class="fas fa-shuttle-van"
                                        aria-hidden="true"></i>
                                        <div style="float: right;padding-right: 10px;">
                                    <?php echo ("Rs.".$row['van_P']."/=");?></div>  
                                    <br><br>
                                    <?php
                                }

                                if(!empty($row['vehicle5'])){
                                    ?>
                                    <?php echo $row['vehicle5'] ?>&nbsp;&nbsp;<i class="fa fa-truck"
                                        aria-hidden="true"></i>
                                        <div style="float: right;padding-right: 10px;">
                                    <?php echo ("Rs.".$row['truck_P']."/=");?></div>  
                                    <br><br>
                                    <?php
                                }

                                if(!empty($row['vehicle6'])){
                                    ?>
                                    <?php echo $row['vehicle6'] ?>&nbsp;&nbsp;<i class="fa fa-bus"
                                        aria-hidden="true"></i>
                                        <div style="float: right;padding-right: 10px;">
                                    <?php echo ("Rs.".$row['bus_P']."/=");?></div>  
                                    <br><br>
                                    <?php
                                }
                
                                 ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>

    <?php
require_once 'admin-footer.php'; 
?>