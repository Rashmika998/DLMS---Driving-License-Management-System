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


$max_students = 0;
$learners_name = $learners_address = $learners_province = $learners_contact = $learners_email = $learners_password = $confirm_password 
= $send_password = $vehicle1 = $vehicle2 = $vehicle3 = $vehicle4 = $vehicle5 = $vehicle6 = $vehicles = $imgContent = $learners_website = "";
$name_err = $address_err = $province_err = $contact_err = $max_students_err = $password_err= $email_err = $confirm_password_err = $website_err = $statusMsg = "";
$status = 'error';

 
//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    
    /////////// Validate Driving School Photo /////////////
    if (!empty($_FILES["learners_photo"]["name"])) {
        $uploadimg = "Image Selected";
            // Get file info 
        $fileName = basename($_FILES["learners_photo"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['learners_photo']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));


                // $sql = "UPDATE admin SET admin_photo = '" . $imgContent . "' WHERE  admin_id='" . $data['admin_id'] . "'";
                // $update = mysqli_query($link, $sql);

        } else {
            $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select an image file to upload.';
    }


     /////////// Validate Driving School Name/////////////
     if(empty(trim($_POST["learners_name"]))){
        $name_err = "Please enter a name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT learners_id FROM learners WHERE learners_name = ?";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_name);
            
            // Set parameters
            $param_name = trim($_POST["learners_name"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                /* store result */
                $stmt->store_result();
                
                if($stmt->num_rows() == 1){
                    $name_err = "This learners already has an account!";
                } else{
                    $learners_name = trim($_POST["learners_name"]);
                }
            } else{
                echo "Oops! Something went wrong when inserting name. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
 

    /////////// Validate Driving School Address/////////////
    if(empty(trim($_POST["learners_address"]))){
        $address_err = "Please enter the address.";
    } else{
        // Prepare a select statement
        $sql = "SELECT learners_id FROM learners WHERE learners_address = ?";
        
        if($stmt = $link->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_address);
            
            // Set parameters
            $param_address = trim($_POST["learners_address"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                /* store result */
                $stmt->store_result();
                
                if($stmt->num_rows() == 1){
                    $address_err = "This address is not valid.";
                } else{
                    $learners_address = trim($_POST["learners_address"]);
                }
            } else{
                echo "Oops! Something went wrong when inserting the address. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    
    /////////// Validate Driving School Email Address/////////////
    if(empty(trim($_POST["learners_email"]))){
        $email_err = "Please enter an email address!";     
    } 
    else{
        $learners_email = trim($_POST["learners_email"]);
        $learners_email = stripslashes($learners_email);
        $learners_email = htmlspecialchars($learners_email);
        if(!filter_var($learners_email, FILTER_VALIDATE_EMAIL)){
            $email_err = "Invalid email format";
        }
        else
        {
            // Prepare a select statement
            $sql = "SELECT learners_id FROM learners WHERE learners_email = ?";
        
            if($stmt = $link->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_email);
            
                // Set parameters
                $param_email = $learners_email;
            
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    /* store result */
                    $stmt->store_result();
                
                    if($stmt->num_rows() == 1){
                       $email_err = "This Email is already taken.";
                    } 
                    else{
                       $learners_email = trim($_POST["learners_email"]);
                    } 

                } 
                else{
                    echo "Oops! Something went wrong when inserting email. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }
    }

     
    if(!empty($_POST["learners_website"])){
        $learners_website = trim($_POST["learners_website"]);
        $learners_website = stripslashes($learners_website);
        $learners_website = htmlspecialchars($learners_website);
        if(!filter_var($learners_website, FILTER_VALIDATE_URL))
            $website_err = "Invalid website format";

        else
        $learners_website = trim($_POST["learners_website"]);

        
    }


    /////////// Validate Driving School Contact Number/////////////
    $learners_contact = trim($learners_contact);
    $learners_contact = stripslashes($learners_contact);
    $learners_contact = htmlspecialchars($learners_contact);
    if (!preg_match("/^[0-9]*$/",$learners_contact)){
        $contact_err = "Only numbers are allowed!";
    }
    else if (strlen($_POST["learners_contact"])!=10){
        $contact_err = "Telephone Number length is Invalid";
    }
    else{
        $learners_contact = $_POST["learners_contact"];
    }


    ///////////Validate Driving School Max Students/////////////
    if (!preg_match("/^[0-9]*$/",$max_students)){
        $max_students_err = "Only numbers are allowed!";
    }
    else{
        $max_students = $_POST["max_students"];
    }
    

    /////////// Validate Driving School Password/////////////
    if(empty(trim($_POST["learners_password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["learners_password"])) < 4){
        $password_err = "Password must have atleast 4 characters.";
    } else{
        $learners_password = trim($_POST["learners_password"]);
        $send_password = $learners_password;
    }
    
    /////////// Validate Driving School Confirm Password/////////////
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($learners_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }


    /////////// Validate Driving School Types of Vehicles/////////////
    //vehicle1(Bike)
    if(isset($_POST["vehicle1"])){
        $vehicle1 = $_POST["vehicle1"];
        $vehicles = $vehicle1;
    }
    
    else
    $vehicle1 = "";

    //vehicle2(Three Wheeler)
    if(isset($_POST["vehicle2"])){
        $vehicle2 = $_POST["vehicle2"];

        if(!empty($vehicles)){
            $vehicles .= ", ";
            $vehicles .= $vehicle2; 
        }
        
        else
        $vehicles = $vehicle2; 
    }
    
    else
    $vehicle2 = "";

    //vehicle3(Car)
    if(isset($_POST["vehicle3"])){
        $vehicle3 = $_POST["vehicle3"];

        if(!empty($vehicles)){
            $vehicles .= ", ";
            $vehicles .= $vehicle3; 
        }
        

        else
        $vehicles = $vehicle3; 
    }

    else
    $vehicle3 = "";

    //vehicle4(Van)
    if(isset($_POST["vehicle4"])){
        $vehicle4 = $_POST["vehicle4"];

        if(!empty($vehicles))
        {
            $vehicles .= ", ";
            $vehicles .=  $vehicle4; 
        }

        else
        $vehicles = $vehicle4; 
    }

    else
    $vehicle4 = "";

    //vehicle5(Truck)
    if(isset($_POST["vehicle5"])){
        $vehicle5 = $_POST["vehicle5"];

        if(!empty($vehicles)){
            $vehicles .= ", ";
            $vehicles .= $vehicle5;
        } 

        else
        $vehicles = $vehicle5; 
    }

    else
    $vehicle5 = "";

    //vehicle6(Bus)
    if(isset($_POST["vehicle6"])){
        $vehicle6 = $_POST["vehicle6"];

        if(!empty($vehicles)){
            $vehicles .= ", ";
            $vehicles .= $vehicle6;
        } 

        else
        $vehicles = $vehicle6; 
    }

    else
    $vehicle6 = "";

    /////////// Validate Driving School Province/////////////
    $learners_province = $_POST["learners_province"];


    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO learners (learners_photo, learners_name, learners_address, learners_province, max_students, learners_contact,
         learners_email, learners_website, vehicle1, vehicle2, vehicle3, vehicle4, vehicle5, vehicle6, learners_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = $link->prepare($sql)){
            
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssissssssssss", $param_img, $param_name, $param_address, $param_province, $param_students, $param_contact,
             $param_email, $param_website, $param_vehicle1, $param_vehicle2, $param_vehicle3, $param_vehicle4, $param_vehicle5, $param_vehicle6, $param_password);

            // Set parameters
            $param_img = $imgContent;
            $param_name = $learners_name;
            $param_address = $learners_address;
            $param_province = $learners_province;
            $param_students = $max_students;
            $param_contact = $learners_contact;
            $param_email = $learners_email;
            $param_website = $learners_website;
            $param_vehicle1 = $vehicle1;
            $param_vehicle2 = $vehicle2;
            $param_vehicle3 = $vehicle3;
            $param_vehicle4 = $vehicle4;
            $param_vehicle5 = $vehicle5;
            $param_vehicle6 = $vehicle6;
            $param_password = password_hash($learners_password, PASSWORD_DEFAULT); // Creates a password hash
           

            // Attempt to execute the prepared statement
            if($stmt->execute()){

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
                    $mail->addAddress($learners_email);     // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Driving License Management System Driving School Account';

                    $mail->Body    = "<h3>Welcome to the Driving License Management System $learners_name!</h3><br><br>Your administrator account has been created succesfully.<br><br> Here's your account information:<br>
                    Name: $learners_name <br>
                    Address: $learners_address <br>
                    Email: $learners_email <br>
                    Web site: $learners_website <br>
                    Province: $learners_province <br>
                    Maximum Students: $max_students <br>
                    Contact No: $learners_contact <br>
                    Vehicle Types: $vehicles <br>
                    Password: $send_password <br>
                     <br> Best Regards, <br> DLMS Team";


                     $learners_name="HHHHHHHHH";
                    if($mail->send()){
                        $learners_name = "";
                        $learners_address = "";
                        $learners_email = "";
                        $learners_website = "";
                        $max_students = 0;
                        $learners_contact = "";
                        header("Location: Admin-Added.php");
                        exit();
                    }

                } catch (Exception $e) {
                     echo 'Something went wrong,try again later';

                }
                
            } else{
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
        <div class="col-lg-7 bg-white p-4">
            <h4 class="text-center font-weight-bold">Add Driving School</h4>
            <hr class="my-3" />
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                class="px-3 needs-validation">

                <p>*Please fill this form to create an account for driving schools.</p>

                <div class="form-group">
                    <label style="font-size: 14px;">Learners Photo</label>
                    <input type="file" class="form-control" name="learners_photo" placeholder="Insert an Image">
                    <span class="help-block"><?php echo $statusMsg; ?></span>
                </div><br>

                <div class="form-group">
                    <label style="font-size: 14px;">Learners Name</label>
                    <input type="text" class="form-control" name="learners_name" placeholder="Ex: ABC Learners"
                        value="<?php echo $learners_name; ?>" required>
                    <span class="help-block"><?php echo $name_err; ?></span>
                </div><br>

                <div class="form-group">
                    <label style="font-size: 14px;">Learners Address</label>
                    <input type="text" name="learners_address" class="form-control"
                        value="<?php echo $learners_address; ?>">
                    <span class="help-block"><?php echo $address_err; ?></span>
                </div><br>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label style="font-size: 14px;">Province</label>
                        <select id="learners_province" name="learners_province" class="form-control">
                            <option value="Western Province">Western Province</option>
                            <option value="Eastern Province">Eastern Province</option>
                            <option value="Central Province">Central Province</option>
                            <option value="North Province">North Province</option>
                            <option value="Southern Province">Southern Province</option>
                            <option value="North Central Province">North Central Province</option>
                            <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                            <option value="Uva Province">Uva Province</option>
                            <option value="North Western Province">North Western Province</option>
                        </select>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label style="font-size: 14px;">Maximum Students</label>
                        <input type="number" class="form-control" name="max_students"
                            placeholder="Enter the Maximum Students" value="<?php echo $max_students; ?>" required>
                        <span class="help-block"><?php echo $max_students_err; ?></span>
                    </div><br>
                </div><br>

                <div class="form-group">
                    <label style="font-size: 14px;">Contact Number</label>
                    <input type="text" class="form-control" name="learners_contact" placeholder="Enter a Contact Number"
                        value="<?php echo $learners_contact; ?>" required>
                    <span class="help-block"><?php echo $contact_err; ?></span>
                </div><br>

                <div class="form-group">
                    <label style="font-size: 14px;">Email</label>
                    <input type="email" class="form-control" name="learners_email" placeholder="Enter an Email Address"
                        value="<?php echo $learners_email; ?>" required>
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div><br>

                <div class="form-group">
                    <label style="font-size: 14px;">Website</label>
                    <input type="text" class="form-control" name="learners_website"
                        placeholder="Enter the Website if exists" value="<?php echo $learners_website; ?>">
                    <span class="help-block"><?php echo $website_err; ?></span>
                </div><br>

                <div class="form-group">
                    <label style="font-size: 14px;">Vehicle Types</label><br>
                    <input type="checkbox" name="vehicle1" value="Bike">
                    <label>Bike <i class="fa fa-motorcycle" aria-hidden="true"></i></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="vehicle2" value="Three Wheeler">
                    <label>Three Wheeler <img style="width: 20px;"
                            src="https://img.icons8.com/ios-filled/50/000000/three-wheel-car.png" /></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="vehicle3" value="Car">
                    <label>Car <i class="fa fa-car" aria-hidden="true"></i></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="vehicle4" value="Van">
                    <label>Van <i class="fas fa-shuttle-van" aria-hidden="true"></i></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="vehicle5" value="Truck">
                    <label>Truck <i class="fa fa-truck" aria-hidden="true"></i></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="vehicle6" value="Bus">
                    <label>Bus <i class="fa fa-bus" aria-hidden="true"></i></label>
                </div><br>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label style="font-size: 14px;">Password</label>
                        <input type="password" class="form-control" name="learners_password"
                            placeholder="Enter a Password" required>
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div><br>

                    <div class="form-group col-md-6">
                        <label style="font-size: 14px;">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password"
                            placeholder="Re-Enter the Password" required>
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div><br>
                </div><br>

                <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block myBtn" type="submit " name="submit">Add</button>
                </div>

                <hr class="my-3" />

            </form>
        </div>
    </div>
    <!-- Registration Form End -->
</div>


<style>
.help-block {
    color: red;
}
</style>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


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