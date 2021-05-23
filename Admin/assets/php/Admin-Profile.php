<?php
ob_start();

require_once 'admin-header.php';

if (!isset($_SESSION['loggedin_admin'])) {
    header('Location: Admin-Login.php');
    exit;
}

// Define variables and initialize with empty values
$result = $link->query("SELECT admin_photo FROM admin WHERE  admin_id='" . $data['admin_id'] . "'");

$admin_name = $admin_email = $admin_cpassword = $admin_npassword = $admin_cnpassword = "";
$name_err = $email_err = $username_err = $cpassword_err = $npassword_err = $cnpassword_err = "";
$status = $statusMsg = $uploadimg = ""; 

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['form1'])) {

        // Validate Admin Name
        if (empty(trim($_POST["admin_name"]))) {
            $name_err = "Please enter a name.";
        } else {

            // Prepare a select statement
            $sql = "SELECT admin_id FROM admin WHERE admin_name = ?";

            if ($stmt = $link->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_name);

                // Set parameters
                $param_name = trim($_POST["admin_name"]);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    /* store result */
                    $stmt->store_result();

                    if ($stmt->num_rows() >= 1 && $_POST["admin_name"] != $data['admin_name']) {
                        $name_err = "This admin already has an account!";
                    } else {
                        $admin_name = trim($_POST["admin_name"]);
                    }
                } else {
                    echo "Oops! Something went wrong when inserting name. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }



        //validate email
        if (empty(trim($_POST["admin_email"]))) {
            $email_err = "Please enter an email address!";
        } else {
            $admin_email = trim($_POST["admin_email"]);
            $admin_email = stripslashes($admin_email);
            $admin_email = htmlspecialchars($admin_email);
            if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format";
            } else {
                // Prepare a select statement
                $sql = "SELECT admin_id FROM admin WHERE admin_email = ?";

                if ($stmt = $link->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("s", $param_email);

                    // Set parameters
                    $param_email = $admin_email;

                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        /* store result */
                        $stmt->store_result();

                        if ($stmt->num_rows() >= 1 && $admin_email != $data['admin_email']) {
                            $email_err = "This Email is already taken.";
                        } else {
                            $admin_email = trim($_POST["admin_email"]);
                        }
                    } else {
                        echo "Oops! Something went wrong when inserting email. Please try again later.";
                    }

                    // Close statement
                    $stmt->close();
                }
            }
        }


        // Check input errors before inserting in database
        if (empty($name_err) && empty($email_err)) {


            // Prepare an insert statement
            $sql = "UPDATE admin SET admin_name = '" . $admin_name . "', admin_email = '" . $admin_email . "'  WHERE  admin_id='" . $data['admin_id'] . "'";
            $update = mysqli_query($link, $sql);


            if ($update) {

                header("Location: Admin-Updated.php");
            } else {
                echo "Something went wrong when executing. Please try again later.";
            }
        }

        // Close connection
        $link->close();
    }

    if (isset($_POST['form2'])) {
        // Check if current password is empty
        if (empty(trim($_POST["admin_cpass"]))) {

            $cpassword_err = "Please enter the current password.";
        } else {
            $admin_cpassword = trim($_POST["admin_cpass"]);
            if (password_hash($admin_cpassword,PASSWORD_DEFAULT) != $data['admin_password']) {
                $cpassword_err = "The password  entered is not valid.";
            }
        }

        // Check if new password is empty
        if (empty(trim($_POST["admin_npass"]))) {

            $npassword_err = "Please enter new password.";
        } else {
            $admin_npassword = trim($_POST["admin_npass"]);
        }

        // Check if confirmed password is empty

        if (empty(trim($_POST["admin_cnpass"]))) {

            $cnpassword_err = "Please confirm new password.";
        } else {
            $admin_cnpassword = trim($_POST["admin_cnpass"]);
        }


        if ($admin_cnpassword != $admin_npassword && $admin_cnpassword != null && $admin_npassword != null) {
            $cnpassword_err = "Passwords didn't match";
        }



        if (empty($cnpassword_err) && empty($cnpassword_err) && empty($cpassword_err)) {

            $hashPass = password_hash($admin_npassword,PASSWORD_DEFAULT);
            // Prepare an insert statement
            $sql = "UPDATE admin SET admin_password = '" . $hashPass . "' WHERE  admin_id='" . $data['admin_id'] . "'";
            $update = mysqli_query($link, $sql);


            if ($update) {

                header("Location: Admin-Updated.php");
            } else {
                echo "Something went wrong when executing. Please try again later.";
            }
        }


        // Close connection
        $link->close();
    }


    if (isset($_POST['form3'])) {

        $status = 'error';
        if (!empty($_FILES["admin_photo"]["name"])) {
            $uploadimg = "Image Selected";
            // Get file info 
            $fileName = basename($_FILES["admin_photo"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            // Allow certain file formats 
            $allowTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowTypes)) {
                $image = $_FILES['admin_photo']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));


                $sql = "UPDATE admin SET admin_photo = '" . $imgContent . "' WHERE  admin_id='" . $data['admin_id'] . "'";
                $update = mysqli_query($link, $sql);

                if ($update) {
                    $status = 'success';
                    $uploadimg = "File uploaded successfully.";
                    header("location: Admin-Profile.php");
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select an image file to upload.';
        }

        $link->close();

    }
}

ob_end_flush();



?>

