<?php
require_once '../includes/header.php';
require_once '../includes/login.inc.php';
require_once '../includes/functions.inc.php';
session_start();
if(isset($_SESSION[""]))
{
    test();
}
$connect = mysqli_connect("localhost", "root", "", "dlms"); 
if(isset($_POST["submit"]))   
{  
    if(!empty($_POST["uid"]) && !empty($_POST["pwd"]))
    {
    $name = mysqli_real_escape_string($connect, $_POST["uid"]);
    $sql = "Select * from users where user_name = '" . $name . "' or user_email = '" . $name . "'";  
    $result = mysqli_query($connect,$sql);  
    $user = mysqli_fetch_array($result);  
    if($user)   
    {  
    if(!empty($_POST["rem"]))   
    {  
        setcookie ("member_login",$name,time()+ (10 * 365 * 24 * 60 * 60));
        $_SESSION[""] = $name;
    }  
    else  
    {  
        if(isset($_COOKIE["member_login"]))   
        {  
        setcookie ("member_login","");  
        }
    }  
    test(); 
    } 
    else  
  {  
    test();
  }  
    }
    else
 {
    test();
 }
 } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-License</title>
</head>
<body>
<br><br><br><br>
    <div class="container">
        <!-- Login Form Start -->
      <div class="row justify-content-center wrapper" id="login-box">
            <div class="col-lg-7 bg-white p-4">
              <h4 class="text-center font-weight-bold">Sign in to Account</h4>
              <hr class="my-3" />
              <form action="" method="post" class="px-3" id="login-form">

              <?php

                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p><font color=red>Fill in all fields!</font> </p>"; 
                    }
                    else if ($_GET["error"] == "wronglogin") {
                        echo "<p> <font color=red>Incorrect login information!</font> </p>"; 
                    }
                    else if ($_GET["error"] == "inactive") {
                        echo "<p> <font color=red>Activate your account first!</font> </p>"; 
                    }
                    else if ($_GET["error"] == "modal") {
                      echo "<p><font color=red>OTP has been sent to your mail</font></p>";
                    }
                    else if ($_GET["error"] == "invalidinfomodal") {
                      echo "<p> <font color=red>Error while sending OTP: Invalid user information!</font> </p>"; 
                    }
                    else if ($_GET["error"] == "invalidemailmodal") {
                      echo "<p><font color=red>Error while sending OTP: Invalid email format!</font></p>";
                    }
                }

              ?>

                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fa fa-user fa-lg fa-fw"></i></span>
                  </div>
                  <input type="text " name="uid" class="form-control rounded-0" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" placeholder="Username/Email" required />
                </div>

                <div class="input-group input-group-lg form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text rounded-0"><i class="fa fa-lock fa-lg fa-fw"></i></span>
                  </div>
                  <input type="password" name="pwd" class="form-control rounded-0" placeholder="Password" required/>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" value="Sign In" class="btn btn-primary btn-lg btn-block myBtn" style="background-color: #191970;"/>
                </div>

                <div class="form-group clearfix">
                  <div class="custom-control custom-checkbox float-left">
                  <input type="checkbox" name="rem" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> >
                    <label>Remember Username</label>
                    
                  </div>
                  <div class="forgot float-right">
                  <a href="#" data-toggle ="modal" data-target="#RecoverPwdModal">Forgot Password?</a>
                  </div>
                </div>

                <hr class="my-3" />

                <p>Don't have an account? <a href="register.php">Sign up here!</a></p>

              </form>
            </div>
      </div>
      <!-- Login Form End -->

      <!--RecoverPwd modal start-->
      <div class="modal fade" id="RecoverPwdModal">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header bg-dark">
                      <h6 class="modal-title text-light">Recover Password</h6>
                      <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body ">
                      <form action="../includes/recoverPassword.inc.php" method="post">
          
                      <span>
                            <p>Enter your email and username to get your One-Time-Password</p>
						          </span>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="uid" placeholder="Username" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="recoverEmail" placeholder="Email" required>
                        </div>
                      </div>

                      <div class="form-group row justify-content-center">
                          <button class="btn btn-dark" input type="submit " name="submit">Get OTP</button>                                
                      </div>

                      <?php

                            if (isset($_GET["error"])) {
                                
                                if ($_GET["error"] == "invalidinfomodal") {
                                    echo "<p> <font color=red>Error while sending OTP: Invalid user information!</font> </p>"; 
                                }
                                else if ($_GET["error"] == "invalidemailmodal") {
                                    echo "<p><font color=red>Error while sending OTP: Invalid email format!</font></p>";
                                }
                                else if ($_GET["error"] == "modal") {
                                    echo "<p><font color=red>OTP has been sent to your mail, Use the OTP to login</font></p>";
                                }
                            }

                      ?>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!--RecoverPwd modal end-->

    </div>
</body>
</html>