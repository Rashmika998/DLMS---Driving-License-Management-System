<?php
require_once 'renewalHeader.php';
require_once 'db.inc.php';
if (!isset($_SESSION["useruid"])) {
    header('location: ../User/login.php');
}

$id=$_SESSION["userid"];

$_SESSION['amount']=500;
$_SESSION['Title']='Pay the required amount to complete the renewal';
$askToPay="<li><a href='../Paypage/renewalpaypage.php'> Click here </a> to pay the renewal fee</li>";

//check whether user paid or not
$sql = "SELECT * FROM renewal_payment WHERE user_id = $id;";
$result = mysqli_query($link, $sql) or die( mysqli_error($link));
while ($row = mysqli_fetch_assoc($result)) 
{
    if ($row['amount'] == 500 && ($row['paid'] == 'Yes' ))
    {
        $askToPay="";//user paid registration fee
    }
  
}

?>



<!-- page content -->
<div class="right_col" role="main">
<div class="row">
<div class="col-11 mx-auto">
<?php 

      //checking application status
      $sql_is = "SELECT *  FROM user_details_renewal WHERE user_id = $id";
      $result_is = mysqli_query($link, $sql_is) or die( mysqli_error($link));
      while ($row_is = mysqli_fetch_assoc($result_is))  
      {
          if ($row_is['Issuing_State'] == '1'){
              echo "<div class='alert alert-success alert-dismissible text-center mt-2 m-0'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong> Your New License is ready to be collected!</strong></div>"; 
          }


          if ($row_is['Issuing_State'] == '0'){
              echo "<div class='alert alert-danger alert-dismissible text-center mt-2 m-0'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong> Your license has been disapproved! </strong></div>"; 
          }
          

        
      } 
         //checking application status
   $sql = "SELECT * FROM user_details_renewal WHERE user_id = $id;";
   $result = mysqli_query($link, $sql) or die( mysqli_error($link));
   while ($row = mysqli_fetch_assoc($result))  
   {
       if ($row['status'] == 'Approved'){
           echo "<div class='alert alert-success alert-dismissible text-center mt-2 m-0'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
           <strong> Your application has been approved! </strong></div>"; 
       }


       if ($row['status'] == 'Rejected'){
           echo "<div class='alert alert-danger alert-dismissible text-center mt-2 m-0'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
           <strong> Your application has been rejected! </strong></div>"; 
       }

       if ($row['status'] == 'Pending'){
           echo "<div class='alert alert-info alert-dismissible text-center mt-2 m-0'>
           <button type='button' class='close' data-dismiss='alert'>&times;</button>
           <strong> Your application is still processing! </strong></div>"; 
       }
   }

      
      
      ?>
