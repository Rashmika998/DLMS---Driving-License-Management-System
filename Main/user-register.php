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

<section id="hero1" class="d-flex align-items-center" style="height: 1000px;">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow-lg">
                            <div class="card-body">
                            <h4>Sign Up</h4> 
                            <p style="font-size: 12px;">*Please fill this form to create an user account</p>
                            <hr class="my-3" />
                            <form action="../MIS/includes/register.inc.php" method="post" id="login-form">
                            <?php
 
                                if (isset($_GET["error"])) {
                                    
                                    if ($_GET["error"] == "stmtfailed") {
                                        echo "<p><font color=red>Something went wrong, try again!</font></p>";
                                    }
                                    
                                    else if ($_GET["error"] == "none") {
                                        echo "<p><font color=Green>Your registration is successful!<br>A verification email has been sent to your account &nbsp;&nbsp;</font><a href='user-login.php'>Click here to login</a></p>";
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
                                        <option value=1>Male</option>
                                        <option value=2>Female</option>
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
                                    <button class="btn btn-primary btn-lg btn-block myBtn" type="submit " name="submit">
                                        Register
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

        
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