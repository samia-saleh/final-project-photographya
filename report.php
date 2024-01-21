<?php

require_once('config.php');
$loggedInUsername = $_SESSION['username'];
$loggedInUser=mysqli_fetch_array($conn->query("select * from users where username='$loggedInUsername'"));
$loggedInUserid=$loggedInUser['id'];
$imgid=$_GET['img'];
// $imgid=7;

if(isset($_POST['report']))
{
  $type=$_POST['type'];
  $description=$_POST['description'];
  $conn->query("insert into reports (	type,description,image_id,reporter_id) values ('$type','$description',$imgid,$loggedInUserid) ");

  
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Report</title>
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
  <link href="assets/css/report.css" rel="stylesheet">

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
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
      </button> -->

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
                    <!-- <option value="<?php echo $field['id']?>"><?php echo $field['name']?> </option> -->
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

  <main id="main" data-aos="fade" data-aos-delay="1500"  >
    <form method="post" >
      <section class="vh-100 gradient-custom" >
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card text-dark rounded-4"  >
                <div class="card-body p-3 text-center" dir="rtl">
      
                  <div class="mb-md-5 mt-md-4 pb-3">
      
                    <h2 class="fw-bold mb-5 text-uppercase">إبلاغ</h2>
                    <!-- <p class=" mb-5">    </p> -->
      
                    <div class="form-outline form-white mb-4 text-end">
                      <!-- <label class="form-label" for="typeEmailX">اسم المستخدم</label> -->
                      <!-- <input type="text" id="typeEmailX" class="form-control form-control-lg  border border-secondary" required /> -->
                      <div class="dropdown col-lg-12 text-end  " >
                           
                             <label for='' class="form-label me-2">
                             إختر سبب البلاغ
                         </label>
                        <select name="type"  class="form-control border border-secondary rounded-3" >
                   
                  
                        <option value=" انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية"> انتهاك حقوق الطبع والنشر أو مشكلة الخصوصية  </option>
                         <option value=" محتوى جنسي عنيف أو غير لائق"> محتوى جنسي عنيف أو غير لائق</option>
                         <option value=" محتوى غير مرغوب فيه أو علامة مائيه ">    محتوى غير مرغوب فيه أو علامة مائيه </option>
                         <option value=" اخرى"> اخرى</option>
                    
                    
                  </select>
                      </div>
                  
                    </div>
      
                    
                    <div class="form-outline form-white mb-4 text-end">
                      <label class="form-label" for="typePasswordX"> تفاصيل</label>
                      <textarea name="description" id="" class="form-control form-control-lg border border-secondary" required >
                      </textarea>
                      
                    </div>
                    <button class="cta-btn" type="submit" name="report"> إبلاغ   </button>
                    <!-- <button class="cta-btn bg-white text-dark border border-secondary" type="submit"> الغاء   </button> -->
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