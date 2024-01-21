
<?php
require_once('config.php');
if(isset($_SESSION['username'])){
  $loggedInUsername = $_SESSION['username'];
  $loggedInUser=mysqli_fetch_array($conn->query("select * from users where username='$loggedInUsername'"));
  $loggedInUserid=$loggedInUser['id'];
}


function GetcategoryId($category)
{


    global $conn;
    if($category=='الكل'){
      return '';
    }
    else{

      $searhresult=$conn->query("select id  from categoris where name = '$category'");
      $searhresult=mysqli_fetch_array($searhresult);
      return $searhresult; 
    }
  


}
if( GetcategoryId($_GET['category'])=='')
{
  $categoryid=GetcategoryId($_GET['category']);

}else{
  $categoryid=GetcategoryId($_GET['category'])['id'];
}










?>
<?php


function images(){

 global $categoryid;
 global $conn;
 if($categoryid=='')
 {
  $select="select id,name from images where  is_NotAvailable=0  order by id desc ";

 }
 else{
  $select="select id,name from images where categoryid=$categoryid  and is_NotAvailable=0 order by id desc";
}
 $selectresult=mysqli_query($conn,$select);
 return($selectresult);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gallery</title>
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
    <link href="assets/css/foodi.css" rel="stylesheet"> 
    <!-- -->
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/gallery.css" rel="stylesheet">

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
          <li><a href="home.php"  >الرئيسية</a></li>
          <!-- <li><a href="about.php">حول</a></li> -->
          <li class="dropdown"><a href="#" class="active"><span>المعرض</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
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

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center mt-3">
            <h2> 

             <?= $_GET['category']?> 
            
            </h2>
   

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

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
      <p>حافظ على لحظاتك الثمينة اكتشف وتواصل ووظف افضل المصورين بسهوله</p>   </div>      </div>
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
  <script src="assets/js/jquery.js"></script>
  <script>
    $(function(){
        var flag = false;
        $('#likeButton').click(function(){
          $likesCount = parseInt($('#likesCountSpan').html());
          var data = { imageId: <?=$_GET["img"]?>, userId: <?=$loggedInUserid?>};
          $.post('Profile/Like.php', data , function(result){
            $('#likeButton').toggleClass("active");
            $('#likesCountSpan').html(result);
          });
        });
    });
    $(function(){
        var flag = false;
        $('#saveButton').click(function(){
          // $likesCount = parseInt($('#likesCountSpan').html());
          var data = { imageId: <?=$_GET["img"]?>, userId: <?=$loggedInUserid?>};
          $.post('Profile/save.php', data , function(){
            $('#saveButton').toggleClass("active");
         
          });
        });
    });
    $(function(){
        var flag = false;
        $('#folowButton').click(function(){
          // $likesCount = parseInt($('#likesCountSpan').html());
          var data = { ownerId: <?=$imgownerinfo[2]?>, userId: <?=$loggedInUserid?>};
          $.post('Profile/folow.php', data , function(){
            $('#user').toggleClass("fa fa-user-plus");
            $('#user').toggleClass("fa-solid fa-user-check  ");

            // $('#folowSpan').html('jhhh');
            console.log('jjjj')
         
          });
        });
    });
    
  </script>

</body>

</html>