<?php

require_once '../MIS/includes/functions.inc.php';
require_once '../MIS/includes/login.inc.php';
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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DLMS-Driving License Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:dlms2021@gmail.com">dlms2021@gmail.com</a>
        <i class="icofont-phone"></i> 0112-123123
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">DLMS
          <span>
            <img src="assets/img/logo.png">
          </span>
        </a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li ><a href="index.php">Home</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
<body>

<section id="hero1" class="d-flex align-items-center" style="height: 700px;">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow-lg">
                            <div class="card-body">
                            <h4>Sign in to account</h4> 
                            <hr class="my-3" />
                            <form action="" method="post" id="login-form">

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
                                        <span class="input-group-text rounded-0"><i class="bx bxs-user"></i></span>
                                    </div>
                                    <input type="text " name="uid" class="form-control rounded-0" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" placeholder="Enter Username/Email" required />
                                </div>

                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0"><i class="bx bxs-lock"></i></span>
                                    </div>
                                    <input type="password" name="pwd" class="form-control rounded-0 col-lg-12" placeholder="Enter Password" required/>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" value="Sign In" class="btn btn-primary btn-lg btn-block myBtn"/>
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
                                <p>Don't have an account? <a href="user-register.php">Sign up here!</a></p>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!--RecoverPwd modal start-->
<div class="modal fade" id="RecoverPwdModal">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h6 class="modal-title text-light">Recover Password</h6>
                      <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body ">
                      <form action="../MIS/includes/recoverPassword.inc.php" method="post">
          
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
                          <button class="btn btn-primary" input type="submit " name="submit">Get OTP</button>                                
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
                                    echo "<p class='text-success'>OTP has been sent to your email, Use the OTP to login</p>";
                                }
                            }

                      ?>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!--RecoverPwd modal end-->
  
    <!-- ======= Footer ======= -->
    <footer id="footer">

<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-6 footer-contact">
        <h3>DLMS</h3>
        <p>
          Department of Motor Traffic Rd, <br>
          Boralesgamuwa <br><br>
          <strong>Phone:</strong> 0112-123123<br>
          <strong>Email:</strong> <a href="mailto:dlms2021@gmail.com">dlms2021@gmail.com</a><br>
        </p>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#index.php">Home</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="services">Services</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#services">New License</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#services">Renew License</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#services">Online Study Materials and Payments</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#services">Exam Scheduling</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#services">Driving Schools</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#services">License Issuing</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Our Social Networks</h4>
        <p>Contact us through any network</p>
        <div class="social-links mt-3">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container py-4">
  <div class="pull-right">
    &copy; Copyright <strong><span>Driving License Management System</span></strong>. All Rights Reserved
  </div>
</div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counterup/counterup.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>