</div>
</div>
<br>







    <div class="row-sm-6">
        <div class="col-sm-6">

            <div class="card border-secondary mb-3">

                <div class="card-header">

                    <h2>Profile Details
                        <a href="" data-toggle="modal" data-target="#editinfoModal"><i class="fa fa-edit pull-right"></i></a>


                        <!-- Modal -->

                        <div class="modal fade" id="editinfoModal" tabindex="-1" aria-labelledby="editinfoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark">
                                        <h6 class="modal-title text-light" id="editinfoModalLabel">Edit Profile Info</h6>
                                        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="RenewalEditUser.inc.php" method="post">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="name" value="<?php
                                                                                                            $id = $_SESSION["userid"];
                                                                                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                                                                echo $row["full_name"];
                                                                                                            }
                                                                                                            ?>" required>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Gender</label>
                                                    <select class="custom-select" name="gender">
                                                        <option selected value="<?php
                                                                                $id = $_SESSION["userid"];
                                                                                $sql = "SELECT * FROM users WHERE user_id = $id";
                                                                                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                    if ($row["gender"] == "1") {
                                                                                        echo "Male";
                                                                                    } else if ($row["gender"] == "2") {
                                                                                        echo "Female";
                                                                                    } else {
                                                                                        echo "Other";
                                                                                    }
                                                                                }
                                                                                ?>">(
                                                            <?php
                                                            $id = $_SESSION["userid"];
                                                            $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo $row["gender"];
                                                            }
                                                            ?>

                                                            ) Click to Change</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Username</label>

                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">@</div>
                                                        </div>
                                                        <input type="text" class="form-control" name="uid" value="<?php
                                                                                                                    $id = $_SESSION["userid"];
                                                                                                                    $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                                    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                                                        echo $row["user_name"];
                                                                                                                    }
                                                                                                                    ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Contact No</label>
                                                    <input type="text" class="form-control" name="contactNo" value="<?php
                                                                                                                    $id = $_SESSION["userid"];
                                                                                                                    $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                                    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                                                        echo $row["contact_no"];
                                                                                                                    }
                                                                                                                    ?>" required>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>NIC No</label>
                                                    <input type="text" class="form-control" name="NICno" value="<?php
                                                                                                                $id = $_SESSION["userid"];
                                                                                                                $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                                                    echo $row["nic"];
                                                                                                                }
                                                                                                                ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="<?php
                                                                                                                $id = $_SESSION["userid"];
                                                                                                                $sql = "SELECT * FROM users WHERE user_id = $id;";
                                                                                                                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                                                    echo $row["user_email"];
                                                                                                                }
                                                                                                                ?>" required>
                                            </div>

                                            <div class="form-group row justify-content-center">
                                                <button class="btn btn-dark" input type="submit " name="submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>


                </div>


                <div class="card-body">
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
                        <?php } else if ($_GET["error"] == "uidtaken") { ?>
                            <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong> Error while updating info: Username/Email already taken! </strong>
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
                    <table class="table table-borderless">

                        <tr>
                            <td> Full Name</td>
                            <td translate='no'>
                                <?php $id = $_SESSION["userid"];
                                $sql = "SELECT * FROM users WHERE user_id=$id;";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row["user_name"];
                                } ?>
                            </td>

                        <tr>
                            <td> User Name</td>
                            <td>
                                <?php $id = $_SESSION["userid"];
                                $sql = "SELECT * FROM users WHERE user_id=$id;";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row["full_name"];
                                } ?>
                            </td>
                        </tr>

                        <tr>
                            <td> Email</td>
                            <td>
                                <?php $id = $_SESSION["userid"];
                                $sql = "SELECT * FROM users WHERE user_id=$id;";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row["user_email"];
                                } ?>
                            </td>
                        </tr>

                        <tr>
                            <td> NIC Number</td>
                            <td translate='no'>
                                <?php $id = $_SESSION["userid"];
                                $sql = "SELECT * FROM users WHERE user_id=$id;";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row["nic"];
                                } ?>
                            </td>
                        </tr>

                        <tr>
                            <td> Contact Number</td>
                            <td>
                                <?php $id = $_SESSION["userid"];
                                $sql = "SELECT * FROM users WHERE user_id=$id;";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo $row["contact_no"];
                                } ?>
                            </td>
                        </tr>

                        <tr>
                            <td> Gender</td>
                            <td>
                                <?php $id = $_SESSION["userid"];
                                $sql = "SELECT * FROM users WHERE user_id=$id;";
                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row["gender"] == "1") {
                                        echo "Male";
                                    } else if ($row["gender"] == "2") {
                                        echo "Female";
                                    } else {
                                        echo "Other";
                                    }
                                } ?>
                            </td>
                        </tr>

                    </table>

                </div>
                <div class="card-footer text-right">
                    <a href="#" data-toggle="modal" data-target="#changePwdModal"> Click here to change password </a>

                </div>
            </div>
        </div>


        <!--display status in dashboard -->

        <div class="col-sm-6">

            <div class="card border-secondary mb-3">

                <div class="card-header">
                    <h2>Progress</h2>
                </div>
                <div class="card-body">


                    <?php
                    $sql = "SELECT * FROM user_details_renewal WHERE user_id = ?";
                    if ($stmt = $link->prepare($sql)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt->bind_param("i", $param_id);

                        // Set parameters
                        $param_id = $id;

                        // Attempt to execute the prepared statement
                        if ($stmt->execute()) {
                            /* store result */
                            $stmt->store_result();

                            if ($stmt->num_rows() == 0) {
                    ?>
                                <div class="row justify-content-center wrapper">
                                    <div class="col-lg-12 bg-white p-4 pt-12">
                                        <div class="alert alert-danger" role="alert">
                                            You have not uploaded the application form to Renew your
                                            license. <strong><a style="text-decoration: none;" href="RenewalRegistration.php">Click Here</a></strong> to upload them.
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                $sql = "SELECT * FROM user_details_renewal WHERE user_id = $id";
                                $result = mysqli_query($link, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['status'] == 'Pending') {
                                ?>
                                        <div class="justify-content-center wrapper">
                                            <div class="col-lg-14 bg-white p-4 text-center">

                                                <h5>Your Renewal License Form is still Pending...</h5>
                                                <div class="spinner-grow text-warning" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                                <div class="spinner-grow text-warning" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                                <div class="spinner-grow text-warning" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                                <div class="spinner-grow text-warning" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                                <div class="spinner-grow text-warning" role="status">
                                                    <span class="sr-only"></span>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible text-justify mt-2 m-0">
                                                    <strong> Status of Your Documents!</strong>


                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>User Photo</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['photo_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Previous License</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['license_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Medical</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['medical_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    if ($row['status'] == 'Approved') {
                                    ?>
                                        <div class="justify-content-center wrapper">
                                            <div class="col-lg-14 bg-white p-2 text-center">
                                            <?php
                                            $sql = "SELECT Issuing_State  FROM user_details_renewal WHERE user_id = $id;";
                                            $result = mysqli_query($link, $sql) or die( mysqli_error($link));
                                            while ($row_is = mysqli_fetch_assoc($result))  
                                            {
                                                if ($row_is['Issuing_State'] ==null){
                                                    echo " <h5>Your Renewal License Form Approved Succesfully!!! Pay the required amount and We will notify the date to collect
                                                    your license soon... Stay touched with the account</h5>"; 
                                                }
                                      
                                      
                                      
                                              
                                            }
                                            
                                            
                                            
                                            
                                            
                                           ?>

                                            
                                                <div class="alert alert-success alert-dismissible text-justify mt-2 m-0">
                                                    <strong> Status of Your Documents!</strong>


                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>User Photo</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['photo_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Previous License</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['license_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Medical</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['medical_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                    <?php 
                                                    
                                                    
                                                  
                                                    echo $askToPay
                                                    
                                                    
                                                    
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    if ($row['status'] == 'Rejected') {
                                    ?>
                                        <div class="justify-content-center wrapper">
                                            <div class="col-lg-14 bg-white p-4 text-center">
                                                <h5>Sorry your one or more applications are rejected. You can re-upload only the rejected ones again.</h5>

                                                <div class="alert alert-danger alert-dismissible text-justify mt-2 m-0">
                                                    <strong> Status of Your Documents!</strong>


                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>User Photo</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['photo_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Previous License</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['license_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Medical</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <?php
                                                                    echo $row['medical_status'];
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <h5>Reasons for Rejection: <?php echo $row['Description'] ?></h5>

                                            </div>
                                        </div>
                                        <?php
                                    }
                                    if ($row['user_photo'] == NULL || $row['previous_license'] == NULL || $row['medical'] == NULL) {
                                        echo "<ul>";
                                        if ($row['user_photo'] == NULL) { ?> <div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong> You still haven't uploaded your photo! </strong>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row['previous_license'] == NULL) { ?><div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong> You still haven't uploaded your previous license! </strong>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        if ($row['medical'] == NULL) { ?><div class="alert alert-danger alert-dismissible text-center mt-2 m-0">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong> You still haven't uploaded your medical!</strong>
                                            </div>
                    <?php
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "Oops! Something went wrong when inserting name. Please try again later.";
                        }

                        // Close statement
                        $stmt->close();
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- Password change Modal -->

<div class="modal fade" id="changePwdModal" tabindex="-1" aria-labelledby="changePwdModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-light" id="changePwdModal">Change Password</h6>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="RenewalEditPassword.inc.php" method="post">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="text" class="form-control" name="newpwd" placeholder="New Password" required />

                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="text" class="form-control" name="confirmnewpwd" placeholder="Confirm New Password" required />

                    </div>
                    <div class="form-group row justify-content-center">
                        <button class="btn btn-dark" input type="submit " name="submit">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require_once 'footer.php';

?>