<?php
require_once('config.php');

if(isset($_SESSION['username'])){
  $loggedInUsername = $_SESSION['username'];
$loggedInUser=mysqli_fetch_array($conn->query("select * from users where username='$loggedInUsername'"));
$loggedInUserid=$loggedInUser['id'];
}

if(isset($_GET['logout']))
{
  session_destroy();
  header('location:home.php');
 
}



?>
<?php


function images(){

 global $conn;
$select='select id,name from images where is_NotAvailable=0 order by id desc';
$selectresult=mysqli_query($conn,$select);
return($selectresult);

}




?>
<?php

if(isset($_POST['search']) ){
  $key=$_POST['search'];
  header("location:filtering.php?key=$key");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/whitelogo.png" rel="icon">
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->    
  
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
  <link href="assets/css/index2.css" rel="stylesheet">


</head>

<body>

<section>
    <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top " >
    <div class="container-fluid d-flex align-items-center justify-content-between">
 
      <div class="header-social-links ">
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
          <li><a href="home.php" class="active" >الرئيسية</a></li>
          <!-- <li><a href="about.php">حول</a></li> -->
          <li class="dropdown"><a href="#"><span>المعرض</span>
           <i class="bi bi-chevron-down dropdown-indicator"></i></a>
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

       
        <h1 class="me-1">فوتوغرافيا</h1>

        <img src="assets/img/whitelogo.png" class="bi bi-camera">
      </a>
   
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero"  class="hero d-flex flex-column justify-content-center align-items-center backround " data-aos="fade" data-aos-delay="1500">
    <div class="container" >
      <div class="row justify-content-center" >
        <div class="col-lg-6 text-center mt-5" dir="rtl" >
            <h2 >موقع<span> فوتوغرافيا </span></h2>
          <p>حافظ على لحظاتك الثمينة اكتشف وتواصل ووظف افضل المصورين بسهوله</p>
        
          </div>
        
      
          <div class="search col-lg-9 " dir="rtl">
              <form method="post">
              <input type="text" class="search-input" placeholder="بحث..." name="search" >
              <button  class="search-icon border-0">
                  <i class="fa fa-search"></i>
              </button>
              </form>
          </div>
      
      </div>
      
    </div>
  </section><!-- End Hero Section -->
</section>

  <main id="main" data-aos="fade" data-aos-delay="1500" style="z-index=88888">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container-fluid">

        <div class="row gy-4 justify-content-center">
        <?php
  
  $images= images();

  foreach($images as $row){

    
    ?>
     <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="uploads/<?php echo $row['name']?>" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">

                  <a href="uploads/<?php echo $row['name']?>" title="" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                  <a href="<?php  echo'image-details.php?img='.$row['id']?>" class="details-link"><i class="bi bi-link-45deg"></i></a>

      
              </div>
            </div>
          </div><!-- End Gallery Item -->
    <?php }?>
        </div>

      </div>
    </section><!-- End Gallery Section -->
  
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

  <script >
    document.getElementById('hero').style.backgroundImage='url(assets/img/gallery/gallery-12.jpg)'


  </script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>