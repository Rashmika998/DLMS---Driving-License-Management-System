<?php

//Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin_admin"]) && $_SESSION["loggedin_admin"] === true) {
    header("location: Admin-Dashboard.php");
    exit;
}

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'dlms');

$link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values
$admin_username = $admin_password = "";
$username_err = $password_err = "";


// Processing form data when form is submitted
if (isset($_POST["LogButton"])) {

    // Check if username is empty
    if (empty(trim($_POST["admin_username"]))) {
        $username_err = "Please enter the username.";
    } else {
        $admin_username = trim($_POST["admin_username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["admin_password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $admin_password = trim($_POST["admin_password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement

        $sql = "SELECT admin_id, admin_username, admin_password FROM admin WHERE admin_username = ?";

        if ($stmt = $link->prepare($sql)) {


            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $admin_username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows() == 1) {
                    // Bind result variables
                    $stmt->bind_result($admin_id, $admin_username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($admin_password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin_admin"] = true;
                            $_SESSION["admin_id"] = $admin_id;
                            $_SESSION["admin_uname"] = $admin_username;

                            // Redirect user to welcome page
                            header("location: Admin-Dashboard.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $link->close();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


$admin_email = $email_err = " ";


if (isset($_POST["VerifyButton"])) {
    if (empty(trim($_POST["admin_email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $admin_email = trim($_POST["admin_email"]);
        $admin_email = stripslashes($admin_email);
        $admin_email = htmlspecialchars($admin_email);
        if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format!";
        }
    }

    $records = mysqli_query($link, "SELECT admin_id,admin_name, admin_username, admin_password FROM admin WHERE admin_email = '$admin_email'");
    if ($data = mysqli_fetch_array($records)) {
        $_SESSION['admin_id'] = $data['admin_id'];

        try {

            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "dlmslk2021@gmail.com";
            $mail->Password = "DLMS2021";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;

            //Recipients
            $mail->setFrom("dlmslk2021@gmail.com", "DLMS");
            $mail->addAddress($admin_email);     // Add a recipient


            $admin_name = $data['admin_name'];
            $admin_id = $data['admin_id'];

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Driving License Management System -Administrator Recover Password";

            $mail->Body    = "Dear $admin_name , <br><br> Click the below link to reset the password<br>
            <a href='http://localhost/MIS_PROJECT-NEW3/Admin/assets/php/Admin-Reset-Password.php?admin_id=$admin_id'>
           <h4> Reset Password</h4></a>
            <br>If you didn't request this forgotten password email, no action is needed, your password will not be reset. However,
            you may want to change your password as someone may have guessed it.<br>  <br> Best Regards <br> DLMS Team";

            if ($mail->send()) {
                echo '<br/> <div class="row justify-content-center wrapper"><div class="alert alert-success alert-dismissible fade show"
                 role="alert" ><p>Recovery Link is succefully sent to your logged email address.Click the link in their or copy and paste it in the browser to reset your password.</p><strong>';
                echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div> </div>';
            }
        } catch (Exception $e) {
            echo '<br/> <div class="row justify-content-center wrapper"><div class="alert alert-danger alert-dismissible fade show" 
            role="alert" ><p>Something went wrong,try again later.</p><strong>';
            echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div> </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title translate="no">DLMS-Driving License Management System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../Main/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../Main/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../../../Main/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../Main/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../../Main/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../../../Main/assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../Main/assets/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>


<body>

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

            <h1 class="logo mr-auto" translate="no"><a href="index.php">DLMS
                    <span>
                        <img src="../../../Main/assets/img/logo.png">
                    </span>
                </a>
            </h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->

            <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        includedLanguages: 'en,si,ta',
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                    }, 'google_translate_element');
                }
            </script>
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li><a href="../../../Main/index.php">Home</a></li>

                </ul>


            </nav><!-- .nav-menu -->
            <div id="google_translate_element" style="padding-left: 35px;padding-right: 15px;">Language</div>
        </div>
    </header>
    <!-- End Header -->

    <body>
        <section id="hero1" class="d-flex align-items-center">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h3>Admin Login</h3>
                                <p style="font-size: 12px;">*Please fill in your admin credentials to login.</p>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <div class="form-group">
                                        <?php

                                        if ($username_err != null) {
                                            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                    <strong>';
                                            echo
                                                $username_err;

                                            echo ' </strong> 
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                   
                     </div>';
                                        }
                                        ?>
                                        <label>Admin Username</label>
                                        <input type="text" name="admin_username" class="form-control" value="<?php echo $admin_username; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="admin_password" class="form-control">
                                        <?php

                                        if ($password_err != null) {
                                            echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                    <strong>';
                                            echo
                                                $password_err;

                                            echo ' </strong> 
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                   
                     </div>';
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="LogButton" class="btn btn-primary " value="Login">
                                    </div>
                                    <div class="forgot float-right">
                                        <a role="button" data-toggle="modal" data-target="#exampleModal" href="">Forgot Password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Recover Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                <label>Email Address</label>
                                <input type="text" name="admin_email" class="form-control" placeholder="Please enter the email address you logged in">
                                <span class="help-block"><?php echo $email_err; ?></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <input type="submit" name="VerifyButton" class="btn btn-primary" value="Verify">
                        </div>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3 translate="no">DLMS</h3>
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
                    &copy; Copyright <strong><span >Driving License Management System</span></strong>. All Rights Reserved
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

        <!-- Vendor JS Files -->
        <script src="../../../Main/assets/vendor/jquery/jquery.min.js"></script>
        <script src="../../../Main/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../../Main/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
        <script src="../../../Main/assets/vendor/php-email-form/validate.js"></script>
        <script src="../../../Main/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
        <script src="../../../Main/assets/vendor/counterup/counterup.min.js"></script>
        <script src="../../../Main/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
        <script src="../../../Main/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../../../Main/assets/vendor/venobox/venobox.min.js"></script>
        <script src="../../../Main/assets/vendor/aos/aos.js"></script>

        <!-- Template Main JS File -->
        <script src="../../../Main/assets/js/main.js"></script>
    </body>

</html>