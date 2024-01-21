<?php

require_once('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.8.1/src/Exception.php';
require 'PHPMailer-6.8.1/src/PHPMailer.php';
require 'PHPMailer-6.8.1/src/SMTP.php';


if(isset($_POST['send'])){
  

   $name=$_POST['name'];
   $email=$_POST['email'];
   $message=$_POST['message'];
   $subject=$_POST['subject'];
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = "salesamia1999@gmail.com";
    $mail->Password   = 'samia1999saleh'; //app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; // 587
    $mail->CharSet = 'UTF-8'; // Set UTF-8 character encoding
    $mail->setFrom($email);
    $mail->addAddress($_POST['email']); 
    $mail->isHTML(true);
    $mail->Subject =$subject;
    $mail->Body    =$message;
    $mail->send();

 

   
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PhotoFolio Bootstrap Template - Contact</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/whitelogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/contact.css" rel="stylesheet">


</head>

<body>

 <!-- ======= Header ======= -->
 <header id="header" class="header d-flex align-items-center fixed-top" >
    <div class="container-fluid d-flex align-items-center justify-content-between">
  
      <div class="header-social-links">

        <?php
        if(isset($_SESSION['username'])){
          ?>
          <a href="profile.php?username=<?=$_SESSION['username']?>"><i class="fa fa-user"></i></a>
       <?php }
        else{?>
                <a href="login.php">تسجيل دخول </a>
      <?php  }
        ?>
      </div>
   
  
      <nav id="navbar" class="navbar" dir="rtl">
        <ul>
          <li><a href="home.php"  >الرئيسية</a></li>
          <li class="dropdown"><a href="#" class="active"><span>المعرض</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
            <?php
                    $categoris=mysqli_query($conn,'select * from categoris');
                    while($categori = mysqli_fetch_array($categoris)){
                   
                    ?>

                    <li><a href="gallery.php?category=<?=$categori['name']?>"><?=$categori['name']?></a></li>
                    <?php  } ?>
              <li><a href="gallery.php?category=الكل">الكل</a></li>
            </ul>
          </li>
          <li><a href="photographers.php?city=الكل">المصورين</a></li>
          <li><a href="contact.php">تواصل</a></li>
        </ul>
      </nav><!-- .navbar -->
      <a href="home.php" class="logo d-flex align-items-center  me-auto me-lg-0">
        <h1 class="me-1">فوتوغرافيا</h1>

        <img src="assets/img/whitelogo.png" class="bi bi-camera">
      </a>
   
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
  
    </div>
  </header><!-- End Header -->
  
  <main id="main" data-aos="fade" data-aos-delay="1500">


    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>تواصل</h2>
           
          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

 
    <section id="contact" class="contact" dir="rtl">
      <div class="container">

      

        <div class="row justify-content-center mt-4">

          <div class="col-lg-9">
            <form action="contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="اسمك " required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="الايميل الخاص بك " required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="الموضوع" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="الرساله" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit" name="send">ارسال </button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="container">
    <div class="copyright">
       <strong><span>فوتوغرافيا</span></strong>
    </div>
    <div class="credits">
    <p>حافظ على لحظاتك الثمينة اكتشف وتواصل ووظف افضل المصورين بسهوله</p>   </div>
  </div>
</footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>