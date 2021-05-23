<?php
ob_start();

require_once 'includes/db.inc.php';
require_once 'Header.php';

$learners_id = $_SESSION["learnersid"];
$sql = "SELECT * FROM learners WHERE learners_id='" . $learners_id . "'";
$records = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($records);

$result3 = $link->query("SELECT learners_photo FROM learners WHERE  learners_id='" . $learners_id . "'");


$query_count = "SELECT  COUNT(learners_id) FROM users_learners WHERE  learners_id= '" . $learners_id . "'";
$q_result = mysqli_query($link, $query_count);
$row_count = mysqli_fetch_assoc($q_result);
$students = $row_count["COUNT(learners_id)"];



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $status = 'error';
    if (!empty($_FILES["edit_photo"]["name"])) {
        $uploadimg = "Image Selected";
        // Get file info 
        $fileName = basename($_FILES["edit_photo"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['edit_photo']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));


            $sql_img = "UPDATE learners SET learners_photo = '" . $imgContent . "' WHERE  learners_id='" . $learners_id. "'";
            $update_img = mysqli_query($link, $sql_img);

            if ($update_img) {
                $status = 'success';
                $uploadimg = "File uploaded successfully.";
                header("location: Dashboard.php");

            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select an image file to upload.';
    }

}
ob_end_flush();
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-deck mt-3 text-light text-center font-weight-bold">
                    <div class="card bg-primary">
                        <br>
                        <h4>Registered Users</h4>
                        <h3><?php echo $students; ?></h3>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="card border-secondary mb-3">
                    <h5 class="card-header d-flex justify-content-between">
                        <span class="lead align-self-center">Profile Details</span>
                        <a href="" data-toggle="modal" data-target="#EditProfileModal"><i class="fa fa-edit"></i></a>
                    </h5>

                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "invalidGender") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Invalid Gender! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "invaliduid") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Invalid username format! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "invalidFormat") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Invalid name format! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "invalidNIC") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Invalid NIC number! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "invalidNo") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Invalid contact number! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "invalidemail") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Invalid email format! </strong>
                    </div>


                    <?php } else if ($_GET["error"] == "emailtaken") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Email already taken! </strong>
                    </div>

                    <?php } else if ($_GET["error"] == "locationtaken") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while updating info: Location already taken! </strong>
                    </div>


                    <?php } else if ($_GET["error"] == "stmtfailed") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Server error! Please try again. </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "none") { ?>
                    <div class="alert alert-success alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Profile info updated successfully! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "missmatchpwd") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while changing password: Mismatched entries! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "samePWD") { ?>
                    <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Error while changing password: Old password cannot be new password! </strong>
                    </div>
                    <?php } else if ($_GET["error"] == "nonePWD") { ?>
                    <div class="alert alert-success alert-dismissible text-center mt-2 m-0">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong> Password changed successfully! </strong>
                    </div>
                    <?php }
                    } ?>

                    <?php
                    $id = $_SESSION["learnersid"];
                    $sql = "SELECT * FROM learners WHERE learners_id = $id;";
                    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                    $row = mysqli_fetch_assoc($result);
                    ?>

                    <div class="card-body text-secondary ">
                        <table class="table table-borderless">
                            <tbody>

                                <tr>
                                    <td>Driving School Name</td>
                                    <td><?php

                                        echo $row["learners_name"];

                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td><?php
                                        echo $row["learners_address"];
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Province</td>
                                    <td><?php
                                        echo $row["learners_province"];
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php
                                        echo $row["learners_email"];
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Contact Number</td>
                                    <td><?php
                                        echo $row["learners_contact"];
                                        ?></td>
                                </tr>

                                <tr>
                                    <?php if ($row["learners_website"] != null) { ?>

                                    <td>Web Site</td>
                                    <td><?php
                                            echo $row["learners_website"];
                                            ?>
                                    </td>
                                    <?php } ?>


                                </tr>

                                <tr>
                                    <td>Student Capacity</td>
                                    <td><?php
                                        echo $row["max_students"];
                                        ?></td>
                                </tr>

                                <tr>
                                    <td>Vehicle Types and Prices</td>
                                    <td>
                                        <a type="button" class="btn btn-light" data-toggle="modal"
                                            data-target="#typesPricesModal">
                                            <i class="fa fa-tags" aria-hidden="true"></i>View
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="typesPricesModal" tabindex="-1"
                                            aria-labelledby="typesPricesModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title" id="typesPricesModalLabel"
                                                            style="color: white;">Vehicle Types
                                                            & Prices
                                                        </h5>
                                                        <button type="button" class="btn btn-primary-close bg-primary"
                                                            data-dismiss="modal" aria-label="Close"
                                                            style="color: white;"><i class="fa fa-times"
                                                                aria-hidden="true"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>
                                                            <h6>Vehicle</h6>
                                                        </label>
                                                        <label style="float: right;">
                                                            <h6>Charge (Rs.)</h6>
                                                        </label><br>
                                                        <?php
                                        if ($row['vehicle1'] != null && $row['bike_P'] >0) { ?>

                                                        <label>Bike <i class="fa fa-motorcycle"
                                                                aria-hidden="true"></i></label>
                                                        <label
                                                            style="float: right; padding-right: 15px;"><?php echo $row['bike_P']; ?></label><br>

                                                        <?php } ?>

                                                        <?php if ($row['vehicle2'] != null && $row['threeWheeler_P'] >0) { ?>
                                                        <label>Three Wheeler <img style="width: 20px;"
                                                                src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /></label>
                                                        <label
                                                            style="float: right; padding-right: 15px;"><?php echo $row['threeWheeler_P']; ?></label><br>

                                                        <?php } ?>

                                                        <?php if ($row['vehicle3'] != null  && $row['car_P'] >0) { ?>
                                                        <label>Car <i class="fa fa-car" aria-hidden="true"></i></label>
                                                        <label
                                                            style="float: right; padding-right: 15px;"><?php echo $row['car_P']; ?></label><br>

                                                        <?php } ?>

                                                        <?php if ($row['vehicle4'] != null  && $row['van_P'] >0) { ?>
                                                        <label>Van <img style="width: 20px;"
                                                                src="https://img.icons8.com/ios-filled/50/000000/van.png" /></label>
                                                        <label
                                                            style="float: right; padding-right: 15px;"><?php echo $row['van_P']; ?></label><br>

                                                        <?php } ?>

                                                        <?php if ($row['vehicle5'] != null  && $row['truck_P'] >0) { ?>
                                                        <label>Truck <i class="fa fa-truck"
                                                                aria-hidden="true"></i></label>
                                                        <label
                                                            style="float: right; padding-right: 15px;"><?php echo $row['truck_P']; ?></label><br>

                                                        <?php } ?>
                                                        <?php if ($row['vehicle6'] != null  && $row['bus_P'] >0 ) { ?>
                                                        <label>Bus <i class="fa fa-bus" aria-hidden="true"></i></label>
                                                        <label
                                                            style="float: right; padding-right: 15px;"><?php echo $row['bus_P']; ?></label><br>

                                                        <?php } ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                                <tr>
                                    <td>Joined on</td>
                                    <td><?php
                                        echo $row["created_at"];
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-transparent">
                        <p class="text-right"><a href="" data-toggle="modal" data-target="#ChangePwdModal"
                                class="text-primary">Click
                                here to change password</a></p>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="card border-secondary mb-3">

                    <div class="card-body">


                        <div class="row">
                            <div class="profile_pic" style="margin-left:25%; align-content: center;">
                                <?php if ($result3->num_rows > 0 && $data['learners_photo'] != null) { ?>
                                <?php while ($row1 = $result3->fetch_assoc()) { ?>
                                <img style="border-radius: 50%; width: 180px; height:170px"
                                    src="data:learners_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row1['learners_photo']); ?>" />
                                <?php } ?>
                                <?php } else { ?>

                                <img src="Sidemenu/Header/production/images/admin.png" alt="..."
                                    style="border-radius: 50%; width: 140%;;">
                                <?php } ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 d-flex justify-content-center">
                                <form id="image_upload_form" enctype="multipart/form-data"
                                    action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <label class="btn btn-dark "
                                        onclick="document.getElementById('edit_photo').click()">
                                        <span><i class="fa fa-edit"></i></span></label>
                                    <input type='file' id="edit_photo" style="display:none" name="edit_photo"
                                        class="buttonimg">
                                </form>
                                <br>
                            </div>
                            <div class="col-4"></div>
                        </div>
                        <h4 style="margin-left: 25%;">
                            <?php
                            echo $row["learners_name"];
                            ?>
                        </h4>



                    </div>
                </div>

                <div class="card border-secondary mb-3">

                    <div class="card-body">
                        <?php
                        // Set your timezone
                        date_default_timezone_set('Asia/Colombo');

                        // Get prev & next month
                        if (isset($_GET['ym'])) {
                            $ym = $_GET['ym'];
                        } else {
                            // This month
                            $ym = date('Y-m');
                        }

                        // Check format
                        $timestamp = strtotime($ym . '-01');
                        if ($timestamp === false) {
                            $ym = date('Y-m');
                            $timestamp = strtotime($ym . '-01');
                        }

                        // Today
                        $today = date('Y-m-j', time());

                        // For H3 title
                        $html_title = date('Y / m', $timestamp);

                        // Create prev & next month link     mktime(hour,minute,second,month,day,year)
                        $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
                        $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));
                        // You can also use strtotime!
                        // $prev = date('Y-m', strtotime('-1 month', $timestamp));
                        // $next = date('Y-m', strtotime('+1 month', $timestamp));

                        // Number of days in the month
                        $day_count = date('t', $timestamp);

                        // 0:Sun 1:Mon 2:Tue ...
                        $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
                        //$str = date('w', $timestamp);


                        // Create Calendar!!
                        $weeks = array();
                        $week = '';

                        // Add empty cell
                        $week .= str_repeat('<td></td>', $str);

                        for ($day = 1; $day <= $day_count; $day++, $str++) {

                            $date = $ym . '-' . $day;

                            if ($today == $date) {
                                $week .= '<td class="today">' . $day;
                            } else {
                                $week .= '<td>' . $day;
                            }
                            $week .= '</td>';

                            // End of the week OR End of the month
                            if ($str % 7 == 6 || $day == $day_count) {

                                if ($day == $day_count) {
                                    // Add empty cell
                                    $week .= str_repeat('<td></td>', 6 - ($str % 7));
                                }

                                $weeks[] = '<tr>' . $week . '</tr>';

                                // Prepare for new week
                                $week = '';
                            }
                        }
                        ?>

                        <div class="container">

                            <style>
                            .today {
                                background: #15202c;
                                color: white;
                                font-weight: bold;
                            }
                            </style>
                            <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a
                                    href="?ym=<?php echo $next; ?>">&gt;</a></h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th>S</th>
                                    <th>M</th>
                                    <th>T</th>
                                    <th>W</th>
                                    <th>T</th>
                                    <th>F</th>
                                    <th>S</th>
                                </tr>
                                <?php
                                foreach ($weeks as $week) {
                                    echo $week;
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>





            </div>


        </div>
    </div>

    <!--Edit Profile modal start-->
    <div class="modal fade" id="EditProfileModal">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 45%;">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-light">Edit Profile Info</h6>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body ">
                    <form action="includes/editinfo.inc.php" method="post">
                        <div class="form-group">
                            <label>Driving School Name</label>
                            <input type="text" class="form-control" name="name" value="<?php
                                                                                        echo $row["learners_name"];

                                                                                        ?>" >
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Location</label>
                                <input type="text" class="form-control" name="location" value="<?php
                                                                                                echo $row["learners_address"];

                                                                                                ?>" >

                            </div>

                            <div class="form-group col-md-6">
                                <label>Province</label>
                                <select class="custom-select" name="province">
                                    <option selected><?php
                                                        echo $row["learners_province"];

                                                        ?> </option>
                                    <option value="Central Province">Central Province</option>
                                    <option value="Eastern Province">Eastern Province</option>
                                    <option value="North Central Province">North Central Province</option>
                                    <option value="Northern Province">Northern Province</option>
                                    <option value="North Western Province">North Western Province</option>
                                    <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                                    <option value="Southern Province">Southern Province</option>
                                    <option value="Uva Province">Uva Province</option>
                                    <option value="Western Province">Western Province</option>
                                </select>


                            </div>
                        </div>


                        <div class="form-row">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="contactNo" value="<?php
                                                                                            echo $row["learners_contact"];

                                                                                            ?>" >
                        </div>
                        <br>
                        <div class="form-row">

                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="<?php
                                                                                        echo $row["learners_email"];

                                                                                        ?>" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Web Site</label>
                            <input type="text" class="form-control" name="web_site" value="<?php
                                                                                            echo $row["learners_website"];

                                                                                            ?>">
                        </div>

                        <div class="form-group">
                            <label>Student Capacity</label>
                            <input type="number" class="form-control" name="capacity" value="<?php
                                                                                                echo $row["max_students"];

                                                                                                ?>" >
                        </div>


                        <div class="form-group">
                            <label style="font-size: 14px;">Vehicle Types (Please tick the values if the vehicle type is provided)</label>
                            <div class="form-row">
                                <div class="form-group col-md-4"><br><br>
                                    <input type="checkbox" name="vehicle1" value="Bike">
                                    <label>Bike <i class="fa fa-motorcycle" aria-hidden="true"></i></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price (Rs.)</label>
                                    <input type="number" class="form-control" name="bike_P" value="<?php echo $row['bike_P'] ?>">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-4"><br><br>
                                    <input type="checkbox" name="vehicle2" value="Three Wheeler">
                                    <label>Three Wheeler <img style="width: 20px;"
                                            src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price (Rs.)</label>
                                    <input type="number" class="form-control" name="threeWheeler_P" value="<?php echo $row['threeWheeler_P'] ?>">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-4"><br><br>
                                    <input type="checkbox" name="vehicle3" value="Car">
                                    <label>Car <i class="fa fa-car" aria-hidden="true"></i></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price (Rs.)</label>
                                    <input type="number" class="form-control" name="car_P" value="<?php echo $row['car_P'] ?>">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-4"><br><br>
                                    <input type="checkbox" name="vehicle4" value="Van">
                                    <label>Van <img style="width: 20px;"
                                            src="https://img.icons8.com/fluent-systems-filled/24/000000/van.png" />
                                    </label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price (Rs.)</label>
                                    <input type="number" class="form-control" name="van_P" value="<?php echo $row['van_P'] ?>">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-4"><br><br>
                                    <input type="checkbox" name="vehicle5" value="Truck">
                                    <label>Truck <i class="fa fa-truck" aria-hidden="true"></i></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price (Rs.)</label>
                                    <input type="number" class="form-control" name="truck_P" value="<?php echo $row['truck_P'] ?>">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="form-group col-md-4"><br><br>
                                    <input type="checkbox" name="vehicle6" value="Bus">
                                    <label>Bus <i class="fa fa-bus" aria-hidden="true"></i></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price (Rs.)</label>
                                    <input type="number" class="form-control" name="bus_P" value="<?php echo $row['bus_P'] ?>">
                                </div>
                            </div><br>

                        </div><br>


                </div>



                <div class="form-group row justify-content-center">
                    <button class="btn btn-dark" input type="submit " name="submit">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--edit profile modal end-->

<!--Password change modal -->
<div class="modal fade" id="ChangePwdModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-light">Change Password</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="includes/changePwd.inc.php" method="post">

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="npwd" placeholder="New Password" required />
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="nrpwd" placeholder="Confirm New Password"
                            required>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button class="btn btn-dark" input type="submit " name="submit">Change Password</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--Password change modal -->

</div>

</div>

<script>
document.getElementById("edit_photo").onchange = function() {
    document.getElementById("image_upload_form").submit();
};
</script>


<?php
require_once 'Footer.php';
?>