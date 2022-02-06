<!-- <?php

      require '../Admin/assets/php/config.php';
      $query_tot = "SELECT  COUNT(user_id) FROM users ";
      $query_tot = mysqli_query($link, $query_tot);
      $row_count = mysqli_fetch_assoc($query_tot);
      $total_users = $row_count["COUNT(user_id)"];

      $admin_tot = "SELECT  COUNT(admin_id) FROM admin ";
      $admin_tot = mysqli_query($link, $admin_tot);
      $admin_count = mysqli_fetch_assoc($admin_tot);
      $total_admin = $admin_count["COUNT(admin_id)"];

      $query_learners = "SELECT  COUNT(learners_id) FROM learners ";
      $query_learners = mysqli_query($link, $query_learners);
      $row_count_learners = mysqli_fetch_assoc($query_learners);
      $total_learners = $row_count_learners["COUNT(learners_id)"];

      ?> -->

<!DOCTYPE html>
<html lang="en">

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="google-site-verification" content="Vl3pRBJzwoHbGMvNcHKOXZnS-CTlk3HnPbg6UHJpkTg" />
  <title translate="no">DLMS-Driving License Management System</title>
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
            <img src="assets/img/logo.png">
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
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->
      <div id="google_translate_element" style="padding-left: 35px;padding-right: 15px;">Language</div>

    </div>

  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome to <span>DLMS</span></h1>
      <h2>DLMS - Driving License Management System<br>incorporated with<br> Department of Motor Traffic <br>Sri
        Lanka </h2>
      <div class="d-flex">
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
        <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox btn-watch-video" data-vbtype="video" data-autoplay="true"> See User Manual <i class="icofont-play-alt-2"></i></a>
      </div>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <a href="user-register.php">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><i class="bx bxs-user-plus"></i></div>
                <h4 class="title">Create New Account
            </a></h4>
            <p class="description">Not yet Registered? Create a new account to register for a new licnese or
              Renew your license</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <a href="user-login.php">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bxs-user-check"></i></div>
              <h4 class="title">User Log In
          </a></h4>
          <p class="description">Already has an account? Click Log in to log into your account</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
        <a href="../Admin/assets/php/Admin-Login.php">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="bx bxs-user-detail"></i></div>
            <h4 class="title">Admin Log In
        </a></h4>
        <p class="description">Log in as an administrator</p>
      </div>
      </div>

      <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
        <a role="button" href="../Driving_School/index.php">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="bx bxs-car"></i></div>
            <h4 class="title">Learners Log In
        </a></h4>
        <p class="description">Log in as a driving school (learners)</p>
      </div>
      </div>

      </div>

      </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <h3>Find Out More <span>About Us</span></h3>
          <p>Driving License Management System is designed for the use of Department of Motor Traffic Sri
            Lanka to automate the
            process of issuing driving license and to facilitate the flow of information within the
            department.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/license.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <p class="font-italic">
              We make the basic operations of issuing driving license more efficient, provide fast
              response to users and store and
              retrieve information accurately. Our main objectives are,
            </p>
            <ul>
              <li>
                <i class="bx bx-id-card"></i>
                <div>
                  <h5>Ease up the Licensing Process</h5>
                  <p>Your license process will be easier than manual process.</p>
                </div>
              </li>
              <li>
                <i class="bx bx-time"></i>
                <div>
                  <h5>Reduce Time Wastage</h5>
                  <p>We gurantee that you won't waste your time as manual system.</p>
                </div>
              </li>
              <li>
                <i class="bx bx-money"></i>
                <div>
                  <h5>Reduce Operational Cost</h5>
                  <p>Your transport costs to visit RMV will be saved.</p>
                </div>
              </li>
            </ul>
            <!-- <p>
              We Introduce a digital license process to replace
              the tedious paper based process
            </p> -->
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <h3>Check our <span>Services</span></h3>
          <p>We introduce a digital license process to replace the tedious paper based process.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="icofont-contact-add"></i></div>
              <h4>New License</h4>
              <p>You can apply for new license once you created an account and you can upload all the
                relevant required documents which
                reuired. You will be notified what are the documents needed once you registered.
              </p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="icofont-id-card"></i></div>
              <h4>Renew License</h4>
              <p>You can apply for Renew your license once you created an account and you can upload all
                the relevant required documents which
                reuired. You will be notified what are the documents needed once you registered</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="icofont-file-document"></i></div>
              <h4>Online Study Materials and Payments</h4>
              <p>We will upload some model papers and answers that is simillar to written exam to prepare
                you for the exam and you
                can pay the required amounts online through our system</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="icofont-ui-calendar"></i></div>
              <h4>Exam Scheduling</h4>
              <p>You will be scheduled for the written exam and trial exam through our system and you can
                view it once it is done</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="icofont-car-alt-4"></i></div>
              <h4>Driving Schools</h4>
              <p>You can view the available registered driving schools(learners) through our system once
                you applied for the new license</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="icofont-license"></i></div>
              <h4>License Issuing</h4>
              <p>We will send your temporary license once you passed the written exam though our system
                and we will inform you to
                collect your new driving license or renewed license once it is ready
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <div class="section-title">
      <h2>Some Learners Services Registered</h2>
    </div>
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="zoom-in">

        <div class="owl-carousel testimonials-carousel">

          <div class="testimonial-item">
            <img src="assets/img/bimal_learners.png" class="testimonial-img" alt="">
            <h3>Bimal Learners</h3>
            <h4>Head Office - Katuwawala</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Branches: Maharagama, Nugegoda, Katubedda, Kottawa, Moratuwa, Thibirigasyaya.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <div class="testimonial-item">
            <img src="assets/img/daya_learners.png" class="testimonial-img" alt="">
            <h3>Daya Learners</h3>
            <h4>Head Office - Colombo 04</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Branches: Rathmalana, Battaramulla
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <div class="testimonial-item">
            <img src="assets/img/perera_learners.jpg" class="testimonial-img" alt="">
            <h3>Perera Learners</h3>
            <h4>Head Office - Nugegoda</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Branches: Rathmalana, Battaramulla, Moratuwa, Panadura, Colombo 4, Maharagama
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <div class="testimonial-item">
            <img src="assets/img/manore_learners.jpg" class="testimonial-img" alt="">
            <h3>Manore Learners</h3>
            <h4>Head Office - Wellawatta</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Branches: Gampaha, Yakkala, Maharagama, Kaluthara
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <h3><span>Contact Us</span></h3>
          <p>You can contact us for any query from following resources.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Department of Motor Traffic Rd, Boralesgamuwa</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>dlms2021@gmail.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>0112-123123</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.519665018833!2d79.90867251477239!3d6.828117695065153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25aa4550576d7%3A0x3438a763270e489a!2sDepartment%20of%20Motor%20Traffic%20Rd%2C%20Boralesgamuwa!5e0!3m2!1sen!2slk!4v1620285042844!5m2!1sen!2slk" width="100%" height="384px" style="border:0;" frameborder="0" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <p>if you have any quires send us your message. Reply will be sent to the email address
                entered.</p>
              <div class="form-row">
                <div class="col form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Feedback"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

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
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Online Study Materials and
                  Payments</a></li>
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
