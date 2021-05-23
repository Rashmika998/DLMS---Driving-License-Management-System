<?php
require_once '../../includes/db.inc.php';
require_once 'newLicenseHeader.php';
$id = $_SESSION["userid"];
$l_id = $_GET['learners_id'];

$profile = mysqli_query($link,"SELECT * FROM learners WHERE learners_id ='".$l_id."'");
$row = mysqli_fetch_assoc($profile);
?>

<div class="right_col" role="main" style="font-size: 12px;">
    <div class="row justify-content-center wrapper" style="font-size: 14px;">
        <div class="col-lg-7 bg-white p-4">
        
            <h3 class="text-center font-weight-bold" translate='no'><?php echo $row['learners_name'] ?></h3>
            <?php $_SESSION['learners_name'] = $row['learners_name'] ?>
            <hr class="my-3" />
            
            <?php

                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "select") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> You've to select at least one package</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "stmtfailed") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> Something went wrong! cannot connect to the database. Please try again</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "none") {
                        echo "<div class= 'alert alert-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> Payment successful!</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "bikeAR") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> You've already registered to the Bike package</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "threeWheelerAR") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> You've already registered to the Three Wheeler package</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "carAR") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> You've already registered to the Car package</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "vanAR") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> You've already registered to the Van package</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "truckAR") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> You've already registered to the Truck package</strong>
                        </div>";
                    }
                    if ($_GET["error"] == "busAR") {
                        echo "<div class= 'alert alert-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong> You've already registered to the Bus package</strong>
                        </div>";
                    }
                }

            ?>

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="data:image/png;charset=utf8;base64, <?php echo base64_encode($row['learners_photo']);?>"
                                    alt="Learners Logo" width="150">
                                <div class="mt-3">
                                    <h4 translate='no'><?php echo $row['learners_name'] ?></h4>
                                    <p class="text-secondary mb-1">Driving School</p>
                                    <p class="text-muted font-size-sm"><?php echo $row['learners_address']  ?></p>
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Register</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info ">
                                                    <h6 class="modal-title text-light">Fill in the form to register to <?php echo $row['learners_name'] ?></h6>
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="LearnersRegister.php?learners_id=<?php echo $row['learners_id']?>" method="post">
                                                    <table class='table'>
                                                                <?php
                                                                    if(!empty($row['vehicle1'])){
                                                                ?>
                                                                    <tr>
                                                                    <td class="text-left"><input type="checkbox" value="1" name='bike'>&nbsp;&nbsp;Bike&nbsp;&nbsp;<i class="fa fa-motorcycle" aria-hidden="true"></i></td>
                                                                    <td>Rs  <?php echo $row['bike_P'] ?>.00</td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                    if(!empty($row['vehicle2'])){
                                                                ?>
                                                                    <tr>
                                                                    <td class="text-left"><input type="checkbox" value="1" name='threeWheeler'>&nbsp;&nbsp;Three Wheeler&nbsp;&nbsp;<img style="width: 20px;" src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /></td>
                                                                    <td>Rs  <?php echo $row['threeWheeler_P'] ?>.00</td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                    if(!empty($row['vehicle3'])){
                                                                ?>
                                                                <tr>
                                                                    <td class="text-left"><input type="checkbox" value="1" name='car'>&nbsp;&nbsp;Car&nbsp;&nbsp;<i class="fa fa-car" aria-hidden="true"></i></td>
                                                                    <td>Rs  <?php echo $row['car_P'] ?>.00</td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                    if(!empty($row['vehicle4'])){
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-left"><input type="checkbox" value="1" name='van'>&nbsp;&nbsp;Van&nbsp;&nbsp;<i class="fa fa-shuttle-van" aria-hidden="true"></i></td>
                                                                        <td>Rs  <?php echo $row['van_P'] ?>.00</td>
                                                                        </tr>
                                                                <?php
                                                                }
                                                                    if(!empty($row['vehicle5'])){
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-left"><input type="checkbox" value="1" name='truck'>&nbsp;&nbsp;Truck&nbsp;&nbsp;<i class="fa fa-truck" aria-hidden="true"></i></td>
                                                                        <td>Rs  <?php echo $row['truck_P'] ?>.00</td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                    if(!empty($row['vehicle6'])){
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-left"><input type="checkbox" value="1" name='bus'>&nbsp;&nbsp;Bus&nbsp;&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></td>
                                                                        <td>Rs  <?php echo $row['bus_P'] ?>.00</td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                    </table>
                                                    <p>Please select the package(s) you wish to register for, by selecting the corresponding check box(es).</p>
                                                </div>
                                                <div class="modal-footer">
                                                <?php $_SESSION['learners_id'] = $row['learners_id']; ?>
                                                <button type="submit" name='submit' class="btn btn-success">Register</button>
                                                </form>
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
                                <div class="col-sm-9 text-secondary" translate='no'>
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
                                    <h6 class="mb-0">Contact No</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['learners_contact'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $row['learners_email'] ?>
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
                              <table class='table'>
                                <thead class='table-info text-center'>
                                    <tr class='text-center'>
                                        <th class='text-center' colspan="2" >Available Vehicle Types and Package Prices</th>
                                    </tr>
                                </thead>
                                    <?php
                                        if(!empty($row['vehicle1'])){
                                    ?>
                                        <tr>
                                        <td>&nbsp;&nbsp;Bike&nbsp;&nbsp;<i class="fa fa-motorcycle" aria-hidden="true"></i></td>
                                        <td>Rs  <?php echo $row['bike_P'] ?>.00</td>
                                        </tr>
                                    <?php
                                    }
                                        if(!empty($row['vehicle2'])){
                                    ?>
                                        <tr>
                                        <td>&nbsp;&nbsp;Three Wheeler&nbsp;&nbsp;<img style="width: 20px;" src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /></td>
                                        <td>Rs  <?php echo $row['threeWheeler_P'] ?>.00</td>
                                        </tr>
                                    <?php
                                    }
                                        if(!empty($row['vehicle3'])){
                                    ?>
                                    <tr>
                                        <td>&nbsp;&nbsp;Car&nbsp;&nbsp;<i class="fa fa-car" aria-hidden="true"></i></td>
                                        <td>Rs  <?php echo $row['car_P'] ?>.00</td>
                                        </tr>
                                    <?php
                                    }
                                        if(!empty($row['vehicle4'])){
                                    ?>
                                        <tr>
                                            <td translate="no">&nbsp;&nbsp;Van&nbsp;&nbsp;<i class="fa fa-shuttle-van" aria-hidden="true"></i></td>
                                            <td>Rs  <?php echo $row['van_P'] ?>.00</td>
                                            </tr>
                                    <?php
                                    }
                                        if(!empty($row['vehicle5'])){
                                    ?>
                                        <tr>
                                            <td>&nbsp;&nbsp;Truck&nbsp;&nbsp;<i class="fa fa-truck" aria-hidden="true"></i></td>
                                            <td>Rs  <?php echo $row['truck_P'] ?>.00</td>
                                        </tr>
                                    <?php
                                    }
                                        if(!empty($row['vehicle6'])){
                                    ?>
                                        <tr>
                                            <td>&nbsp;&nbsp;Bus&nbsp;&nbsp;<i class="fa fa-bus" aria-hidden="true"></i></td>
                                            <td>Rs  <?php echo $row['bus_P'] ?>.00</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                <tbody>
                                </tbody>
                              </table>
                              <p>Select the package(s) you want to register for, after clicking the register button</p>
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
</div>
<?php
require_once 'footer.php';
?>