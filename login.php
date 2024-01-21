<?php

require_once('config.php');
$err='';
if (isset($_POST['create'])){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $selectresult=$conn->query("select username,password,is_locked from users where username='$username' and password='$password' ");
  $selectresult=mysqli_fetch_array($selectresult);
  $userfounded=true;

  if(!isset($selectresult) )
  {
  $err='خطأ في اسم المستخدم او كلمة السر حاول مرة اخرى';
  }
else
  {
    if($selectresult['is_locked']==1){
      $err='تم ايقاف حسابك';

    }
    else{
      $_SESSION['username']=$username;
      header("location:home.php?username=$username");
    }
  

  }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PhotoFolio Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/whitelogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet"> -->
    
  
  <!-- our project just needs Font Awesome Solid + Brands -->

    <link href="assets/vendor/fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free-6.4.2-web/css/brands.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free-6.4.2-web/css/solid.css" rel="stylesheet">
    <link href="assets/css/foodi.css" rel="stylesheet"> 
    <!-- -->

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/login.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<section>
   <!-- ======= Header ======= -->
   <header id="header" class="header d-flex align-items-center fixed-top" >
    <div class="container-fluid d-flex align-items-center justify-content-between">
  
      <div class="header-social-links">
        <!-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a> -->
        <!-- <a href="login.php" > تسجيل دخول </a> -->
        <!-- <a href="login.php">تسجيل دخول </a> -->
      </div>
   
  
      <nav id="navbar" class="navbar" dir="rtl">
        <ul>
          <li><a href="home.php"  >الرئيسية</a></li>
          <!-- <li><a href="about.php">حول</a></li> -->
          <li class="dropdown"><a href="#"><span>المعرض</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
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
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="me-1">فوتوغرافيا</h1>
        <!-- <i class="bi bi-camera"></i> -->
        <img src="assets/img/whitelogo.png" class="bi bi-camera">
      </a>
   
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
  
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center backround" data-aos="fade" data-aos-delay="1500">
    <div class="container" >
      <div class="row justify-content-center" >
        <div class="col-lg-6 text-center" >
          <!-- <h2 >موقع<span> فوتوغرافيا </span></h2> -->
          <!-- <p>Blanditiis praesentium aliquam illum tempore incidunt debitis dolorem magni est deserunt sed qui libero. Qui voluptas amet.</p> -->
        
        </div>
        
      
          
      
      </div>
      
    </div>
  </section><!-- End Hero Section -->
</section>

  <main id="main" data-aos="fade" data-aos-delay="1500" >
    <form method="post" >
      <section class="vh-100 gradient-custom" >
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card text-dark rounded-4"  >
                <div class="card-body p-3 text-center" dir="rtl">
      
                  <div class="mb-md-5 mt-md-4 pb-3">
      
                    <h2 class="fw-bold mb-2 text-uppercase">تسجيل الدخول</h2>
                    <p class=" mb-5">من فضلك ادخل اسم المستخدم وكلمة السر!</p>
      
                    <div class="form-outline form-white mb-4 text-end">
                      <label class="form-label" for="typeEmailX">اسم المستخدم</label>
                      <input type="text" id="username" name="username" class="form-control form-control-lg  border border-secondary" required />
                      
                    </div>
      
                    
                    <div class="form-outline form-white mb-4 text-end">
                      <label class="form-label" for="typePasswordX">كلمة السر</label>
                      <input type="password" name="password" id="password" class="form-control form-control-lg border border-secondary" required />
                      
                    </div>
                    <label class="form-label text-danger mb-3" for="typeEmailX"><?php echo $err?> </label>

      
                    <p class="small mb-5 pb-lg-2"><a class="" href="#!">هل نسيت كلمة السر</a></p>
      
                    <button class="cta-btn" type="submit" name="create">تسجيل الدخول</button>
                  </div>
      
                  <div>

                    <p class="mb-0">هل تريد انشاء حساب <a href="signup.php"  class=" fw-bold">كمصور</a> ام <a href="seekersignup.php"  class=" fw-bold">باحث</a> عن مصورين   
                    </p>
                  </div>
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>




  </main><!-- End #main -->
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="container">
    <div class="copyright">
       <strong><span>فوتوغرافيا</span></strong>
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
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
  <script >
    document.getElementById('hero').style.backgroundImage='url(assets/img/gallery/gallery-12.jpg)'


  </script>

</body>

</html>