<?php

require_once('config.php');
// session_start();
if(isset($_SESSION['username'])){
$loggedInUsername = $_SESSION['username'];
$loggedInUser=mysqli_fetch_array($conn->query("select * from users where username='$loggedInUsername'"));
$loggedInUserid=$loggedInUser['id'];

}
 if (isset($_POST['create'])){
  $category=$_POST['category'];
  $tags=$_POST['tags'];
  $title=$_POST['title'];
  if(isset($_FILES['file']['name'])){

    $totalfils=count($_FILES['file']['name']);
    $filearray=[];
   for ($i=0;$i< $totalfils; $i++){
    $imagename=$_FILES['file']['name'][$i];
    $tempName=$_FILES['file']['tmp_name'][$i];
    $imageExtension=explode('.',$imagename);
    $imageExtension=strtolower(end($imageExtension));
    $newimagename=uniqid().'.'.$imageExtension;
    move_uploaded_file($tempName,'uploads/'.$newimagename);
    $filearray[]=$newimagename;
    
  
   }
   foreach( $filearray as  $file){
    $conn->query("insert into images (name,ownerid,categoryId,downloadenumber,viewnumber,tags,title,is_NotAvailable)
   values('$file','$loggedInUserid',$category,'0',0,'$tags','$title',0)");
  }
  
  
    // $_SESSION['username']= 'samia';
    header("location:profile.php?username=".$_SESSION['username']);
  }





}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Uploade-image</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/whitelogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  
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
  <link href="assets/vendor/use-bootstrap-tag/use-bootstrap-tag.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  
  <link href="assets/css/signup.css" rel="stylesheet">

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

      </div>
   
  
      <nav id="navbar" class="navbar" dir="rtl">
        <ul>
          <li><a href="home.php" >الرئيسية</a></li>
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
        </div>
      </div>   
    </div>
  </section><!-- End Hero Section -->
</section>

  <main id="main" data-aos="fade" data-aos-delay="1500" >
 <div>
 </div>
 <form  method="post" enctype="multipart/form-data">
  <section class="vh-100 gradient-custom" >
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card text-dark rounded-4"  >
            <div class="card-body p-3 ">
  
              <div class="mb-md-5 mt-md-4 pb-3 text-center" dir="rtl">
  
                <h2 class="fw-bold mb-2 text-uppercase">رفع صورة </h2>
                <p class=" mb-5 "> من فضلك قم بادخال الحقول المطلوبة</p>
  
                <div class="form-outline form-white mb-4 text-end">
                  
                  <input type="file" name =" file[]" id="files" accept=".jpg, jpeg ,png" class="form-control form-control-lg  border border-secondary" required multiple/>
                  
                </div>
    
                <div class="form-group form-outline form-white mb-4 text-end" >
                  <label for='' class="form-label me-2">
                    اختر مجال الصوره  :
                  </label>
                  <select name="category"  class="form-control border border-secondary rounded-3">
                    <?php
                    $fields=mysqli_query($conn,'select * from categoris');
                    while($field = mysqli_fetch_array($fields)){
                   
                    ?>
                    <option value="<?php echo $field['id']?>"><?php echo $field['name']?> </option>
                    <?php  } ?>
                    
                  </select>
                </div>
                <div class="form-outline form-white mb-4 text-end">
                  <label class="form-label me-2" for="address"> عنوان الصورة:</label>
                  <input name="title" type="text" id="title" class="form-control form-control-lg border border-secondary" required/>
                  
                </div>
                <div class="form-outline form-white mb-4 text-end">
                  <label class="form-label me-2" for="address"> كلمات دلالية :</label>
                  <!-- <input name="tags" type="text" id="tags" class="form-control form-control-lg border border-secondary" required/> -->
                  <input type="text" name="tags" class="form-control form-control-lg border border-secondary" placeholder="" data-ub-tag-separator=" " id="example-separator" required>

                </div>

                <div class="text-center">
                  <button class="btn btn-outline-dark btn-lg px-5 cta-btn" name="create" type="submit"> رفع الصور</button>
                </div>
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
<!-- <footer id="footer" class="footer">
  <div class="container">
    <div class="copyright">
       <strong><span>فوتوغرافيا</span></strong>
    </div>
    <div class="credits"> -->
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    <!-- </div>
  </div>
</footer> -->
<!-- End Footer -->

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
  <script src="assets/vendor/use-bootstrap-tag/use-bootstrap-tag.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script >
    document.getElementById('hero').style.backgroundImage='url(assets/img/gallery/gallery-12.jpg)'

    UseBootstrapTag(document.getElementById('example-separator'))
  </script>

</body>

</html>