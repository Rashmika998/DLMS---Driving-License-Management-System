<?php
session_start();

$learners_id = $_SESSION["learnersid"];
$sql = "SELECT * FROM learners WHERE learners_id='" . $learners_id . "'";
$records = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($records);


$result = $link->query("SELECT learners_photo FROM learners WHERE  learners_id='" . $learners_id . "'");
$result2 = $link->query("SELECT learners_photo FROM learners WHERE  learners_id='" . $learners_id . "'");



//notifications for new license


$query_noti = "SELECT  COUNT(scheduled) FROM users_learners WHERE  scheduled= 0";
$qresult = mysqli_query($link, $query_noti);
$row_noti = mysqli_fetch_assoc($qresult);
$notification_new = $row_noti["COUNT(scheduled)"];




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

    <title>Driving Schools | <?= basename($_SERVER['PHP_SELF'], '.php') ?> </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type=text/css href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="Sidemenu/Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="Sidemenu/Header/build/css/custom.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    </script>




</head>

<style>
    .img-circle profile_img {
        width: 50px;
    }
</style>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="profile clearfix" style="color: white;">
                        <div class="profile_details">
                            <img src="logo.png" alt="...">
                        </div>
                        <h5 style="text-align: center;">DLMS - Learners Services</h5>
                        <div class="text-light" style="text-align: center;">
                            <span>Welcome,</span>
                            <h2 class="text-light"> <?php echo  $data["learners_name"]  ?></h2>
                        </div>

                    </div>
                    

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="Dashboard.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                                <li><a href="users.php"><i class="fa fa-users"></i> Users </a></li>
                                >
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
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">


                                    <?php

                                    if ($result2->num_rows > 0 && $data['learners_photo'] != null) { ?>
                                        <?php while ($row = $result2->fetch_assoc()) { ?>
                                            <img src="data:learners_photo/jpg;charset=utf8;base64,<?php echo base64_encode($row['learners_photo']); ?>" />
                                        <?php } ?>
                                    <?php } else { ?>
                                        <img src="Sidemenu/Header/production/images/admin.png" alt="...">
                                    <?php } ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <a class="dropdown-item" href="includes/logout.inc.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell" style="color: #15202c;"></i>
                                    <span class="badge ">
                                        <?php
                                        if ($notification_new > 0) { ?>
                                            <i class="fa fa-circle" aria-hidden="true" style="font-size:15px;color:red"></i>
                                        <?php } ?>

                                    </span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <?php if ($notification_new > 0) { ?>
                                        <a class="dropdown-item" href="users.php">
                                            Schdule sessions for new users
                                        </a>
                                    <?php  } ?>

                                </ul>
                            </li>
                    </nav>
                </div>
            </div>