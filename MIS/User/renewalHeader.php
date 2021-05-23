<?php
session_start();
?>
<?php
if (!isset($_SESSION["useruid"])) {
    header('location: ../User/login.php');
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

  

    <title translate='no'>license renewal </title>
     <!-- Bootstrap -->
    <link rel="stylesheet" type=text/css href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

  <!-- Font Awesome -->
    <link href="Header/vendors/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="Header/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
          <div class="profile_details">
                            <img src="../logo.png" alt="...">
                        </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="Header/production/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2 translate='no'> <?php echo($_SESSION["useruid"]);?></h2>
              </div>
            </div>
            
            <!-- <div class="profile clearfix" style="color: white;">
                        <div class="profile_details">
                            <img src="logo.png" alt="...">
                        </div>
                            <h4 style="text-align: center;">DLMS - Admin</h4>
                            <div class="text-light" style="text-align: center;">
                                <span>Welcome,</span>
                                <h2 class="text-light"> <?php echo  $data["admin_name"] ?></h2>
                            </div>
                        
                    </div> -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="renewaldashboard.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>

                 <li><a href="RenewalRegistration.php"><i class="fa fa-certificate"></i> License Renewal </a></li>

                  <li><a href="renewalactivitylog.php"><i class="fa fa-edit"></i> Activity Log </a></li>
                 

                
        
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
              <li class="nav-item" style="padding-left: 15px;">
              <div id="google_translate_element" style="padding-left: 35px;padding-right: 15px;">Select Language</div>
              </li>
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user" style="color: #15202c;"></i>

                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">  
                  <a class="dropdown-item"  href="javascript:;"><strong>Help</strong></a>
                    <a class="dropdown-item"  href=".../../../../includes/logout.inc.php"><i class="fa fa-sign-out pull-right"></i><strong> Log Out</strong></a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell" style="color: #15202c;"></i>
                    <span class="badge bg-green"></span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <a class="dropdown-item">
                      <strong>See All Notifications</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
              </ul>
            </nav>
          </div>
        </div>