<?php


require_once('config.php');
if(isset($_SESSION['username'])){
  $loggedInUsername = $_SESSION['username'];
$loggedInUser=mysqli_fetch_array($conn->query("select * from users where username='$loggedInUsername'"));
$loggedInUserid=$loggedInUser['id'];
}
$reports=$conn->query("select * from reports");

function reporter($id)
{
  global $conn;
  // $reporter=$conn->query("select * from users where id=$id");
  $reporter=mysqli_fetch_array($conn->query("select * from users where id=$id"));
  return $reporter;
}
function reportesum($id)
{
  global $conn;
  $reporter=mysqli_fetch_array($conn->query("select count(id) from reports where 	image_id=$id"));
  return $reporter['count(id)'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reports </title>
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

    <!-- our project just needs Font Awesome Solid + Brands -->

    <link href="assets/vendor/fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free-6.4.2-web/css/brands.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free-6.4.2-web/css/solid.css" rel="stylesheet">

    <!-- -->
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/reports.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
        <li><a href="index.html" class="active" >الرئيسية</a></li>
        <!-- <li><a href="about.html">حول</a></li> -->
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
        <!-- <li><a href="contact.html">تواصل</a></li> -->
        <li><a href="users.php">ادارة المستخدمين</a></li>
        <li><a href="reports.php" class="active">ادارة البلاغات</a></li>
      </ul>
    </nav><!-- .navbar -->
    <a href="index.html" class="logo d-flex align-items-center  me-auto me-lg-0">
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

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>   ادارة البلاغات</h2>
            <!-- <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p> -->

            <!-- <a class="cta-btn" href="contact.html">Available for hire</a> -->

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <div class="card m-5" dir="rtl">
      <div class="card-body">
       

        <!-- Table with hoverable rows -->
        <table class="table table-hover table-user">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col"> صاحب البلاغ  </th>
              <th scope="col">نوع البلاغ </th>
              <th scope="col">وصف البلاغ</th>
              <th scope="col">عدد البلاغات </th>
              <th scope="col">الصوره</th>
            </tr>
          </thead>
          <tbody>
            
              <?php
              foreach($reports as $report){?>
              <tr>
               <td><?=reporter($report['reporter_id'])['username']?></td>
               <td><?=$report['type'] ?></td> 
               <td><?=$report['description']?> </td> 
               <td><?=reportesum($report['image_id'])?></td> 
              <td> <a href="image-details.php?img=<?=$report['image_id']?>"> <span class='bi bi-filter-square ms-1'></span>تفاصيل الصورة</a>
          </td>
          </tr>
                   <?php }
              
              ?>
           

          </tbody>
        </table>
        <!-- End Table with hoverable rows -->

      </div>
    </div>

  </main><!-- End #main -->

<!-- ======= Footer ======= -->
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