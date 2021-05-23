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


//notifications for new license


$query_noti = "SELECT  COUNT(status) FROM user_details WHERE  status= 'Pending'";
$qresult = mysqli_query($link, $query_noti);
$row_noti = mysqli_fetch_assoc($qresult);
$notification_new = $row_noti["COUNT(status)"];


//notifications for new renewals

$query_noti1 = "SELECT  COUNT(status) FROM user_details_renewal WHERE  status= 'Pending'";
$qresult1 = mysqli_query($link, $query_noti1);
$row_noti1 = mysqli_fetch_assoc($qresult1);
$notification_renew = $row_noti1["COUNT(status)"];

?>





<!DOCTYPE html>
<html lang="en">

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title translate="no">Admin Panel | <?= basename($_SERVER['PHP_SELF'], '.php') ?> </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type=text/css href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="Header/build/css/custom.min.css" rel="stylesheet">
    <link href="../css/Profile.css" rel="stylesheet">
    <link href="../css/StudyUpload.css" rel="stylesheet">
    <link href="language.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="profile clearfix" style="color: white;">
                        <div class="profile_details">
                            <img src="logo.png" alt="...">
                        </div>
                            <h4 style="text-align: center;">DLMS - Admin</h4>
                            <div class="text-light" style="text-align: center;">
                                <span>Welcome,</span>
                                <h2 class="text-light"> <?php echo  $data["admin_name"] ?></h2>
                            </div>
                        
                    </div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="Admin-Dashboard.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>

                                <li><a href="Admin-NLicense.php"><i class="fa fa-certificate"></i> New License </a></li>


                                <li><a href="Admin-Renewal.php"><i class="fa fa-folder"></i> Renewal Applications </a></li>

                                <li><a href="Admin-Issue.php"><i class="fa fa-list-alt"></i> License Renewing </a></li>
                                <li><a><i class="fa fa-calendar" aria-hidden="true"></i> Added Schedules <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="Prev-Written-Schedule.php">Written Exam</a></li>
                                        <li><a href="Prev-Trial-Schedule.php">Trial Exam</a></li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-edit"></i> Added Results <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="Prev-Written-Results.php">Written Exam</a></li>
                                        <li><a href="Prev-Trial-Results.php">Trial Exam</a></li>
                                    </ul>
                                </li>
                                <li><a href="NL_Issue.php"><i class="fa fa-list-alt"></i>License Issuing </a></li>

                                <li><a href="Reports.php"><i class="fa fa-bar-chart"></i>Reports </a></li>
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
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">


                                    <?php

                                    if ($result2->num_rows > 0 && $data['admin_photo'] != null) { ?>
                                        <?php while ($row = $result2->fetch_assoc()) { ?>
                                            <img src="data:admin_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row['admin_photo']); ?>" />
                                        <?php } ?>
                                    <?php } else { ?>
                                        <img src="Header/production/images/admin.png" alt="...">
                                    <?php } ?>



                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="Admin-Profile.php"> Profile</a>

                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <a class="dropdown-item" href="Admin-logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>