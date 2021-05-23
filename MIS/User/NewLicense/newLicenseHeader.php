<?php
session_start();
if (!isset($_SESSION["useruid"])) {
  header('location: ../../../Main/user-login.php');
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
  <link rel="stylesheet" href="../../includes/translate.css">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
  <script type="text/javascript" src="../../includes/translate.js"></script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <title translate='no'>DLMS - User </title>
  <!-- Bootstrap -->
  <link rel="stylesheet" type=text/css href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link href="Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


  <!-- Custom Theme Style -->
  <link href="Header/build/css/custom.min.css" rel="stylesheet">
  <title translate='no'>DLMS</title>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_details">
              <img src="../../includes/logo.png" alt="..." style="margin-bottom: -30px;">
              <h6 class="text-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM users WHERE user_id = $id;";
                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "Welcome, <span translate='no'>" . $row["user_name"] . "</span>!";
                }
                ?> </h6>
            </div>
          </div>

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="dashboard.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>

                <li><a href="RegisterForLicense.php"><i class="fa fa-user-plus"></i> Register for License </a></li>

                <li><a><i class="fa fa-edit"></i> Exams <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="writtenExams.php">Written Exam</a></li>
                    <li><a href="trial.php">Practical Exam</a></li>
                  </ul>
                </li>

                <li><a href="Learners.php"><i class="fa fa-users"></i> Driving Schools </a></li>

                <li><a href="activity.php"><i class="fa fa-list-ul"></i> Activity Log</a></li>
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
            <ul class=" navbar-right ">
              <li class="nav-item" style="padding-left: 15px;">
                <div id="google_translate_element" style="padding-left: 35px;padding-right: 15px;">Select Language</div>
              </li>


              <!-- <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user" style="color: #15202c;"></i>

                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="javascript:;"><strong>Help</strong></a>
                  <a class="dropdown-item" href=".../../../../includes/logout.inc.php"><i class="fa fa-sign-out pull-right"></i><strong> Log Out</strong></a>
                </div>
              </li> -->
              <li class="nav-item" style="padding-left: 15px;">
                <a href=".../../../../includes/logout.inc.php"><i class="fa fa-sign-out pull-right"></i><strong> Log Out</strong></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>