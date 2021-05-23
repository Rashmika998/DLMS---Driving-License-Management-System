<?php
require_once "config.php";

if (!isset($_SESSION['loggedin_admin'])) {
  header('Location: Admin-Login.php');
  exit;
} else {
  $admin_username = $_SESSION['admin_uname'];
  $sql = "SELECT * FROM admin WHERE admin_username='" . $admin_username . "'";
  $records = mysqli_query($link, $sql);
  $data = mysqli_fetch_assoc($records);
}

$result = $link->query("SELECT admin_photo FROM admin WHERE  admin_id='" . $data['admin_id'] . "'");
$result2 = $link->query("SELECT admin_photo FROM admin WHERE  admin_id='" . $data['admin_id'] . "'");

$uid = $full_name = $attempt = $location = $capacity = $date = $time = $attempt ="";

$location_err = $username_err = $name_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $full_name = $_SESSION['full_name'];
    $attempt = $_SESSION['attempt'];
    $capacity = trim($_POST['capacity']);
    $location = trim($_POST['location']);
    $date = $_POST['date'];
    $time = $_POST['time'];

    if($attempt == "1"){
    // Check input errors before inserting in database
    if (empty($name_err) && empty($username_err) && empty($location_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO written_exam (user_id, full_name, attempt, capacity , location, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            if ($stmt->bind_param("ississs",$param_uid, $param_name, $param_attempt, $param_capacity, $param_location, $param_date, $param_time))

            // Set parameters
            $param_uid = $uid;
            $param_name = $full_name;
            $param_attempt = $attempt;
            $param_capacity = $capacity;
            $param_location = $location;
            $param_date = $date;
            $param_time = $time;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $update = mysqli_query($link, "UPDATE written_payment SET scheduled = 'Yes' WHERE user_id = '".$uid."'");
                if($update){
                    header("Location: Written-Schedule-Added.php?user_id=$uid");
                    exit();
                }
            } else {

                echo "Something went wrong when executing. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
        else
        echo "Something went wrong when preparing. Please try again later.";
    }
    }

    else{
        $update_new = mysqli_query($link,"UPDATE written_exam SET full_name='".$full_name."' ,attempt = '".$attempt."'
        ,capacity = '".$capacity."',location = '".$location."',date = '".$date."',time = '".$time."', result = 'N/A'
        WHERE user_id = '".$uid."'");
        if($update_new){
            $update = mysqli_query($link, "UPDATE written_payment SET scheduled = 'Yes' WHERE user_id = '".$uid."'");
            if($update){
               header("Location: Written-Schedule-Added.php?user_id=$uid");
               exit();
            }
        }
        else{
            echo "Error";
        }
    }

    // Close connection
    $link->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Admin Panel | <?= basename($_SERVER['PHP_SELF'], '.php') ?> </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type=text/css
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="Header/build/css/custom.min.css" rel="stylesheet">
    <link href="../css/Profile.css" rel="stylesheet">
    <link href="../css/StudyUpload.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title">

                            <i class="fa fa-laptop"></i>

                            <span>DLMS - Admin </span></a>
                    </div>

                    <div class="clearfix"></div>


                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <?php if ($result->num_rows > 0 && $data['admin_photo'] != null) { ?>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                            <img class="img-circle profile_img"
                                src="data:admin_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row['admin_photo']); ?>" />
                            <?php } ?>
                            <?php } else { ?>

                            <img src="Header/production/images/admin.png" alt="..." class="img-circle profile_img">
                            <?php } ?>


                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2> <?php echo  $data["admin_name"] ?></h2>
                        </div>
                    </div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="Admin-Dashboard.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>

                                <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="Admin-View.php">Administrators</a></li>
                                        <li><a href="Driving-Schools-View.php">Driving Schools</a></li>
                                        <li><a href="User-View.php">Registered Users</a></li>
                                    </ul>
                                </li>


                                <li><a href="#"><i class="fa fa-certificate"></i> New License </a></li>

                                <li><a href="#"><i class="fa fa-folder"></i> License Renewal </a></li>

                                <li><a><i class="fa fa-calendar" aria-hidden="true"></i> Examination Schedule <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="Exam-Schedule-Written.php">Written Exam</a></li>
                                        <li><a href="Exam-Schedule-Trial.php">Practical Exam</a></li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-edit"></i> Examination Results <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="Exam-Results-Written.php">Written Exam</a></li>
                                        <li><a href="#">Practical Exam</a></li>
                                    </ul>
                                </li>

                                <li><a href="#"><i class="fa fa-bar-chart"></i>Reports </a></li>
                                <li><a href="Admin-StudyMaterials.php"><i class="fa fa-book"></i> Study Material </a>
                                </li>

                                <li><a><i class="fa fa-user-plus"></i> Add <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="Admin-Add.php">Add Admin</a></li>
                                        <li><a href="Learners-Add.php">Add Learners</a></li>
                                    </ul>
                                </li>

                        </div>


                    </div>

                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">


                                    <?php

                  if ($result2->num_rows > 0 && $data['admin_photo'] != null) { ?>
                                    <?php while ($row = $result2->fetch_assoc()) { ?>
                                    <img
                                        src="data:admin_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row['admin_photo']); ?>" />
                                    <?php } ?>
                                    <?php } else { ?>
                                    <img src="Header/production/images/admin.png" alt="...">
                                    <?php } ?>



                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="Admin-Profile.php"> Profile</a>

                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <a class="dropdown-item" href="admin-logout.php"><i
                                            class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell" style="color: #15202c;"></i>
                                    <span class="badge bg-green"></span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    <a class="dropdown-item">
                                        <strong>See All Notifications</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </ul>
                    </nav>
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