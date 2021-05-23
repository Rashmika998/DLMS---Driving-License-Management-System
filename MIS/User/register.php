<?php
require_once '../includes/header.php';
require_once '../includes/functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLMS</title>
</head>
<body>
<br><br>
    <div class="container">
        <!-- Registration Form Start -->
      <div class="row justify-content-center wrapper" id="registeration-box">
            <div class="col-lg-7 bg-white p-4">
              <h4 class="text-center font-weight-bold">Sign Up</h4>
              <p class ="col-md-12" >Please fill this form to create a user account.</p>
              <hr class="my-3" /> 
              <form action="../includes/register.inc.php" method="post" class="px-3 needs-validation">
 
              <?php
 
                        if (isset($_GET["error"])) {
                            
                            if ($_GET["error"] == "stmtfailed") {
                                echo "<p><font color=red>Something went wrong, try again!</font></p>";
                            }
                            
                            else if ($_GET["error"] == "none") {
                                echo "<p><font color=Green>Your registration is successful!<br>A verification email has sent to your account &nbsp;&nbsp;</font><a href='login.php'>Click here to login</a></p>";
                            }
                        }

                    ?>

              <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required value="<?PHP 
                if (isset($_GET["name"])) {
                 echo $_GET["name"];
                }
                ?>">
                <?php
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "invalidFormat") {
                            echo "<p><font color=red>Invalid name format!</font></p>";
                        }
                      }
                    ?>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter Email" required value="<?PHP 
                if (isset($_GET["email"])) {
                 echo $_GET["email"];
                }
                ?>">
                  <?php
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "invalidemail") {
                            echo "<p><font color=red>Choose a proper email!</font></p>";
                        }
                        if ($_GET["error"] == "emailexist") {
                          echo "<p><font color=red>Email already taken!</font></p>";
                      }
                      }
                    ?>
                </div> 
                <div class="form-group col-md-6">
                  <label>Username</label>

                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" name="uid" placeholder="Enter Username" required value="<?PHP 
                if (isset($_GET["uid"])) {
                 echo $_GET["uid"];
                }
                ?>">
                  </div>
                  <?php
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "uidexist") {
                            echo "<p><font color=red>Username already taken!</font></p>";
                        }
                        else if ($_GET["error"] == "invaliduid") {
                          echo "<p><font color=red>Choose a proper username!</font></p>";
                        }
                      }
                    ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Contact No</label>
                  <input type="text" class="form-control" name="contactNo" placeholder="Enter Contact No" required value="<?PHP 
                if (isset($_GET["contactNo"])) {
                 echo $_GET["contactNo"];
                }
                ?>">
                  <?php
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "invalidNo") {
                            echo "<p><font color=red>Invalid contact no!</font></p>";
                        }
                      }
                    ?>
                </div>

                <div class="form-group col-md-6">
                  <label>NIC No</label>
                  <input type="text" class="form-control" name="NICno" placeholder="Enter NIC No" required value="<?PHP 
                if (isset($_GET["NICno"])) {
                 echo $_GET["NICno"];
                }
                ?>"> 
                  <?php
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "invalidNIC") {
                            echo "<p><font color=red>Invalid NIC!</font></p>";
                        }
                      }
                    ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Gender</label>
                    <select class="custom-select" name="gender" >
                    <option selected>Click to select</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                    <?php
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "invalidGender") {
                            echo "<p><font color=red>Please select your gender!</font></p>";
                        }
                      }
                    ?>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Password</label>
                  <input type="password" class="form-control" name="pwd" placeholder="Enter Password" required>
                </div>

                <div class="form-group col-md-6">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control"  name="pwdrepeat" placeholder="Confirm Password" required>
                </div>
                <?php
                      if (isset($_GET["error"])) {
                        if ($_GET["error"] == "missmatchpwd") {
                            echo "<p><font color=red>Passwords don't match!</font></p>";
                        }
                      }
                    ?>
              </div>

              <div class="form-group">
                  <button class="btn btn-primary btn-lg btn-block myBtn" style="background-color: #191970;" type="submit " name="submit">
                    Register
                  </button>
              </div>

              </form>
            </div>
      </div>
      <!-- Registration Form End -->
    </div>
</body>
</html>