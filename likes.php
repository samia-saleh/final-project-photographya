<?php
require_once('config.php');
$username=$_GET["username"];
$userprofile=mysqli_fetch_array($conn->query("select * from users where username='$username'"));
$userprofileid=$userprofile['id'];
$role=$userprofile['role'];
$userprofilename=$userprofile['username'];

if(isset($_SESSION['username'])){
  $loggedInUsername = $_SESSION['username'];
$loggedInUser=mysqli_fetch_array($conn->query("select * from users where username='$loggedInUsername'"));
$loggedInUserid=$loggedInUser['id'];
$is_folower=$conn->query("select user_Id  from photographer_followers where phtographer_id=$userprofileid and user_Id=$loggedInUserid");
$is_folower=mysqli_fetch_array($is_folower);
}





if(isset($_POST['changebio'])){
  $newbio=$_POST['bio'];
  $conn->query("update users set  bio='$newbio' where id=$loggedInUserid");
  header('location:profile.php?username='.$_SESSION['username']);


}



  function getLatestLikedImages(){
    global $conn;
    global $loggedInUser;

   $latestLikedImages = mysqli_query($conn,"select * from images, likes where images.id=likes.imageId and likes.userId=" . $loggedInUser['id'] . " and is_NotAvailable=0 order by likes.id desc limit 8");

   return $latestLikedImages;
   }



  function getImageCategory($image){
    global $conn;
                        
    $category = mysqli_fetch_array($conn->query("select name from categoris where id=".$image['categoryid']));
    
    return $category[0];
  }
  if(isset($_GET['logout']))
  {
    
    header('location:home.php?logout');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/whitelogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/use-bootstrap-tag/use-bootstrap-tag.min.css" rel="stylesheet">

     <!-- our project just needs Font Awesome Solid + Brands -->

     <link href="assets/vendor/fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
     <link href="assets/vendor/fontawesome-free-6.4.2-web/css/brands.css" rel="stylesheet">
     <link href="assets/vendor/fontawesome-free-6.4.2-web/css/solid.css" rel="stylesheet">
     <link href="assets/css/foodi.css" rel="stylesheet"> 
     <!-- -->
    <!-- Vendor CSS Files -->
  <!-- Template Main CSS File -->
  <link href="http://localhost/photographya/assets/css/profile.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- <button class="editcover">
     <i class="fa fa-edit"></i> تعديل الغلاف</button> -->
     
    
  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header"  dir="rtl" >
    <div class="d-flex flex-column">

      <div class="profile ">
        <img src="assets/img/avatar/<?php echo $userprofile['avatar'] ?>" alt="" class="img-fluid rounded-circle">

    
      
        <!-- <h1 class="text-light"><a href="home.php"> امون سعيد</a></h1> -->
        <!-- <h1 class="text-light"><a href="home.php">  </a></h1> -->
        <h1 class="text-light"><a href="home.php"> <?php echo $userprofile['username'] ;?> </a></h1>
      <?php 
      if($role !='باحث'){?>
                <div class="social-links mt-3 text-center">
          <!-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> -->
          <a href="<?=$userprofile['facebook']?>" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="<?=$userprofile['instagram']?>" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="<?=$userprofile['whatsapp']?>" class="google-plus"><i class="bx bxl-whatsapp"></i></a>
          <!-- <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
        </div>
     <?php }
      ?>
        
   
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="home.php" class="nav-link scrollto active"><i class="bx bx-home "></i> <span class="me-1">الرئيسيه</span></a></li>
          <li><a href="profile.php?username=<?=$userprofilename?>" class="nav-link scrollto"><i class="bx bx-user"></i> <span class="me-1">المعلومات الشخصيه</span></a></li>
          <?php
          if (  isset($loggedInUsername) and $username == $loggedInUsername  )
          {?>
            <li><a href="profile.php?username=<?=$userprofilename?>" class="nav-link scrollto"><i class="bx bx-bookmark"></i> <span class="me-1">سجل المحفوظات</span></a></li>
         
        <?php  }?>
        <?php
        if($role!='باحث'){?>
                      <li><a href="profile.php?username=<?=$userprofilename?>" class="nav-link scrollto"><i class="bx bx-image"></i> <span class="me-1">صور</span></a></li>
         
       <?php }
        ?>
            <?php
          if ( isset($loggedInUsername) and $username == $loggedInUsername )
          {?>
          <li><a href="profile.php?username=<?=$userprofilename?>" class="nav-link scrollto"><i class="bx bx-heart"></i> <span class="me-1">تسجيل الاعجاب</span></a></li>
          <?php  }?>
          <?php
          if ( isset($loggedInUsername) and $username == $loggedInUsername and $role!='باحث')
          {?>
          <li><a href="upload.php" class="nav-link scrollto"><i class="bx bx-upload"></i> <span class="me-1">رفع صور</span></a></li>
          <?php  }?>
          <?php if ( isset($loggedInUsername) and $username == $loggedInUsername and $loggedInUser['role']=='admin')
          {?>
          <li><a href="reports.php" class="nav-link scrollto"><i class="bx bx-cog"></i> <span class="me-1"> إدارة المحتوى </span></a></li>
          <?php  }?>
         <?php if (  isset($loggedInUsername) and $username == $loggedInUsername)
          {?>
          <li><a href="?logout&username=samia" class="nav-link scrollto"><i class="bx bx-log-out"></i> <span class="me-1"> تسجيل خروج</span></a></li>
          <?php  }?>
        
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center" >
    <div class="hero-container" data-aos="fade-in">
         </div>
  </section><!-- End Hero -->

  <main id="main" dir="rtl">

    <!-- End Portfolio Section-->
    <?php
          if ( isset($loggedInUsername) and $username == $loggedInUsername)
          {?>
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>تسجيل اعجاب </h2>

        </div>

        <section  class="portfolio ">
          <div class="container">
 
    
            
    
            
            <div class="row " data-aos="fade-up" data-aos-delay="100" >
            <?php
             foreach(getLatestLikedImages() as $row){
            ?>
             <div class="col-lg-4 col-md-6 portfolio-item " >
                <div class="portfolio-wrap" >
                  <img src="uploads/<?php echo $name=$row['name']?>" class="img-fluid" alt="" >
                  <div class="portfolio-links">
                    <a href="uploads/<?php echo $name=$row['name']?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bi bi-arrows-angle-expand"></i></a>
                    <a href="<?php  echo'image-details.php?img='.$name=$row['imageId']?>" title="More Details"><i class="bx bx-link"></i></a>
                  </div>
                </div>
              </div>
               <?php } ?>

            </div>
    
            
    
          </div>
        </section> 
     

      </div>
    </section>
    <!-- End Services Section -->
    <?php }?>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- <div id="preloader">
    <div class="line"></div>
  </div> -->
  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script >
    document.getElementById('hero').style.backgroundImage='url(assets/img/cover/<?php echo $userprofile['cover'] ?>)'


  </script>

  <!-- Template Main JS File -->
  <script src="assets/js/profile.js"></script>
  <script src="assets/js/jquery.js"></script>
  <script>


    $(function(){
        var flag = false;
        $('#folowButton').click(function(){
          
          // $likesCount = parseInt($('#likesCountSpan').html());
          var data = { ownerId: <?=$userprofileid?>, userId: <?=$loggedInUserid?>};
          $.post('Profile/folow.php', data , function(){
            $('#user').toggleClass("fa fa-user-plus");
            $('#user').toggleClass("fa-solid fa-user-check");

            // $('#folowSpan').html('jhhh');
            console.log('jjjj')
         
          });
        });
    });
    
  </script>

</body>

</html>
<?php



?>