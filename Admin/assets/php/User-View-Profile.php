<?php
require_once 'admin-header.php'; 
require_once 'config.php';

$u_id = $_GET['user_id'];
$profile = mysqli_query($link,"SELECT * FROM users WHERE user_id ='".$u_id."'");
$row = mysqli_fetch_assoc($profile);

$view = mysqli_query($link,"SELECT * FROM user_details WHERE user_id ='".$u_id."'");
$row_one = mysqli_fetch_assoc($view);

$view_stat = mysqli_query($link,"SELECT * FROM written_exam WHERE user_id ='".$u_id."'");
$row_stat = mysqli_fetch_assoc($view_stat);
?>

<div class="right_col" role="main" style="font-size: 12px;">
    <div class="row justify-content-center wrapper" style="font-size: 14px;">
        <div class="col-lg-10 bg-white p-4">
            <div class="modal-header bg-info ">
            <h3 class="text-center font-weight-bold" style="color: white;text-align: center;">&nbsp;&nbsp;Profile</h3>
            </div>
            <hr class="my-3" />

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <?php
                    if($row['gender'] == "1"){?>
                                <img src="https://img.icons8.com/color/150/000000/user-male-circle--v1.png" />
                                <?php
                    }

                    else if($row['gender'] == "2"){?>
                                <img src="https://img.icons8.com/color/150/000000/user-female-circle--v1.png" />
                                <?php
                    }

                    else{?>
                                <img src="https://img.icons8.com/material-rounded/96/000000/user.png" />
                                <?php
                    }

                    ?>
                                <div class="mt-3">
                                    <h4><?php echo $row['user_name'] ?></h4>
                                    <p class="text-secondary mb-1">Registered for <?php echo $row['type'] ?> License</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalNew">Status&nbsp;<i class="fa fa-tasks" aria-hidden="true"></i></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalNew" tabindex="-1"
                                        aria-labelledby="exampleModalNewLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info" style="color: white;">
                                                    <h5 class="modal-title" id="exampleModalNewLabel">View Status</h5>
                                                    <button type="button" class="btn btn-info" data-bs-dismiss="modal" style="color: white;"
                                                        aria-label="Close">
                                                        <i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    Written Exam Status<br>
                                                    <table class="table table-striped table-hover"
                                                        style="font-size: 14px;">
                                                        <thead>
                                                            <tr>
                                                                <th>Attempt</th>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th>Result</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <td><?php echo $row_stat['attempt'];?></td>
                                                            <td><?php echo $row_stat['date'];?></td>
                                                            <td><?php echo $row_stat['time'];?></td>
                                                            <td><?php echo $row_stat['result'];?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Delete&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>

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
                                                    <a href="User-Delete.php?user_id=<?php echo $row['user_id']?>"><button
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
                                <span class="text-secondary"><?php echo $row['contact_no'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="fa fa-envelope" aria-hidden="true"></i> Email</h6>
                                <span class="text-secondary"><?php echo $row['user_email'] ?></span>
                            </li>
                            <!-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="fa fa-globe" aria-hidden="true"></i> Website</h6>
                                <span class="text-secondary">
                                    <?php
                                    if(empty($row['learners_website']))
                                    echo "-";

                                     echo $row['learners_website'] ?></span>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['full_name'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['user_name'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Gender</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php
                                    if($row['gender'] == "1")
                                    echo "Male" ;
                                    
                                    else if($row['gender'] == "2")
                                    echo "Female"; 
                                    
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row_one['address'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIC</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['nic'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Applied Vehicle Types</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php 
                                    if($row_one['A1'] == 1){
                                    echo "A1 ";
                                    ?><img src="Header/production/images/1.png"><br>
                                    <?php
                                    }

                                    if($row_one['A'] == 1){
                                    echo "A  ";
                                    ?><img src="Header/production/images/22.png"><br>
                                    <?php
                                    }

                                    if($row_one['B1'] == 1){
                                    echo "B1 ";
                                    ?><img src="Header/production/images/3.png"><br>
                                    <?php
                                    }

                                    if($row_one['B'] == 1){
                                    echo "B ";
                                    ?><img src="Header/production/images/4.png"><br>
                                    <?php
                                    }

                                    if($row_one['C1'] == 1){
                                    echo "C1 ";
                                    ?><img src="Header/production/images/5.png"><br>
                                    <?php
                                    }

                                    if($row_one['C'] == 1){
                                    echo "C ";
                                    ?><img src="Header/production/images/6.png"><br>
                                    <?php
                                    }

                                    if($row_one['CE'] == 1){
                                    echo "CE ";
                                    ?><img src="Header/production/images/7.png"><br>
                                    <?php
                                    }

                                    if($row_one['D1'] == 1){
                                    echo "D1 ";
                                    ?><img src="Header/production/images/8.png"><br>
                                    <?php
                                    }

                                    if($row_one['D'] == 1){
                                    echo "D ";
                                    ?><img src="Header/production/images/9.png"><br>
                                    <?php
                                    }

                                    if($row_one['DE'] == 1){
                                    echo "DE ";
                                    ?><img src="Header/production/images/10.png"><br>
                                    <?php
                                    }

                                    if($row_one['G1'] == 1){
                                    echo "G1 ";
                                    ?><img src="Header/production/images/11.png"><br>
                                    <?php
                                    }

                                    if($row_one['G'] == 1){
                                    echo "G ";
                                    ?><img src="Header/production/images/12.png"><br><br>
                                    <?php
                                    }

                                    if($row_one['J'] == 1){
                                    echo "J ";
                                    ?><img src="Header/production/images/13.png">
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