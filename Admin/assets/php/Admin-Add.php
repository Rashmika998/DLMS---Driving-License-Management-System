<?php
ob_start();

require_once 'admin-header.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\phpmailer\phpmailer\src\Exception.php';
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'vendor\phpmailer\phpmailer\src\SMTP.php';

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);



$admin_name = $admin_username = $admin_email = $admin_password = $confirm_password = $send_password = "";
$name_err = $username_err = $password_err = $email_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

                if ($stmt->num_rows() >= 1) {
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

    // Validate Admin Username
    if (empty(trim($_POST["admin_username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT admin_id FROM admin WHERE admin_username = ?";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["admin_username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                /* store result */
                $stmt->store_result();

                if ($stmt->num_rows() >= 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $admin_username = trim($_POST["admin_username"]);
                }
            } else {
                echo "Oops! Something went wrong when inserting username. Please try again later.";
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

                    if ($stmt->num_rows() >= 1) {
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


    // Validate password
    if (empty(trim($_POST["admin_password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["admin_password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $admin_password = trim($_POST["admin_password"]);
        $send_password = $admin_password;
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($admin_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {


        // Prepare an insert statement
        $sql = "INSERT INTO admin (admin_name, admin_username, admin_password,admin_email) VALUES (?, ?, ?, ?)";

        if ($stmt = $link->prepare($sql)) {


            // Bind variables to the prepared statement as parameters
            if ($stmt->bind_param("ssss", $param_name, $param_username, $param_password, $param_email))


                // Set parameters
                $param_name = $admin_name;
            $param_username = $admin_username;
            $param_email = $admin_email;
            $param_password = password_hash($admin_password, PASSWORD_DEFAULT); // Creates a password hash


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {



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

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Driving License Management System';

                    $mail->Body    = "<h3>Welcome to the Driving License Management System</h3><br><br>Your administrator account has been created succesfully.<br><br> Here's your account information:<br>
                     Name: $admin_name <br>
                     Username: $admin_username <br>
                     Email: $admin_email<br>
                     Password: $send_password <br>
                     <br> Best Regards, <br> DLMS Team";

                    $mail->send();
                    //  echo $user->showwMessage('success','We have send you  reset link,please check your email');

                } catch (Exception $e) {
                     echo 'Something went wrong,try again later';

                }
                header("Location: Admin-Added.php");
                exit();
            } else {

                echo "Something went wrong when executing. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $link->close();
}
ob_end_flush();

?>


<div class="right_col" role="main">
    <!-- Add Admin -->
    <div class="row justify-content-center wrapper">
        <div class="col-lg-7 bg-white p-4 pt-12">
            <h4 class="text-center font-weight-bold">Add Admin</h4>
            <hr class="my-3" />
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="px-3 needs-validation" id="admin_add">

                <p>Please fill this form to create an admin account.</p>

                <div class="form-group">
                    <label>Admin Name</label>
                    <?php

                    if ($name_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $name_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }
                    ?>
                    <input type="text" class="form-control" name="admin_name" placeholder="Enter Admin Name" value="<?php echo $admin_name; ?>" required>
                </div>

                <div class="form-group">
                    <label>Admin Username</label>
                    <?php

                    if ($username_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $username_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }
                    ?>
                    <input type="text" class="form-control" name="admin_username" placeholder="Enter Admin Username" value="<?php echo $admin_username; ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <?php

                    if ($email_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $email_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }
                    ?>
                    <input type="email" class="form-control" name="admin_email" placeholder="Enter Email" value="<?php echo $admin_email; ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Password</label>

                        <input type="password" class="form-control" name="admin_password" placeholder="Enter Password" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Confirm Password</label>

                        <input type="password" class="form-control" name="confirm_password" placeholder="Re-Enter Password" required>

                    </div>

                    <div class="form-group col-md-12">

                    <?php

                    if ($password_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $password_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }

                    if ($confirm_password_err != null) {
                        echo '<br/> <div class="alert alert-danger alert-dismissible fade show" role="alert" ><strong>';
                        echo $confirm_password_err;
                        echo ' </strong> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
                    }
                    ?>
                </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block myBtn" type="submit " name="submit">Add</button>
                </div>

                <hr class="my-3" />

            </form>
        </div>
    </div>
    <!-- Registration Form End -->
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