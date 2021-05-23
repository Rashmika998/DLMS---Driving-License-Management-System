<?php
// session_start();
// if(!isset($_SESSION['admin_username'])){

//     header('location:index.php');
//     exit();
// }

// ?>

// <?php
// session_start();
// if(!isset($_SESSION['admin_username'])){

//     header('location:index.php');
//     exit();
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" href="images/favicon.ico" type="image/ico" /> -->
    <img src="https://img.icons8.com/color/100/000000/driver-license-card.png"/>
    <title>Admin Panel | </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type=text/css
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="Header/build/css/custom.min.css" rel="stylesheet">
</head>

<style>
.main_menu_side-hidden-print-main_menu:hover:not(.active) {
    background-color: #B2BEB5;
}
</style>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>DLMS - Admin </span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="Header/production/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Mr Administrator</h2>
                        </div>
                    </div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard </a></li>

                                <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#">Registered Users</a></li>
                                        <li><a href="#">Driving Schools</a></li>
                                    </ul>
                                </li>


                                <li><a href="#"><i class="fa fa-certificate"></i> New License </a></li>

                                <li><a href="#"><i class="fa fa-folder"></i> License Renewal </a></li>

                                <li><a><i class="fa fa-edit"></i> Examination Results <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#">Written Exam</a></li>
                                        <li><a href="#">Practical Exam</a></li>
                                    </ul>
                                </li>

                                <li><a href="#"><i class="fa fa-bar-chart"></i>Reports </a></li>
                                <li><a href="#"><i class="fa fa-book"></i> Study Material </a></li>
                            </ul>


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
                                    <img src="Header/production/images/img.jpg" alt="">Mr. Administrator
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:;"> Profile</a>

                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out pull-right"></i>
                                        Log Out</a>
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

            <!-- page content -->
            <div class="right_col" role="main">
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