<!-- page content -->
<div class="right_col " role="main">

    <div class="container">
        <div class="row flex-lg-nowrap">

            <div class="col">
                <div class="row">

                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div id="changeProfile"></div>

                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">

                                                <div class="d-flex justify-content-center align-items-center rounded"
                                                    style="height: 140px; background-color: rgb(233, 236, 239);">
                                                    <?php
                                                 
                                                if ($result->num_rows > 0 && $data['admin_photo']!=null) { ?>
                                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                                    <img style="width: 140px;"
                                                        src="data:admin_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row['admin_photo']); ?>" />
                                                    <?php } ?>
                                                    <?php } 
                                                    
                                                    else { ?>
                                                    <img style="width: 140px;" src="Header/production/images/admin.png"
                                                        alt="...">
                                                    <?php } ?>
                                                </div>


                                                <form action="#" method="POST" enctype="multipart/form-data"
                                                    id="profile-photo-form">
                                                    <input type="hidden" name="form3" value="Update">
                                                    <div class="d-flex justify-content-center align-items-center rounded containerimg"
                                                        style="margin-bottom: 1%;">



                                                        <label class="btn btn-primary buttonimg"
                                                            onclick="document.getElementById('admin_photo').click()">
                                                            <span><i class="fa fa-edit"></i></span></label>
                                                        <input type='file' id="admin_photo" style="display:none"
                                                            name="admin_photo" class="buttonimg">
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $data['admin_name']; ?>
                                                </h4>
                                                <p class="mb-0">@<?= $data['admin_username']; ?></p>
                                                <div class="row">

                                                    <div class="mt-2">

                                                        <label class="btn btn-primary picbtn"
                                                            onclick="document.getElementById('profilePhoto').click()"><i
                                                                class="fa fa-fw fa-camera"></i>
                                                            <span>Change Photo</span></label>
                                                        <input type='submit' id="profilePhoto" style="display:none"
                                                            name="image">

                                                    </div>


                                                </div>

                                                <?php

                                                if ($statusMsg != null) {
                                                    echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                                                    echo $statusMsg;
                                                    echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                                                }

                                                if ($uploadimg != null) {
                                                    echo '<br/> <div class="alert alert-success alert-dismissible fade show" role="alert" ><strong>';
                                                    echo $uploadimg;
                                                    echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                                                }

                                                ?>


                                                </form>

                                            </div>
                                            <div class="text-center text-sm-right">
                                                <span class="badge badge-secondary">administrator</span>
                                                <div class="text-muted"><small>Joined
                                                        <?= date('d M Y', strtotime($data['created_at'])); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="mb-2"><b>Update Profile</b></div>

                                        <?php

                                        if ($name_err != null) {
                                            echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                                            echo $name_err;
                                            echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                                        }


                                        if ($email_err != null) {
                                            echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                                            echo $email_err;
                                            echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                                        }


                                        ?>


                                        <div class="tab-pane active">

                                            <form class="form" method="POST"
                                                action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form">
                                                <input type="hidden" name="form1" value="Update">

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input class="form-control" type="text"
                                                                        name="admin_name"
                                                                        value=<?= $data['admin_name']; ?>
                                                                        id="admin_name">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input class="form-control" type="text"
                                                                        name="admin_username"
                                                                        value=<?= $data['admin_username']; ?>
                                                                        onkeydown="return false">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control" type="text"
                                                                        name="admin_email"
                                                                        value=<?= $data['admin_email']; ?>
                                                                        id="admin_eemail"
                                                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col d-flex justify-content">
                                                                <input type="submit" name="profile_update"
                                                                    value="Save Changes" class="btn btn-success savebtn"
                                                                    id="ProfileUpdateBtn">
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                                <br>
                                            </form>

                                            <form class="form" method="POST" action="#" novalidate=""
                                                id="password-update-form">
                                                <input type="hidden" name="form2" value="UpdatePass">

                                                <div class="row">
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <div class="mb-2"><b>Change Password</b></div>
                                                        <div class="row" id="changePassErr">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Current Password</label>
                                                                    <input class="form-control" type="password"
                                                                        placeholder="Current Password"
                                                                        name="admin_cpass" id="admin_cpass">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <input class="form-control" type="password"
                                                                        placeholder="New Password" name="admin_npass"
                                                                        id="admin_npass">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Confirm <span
                                                                            class="d-none d-xl-inline">Password</span></label>
                                                                    <input class="form-control" type="password"
                                                                        placeholder="Re-Enter Password"
                                                                        name="admin_cnpass" id="admin_cnpass">
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>

                                                </div>

                                                <?php

                                                if ($cpassword_err) {
                                                    echo '<div class="alert alert-danger alert-dismissible fade show " role="alert" ><strong>';
                                                    echo $cpassword_err;
                                                    echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                                                }


                                                if ($npassword_err != null) {
                                                    echo '<div class="alert alert-danger alert-dismissible fade show " role="alert" ><strong>';
                                                    echo $npassword_err;
                                                    echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                                                }

                                                if ($cnpassword_err != null) {
                                                    echo ' <div class="alert alert-danger alert-dismissible fade show " role="alert" ><strong>';
                                                    echo $cnpassword_err;
                                                    echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                                                }


                                                ?>

                                                <div class="row">


                                                    <div class="col d-flex justify-content">

                                                        <input type="submit" name="password_update"
                                                            value="Reset Password" class="btn btn-success savebtn"
                                                            id="PasswordUpdateBtn">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>