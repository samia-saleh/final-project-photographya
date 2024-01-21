<?php

require_once('config.php');


$photographerinfo=mysqli_query($conn,"select id,username,avatar,cover from users where role='مصور' and is_locked=0");

function folowers($userid)
{
  global $conn;
  $folowersnumber=mysqli_fetch_array($conn->query("select count(id) from photographer_followers where 	phtographer_id='$userid'"));

  return $folowersnumber;
}
function images($userid)
{
  global $conn;
  $imagesum=mysqli_fetch_array($conn->query("select count(id) from images where ownerid='$userid'"));
  return $imagesum;
}
$Dropdownchoic='مجال تصوير';
if(isset($_POST['field'])  ){
  $key=$_POST['field'];
  header("location:photographerfaild.php?key=$key");
}
if(isset($_POST['scope']) ){
  $key=$_POST['scope'];
  header("location:photographerfilter.php?key=$key");
}


function GetcityId($city)
{


    global $conn;
    $searhresult=$conn->query("select id  from cities where name = '$city'");
    $searhresult=mysqli_fetch_array($searhresult);
    return $searhresult; 
    


}
function photographerinfo($searchkey)
{
    global $conn;
     $searhresult=mysqli_query($conn,"select *  from users where id=$searchkey ");

    return $searhresult;

}
function scop($searchkey)
{
    global $conn;
  $cityid=GetcityId($searchkey)['id'];
    $searhresult=mysqli_query($conn,"select *  from scope where  cityid=$cityid ");
    
    return $searhresult;

}
function GeCategoryId($category)
{


    global $conn;
    $searhresult=$conn->query("select id  from categoris where name = '$category'");
    $searhresult=mysqli_fetch_array($searhresult);
    return $searhresult;  
    


}
function photographer_fields($searchkey)
{
    global $conn;


  $cityid=GeCategoryId($searchkey)['id'];
  $searhresult=mysqli_query($conn,"select *  from photographer_fields where	category_id=$cityid ");
  
  return $searhresult;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Photographers</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/whitelogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

   <!-- our project just needs Font Awesome Solid + Brands -->

   <link href="assets/vendor/fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
   <link href="assets/vendor/fontawesome-free-6.4.2-web/css/brands.css" rel="stylesheet">
   <link href="assets/vendor/fontawesome-free-6.4.2-web/css/solid.css" rel="stylesheet"> 
   <!-- -->
  <!-- Template Main CSS File -->
  <link href="http://localhost/photographya/assets/css/photographerss.css" rel="stylesheet">

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
          <li class="dropdown"><a href="#" ><span>المعرض</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
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
          <li><a href="photographers.php?city=الكل"  class="active">المصورين</a></li>
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


  
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>المصورين</h2>
      
           
          </div>

          <nav dir='rtl' class="mb-1 ">
       <div class="nav nav-tabs" id="nav-tab" role="tablist" >
       <button class="nav-link active "  id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">  <span class='text-dark'>البححث بنطاق التصوير</span></button>
       <button class="nav-link " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">  <span class='text-dark'>البحث بمجال التصوير</span></button>
        </div>
    </nav>
     <div class="tab-content" id="nav-tabContent" dir='rtl'>
       <div class="tab-pane fade show active"  id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class=" form-group form-outline form-white mb-4 text-end col-4" >
          <form method="get">
          <select name="city" onchange="document.forms[0].submit()" class="form-control">
                 <?php
                    $cities=mysqli_query($conn,'select * from cities');
                    while($city = mysqli_fetch_array($cities)){
                   
                    ?>
                    <option value="<?php echo $city['name']?>"><?php echo $city['name']?> </option>
                    <?php  } ?>
                    <option selected value="الكل">الكل </option>
                </select>

              </form>
  
          </div></div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div  class=" form-group form-outline form-white mb-4 text-end col-4" dir='rtl'>
    
          <form method="get">
               <select name="faild" onchange="document.forms[1].submit()" class="form-control">
               <?php
                    $fields=mysqli_query($conn,'select * from categoris');
                    while($field = mysqli_fetch_array($fields)){
                   
                    ?>
                    <option value="<?php echo $field['name']?>"><?php echo $field['name']?> </option>
                    <?php  } ?>
                    <option selected value="الكل">الكل </option>
                </select>
                </form>
          </div></div>

     </div>

       

        </div>
      </div>

     
    </div><!-- End Page Header -->
    <?php
    if(isset($_GET['city']) && $_GET['city']=='الكل'){
      ?>

<div class="container py-5"  dir='rtl'>
  
  
  <div class="row pb-5 mb-1" dir='rtl'>

  <?php
  foreach($photographerinfo as $info)
   {?>

   <div class="col-lg-3 col-md-6 mb-4 mb-5" dir='rtl'>
      <!-- Card-->
    <a href="profile.php?username=<?=$info['username']?>">
      <div class="card rounded shadow-sm border-0 card-link" dir='rtl'>
        <div class="card-body p-0" dir='rtl'>
          <div class="px-5 py-4 text-center card-img-top coverimg" id="coverimg" style="background-image:url(assets/img/cover/<?=$info['cover']?>)" ><img src="assets/img/avatar/<?=$info['avatar']?>" alt="..." width="100" height="100" class="rounded-circle mb-2 img-thumbnail d-block mx-auto" dir='rtl'>
          <h5 class="text-white mb-0 "> <?=$info['username']?></h5>
            <p class="small text-white mb-0"> 
            <?php $fieldinfo=mysqli_query($conn,"select name from categoris inner join  photographer_fields on categoris.id=	photographer_fields.category_id where phtographer_id=".$info['id'] );
          foreach($fieldinfo as $field)
          {?>
          <span><?= $field['name']?> </span>

         <?php }?>
            </p>
          </div>
          <div class=" p-4 d-flex justify-content-center">
            <ul class="mb-0">
              <li class="list-inline-item ">
                <h5 class="font-weight-bold mb-0 d-block"><?=folowers($info['id'])['count(id)']?></h5><small class="text-muted"><i class="fa fa-picture-o mr-1 text-primary"></i><?=images($info['id'])['count(id)']?></small>
              </li>
              <li class="list-inline-item">
                <h5 class="font-weight-bold mb-0 d-block">متابع</h5><small class="text-muted"><i class="fa fa-user-circle-o mr-1 text-primary"></i>صوره</small>
              </li>
            </ul>

          </div>
        </div>
      </div>
    </a>
          
    </div>
   <?php }?>
   
            

  </div>
</div>

   <?php  }elseif(isset($_GET['city'])){ ?>
    <div class="container py-5" dir='rtl'>
  
  <div class="row pb-5 mb-1" dir='rtl'>

<?php
foreach (scop($_GET['city']) as $scop) {

foreach(photographerinfo($scop['photographerId']) as $info)
 {
    ?>
 

 <div class="col-lg-3 col-md-6 mb-4 mb-5" dir="rtl">
    <!-- Card-->
    <a href="profile.php?username=<?=$info['username']?>">
    <div class="card rounded shadow-sm border-0 card-link" dir='rtl'>
      <div class="card-body p-0">
        <div class="px-5 py-4 text-center card-img-top coverimg" id="coverimg" style="background-image:url(assets/img/cover/<?=$info['cover']?>)" ><img src="assets/img/avatar/<?=$info['avatar']?>" alt="..." width="100" class="rounded-circle mb-2 img-thumbnail d-block mx-auto">
        <h5 class="text-white mb-0 "> <?=$info['username']?></h5>
          <p class="small text-white mb-0"> 
          <?php $fieldinfo=mysqli_query($conn,"select name from categoris inner join  photographer_fields on categoris.id=	photographer_fields.category_id where phtographer_id=".$info['id'] );
        foreach($fieldinfo as $field)
        {?>
        <span><?= $field['name']?> </span>

       <?php }?>
          </p>
        </div>
        <div class=" p-4 d-flex justify-content-center">
          <ul class="list-inline mb-0">
            <li class="list-inline-item ">
              <h5 class="font-weight-bold mb-0 d-block"><?=folowers($info['id'])['count(id)']?></h5><small class="text-muted"><i class="fa fa-picture-o mr-1 text-primary"></i><?=images($info['id'])['count(id)']?></small>
            </li>
            <li class="list-inline-item">
              <h5 class="font-weight-bold mb-0 d-block">متابع</h5><small class="text-muted"><i class="fa fa-user-circle-o mr-1 text-primary"></i>صوره</small>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </a>
        
  </div>
 <?php }
 }?>
 
          

</div>
</div>
   <?php } ?>
   
   <?php
    if(isset($_GET['faild']) && $_GET['faild']=='الكل'){
      ?>

<div class="container py-5">
  
  <!-- Third Row [Profiles]-->
  <!-- <h2 class="font-weight-bold mb-2">Active Profiles</h2> -->
  <!-- <p class="font-italic text-muted mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p> -->

  <div class="row pb-5 mb-1" >

  <?php
  foreach($photographerinfo as $info)
   {?>

   <div class="col-lg-3 col-md-6 mb-4 mb-5" dir="rtl">
      <!-- Card-->
    <a href="profile.php?username=<?=$info['username']?>">
      <div class="card rounded shadow-sm border-0 card-link">
        <div class="card-body p-0">
          <div class="px-5 py-4 text-center card-img-top coverimg" id="coverimg" style="background-image:url(assets/img/cover/<?=$info['cover']?>)" ><img src="assets/img/avatar/<?=$info['avatar']?>" alt="..." width="100" class="rounded-circle mb-2 img-thumbnail d-block mx-auto">
          <h5 class="text-white mb-0 "> <?=$info['username']?></h5>
            <p class="small text-white mb-0"> 
            <?php $fieldinfo=mysqli_query($conn,"select name from categoris inner join  photographer_fields on categoris.id=	photographer_fields.category_id where phtographer_id=".$info['id'] );
          foreach($fieldinfo as $field)
          {?>
          <span><?= $field['name']?> </span>

         <?php }?>
            </p>
          </div>
          <div class=" p-4 d-flex justify-content-center">
            <ul class="list-inline mb-0">
              <li class="list-inline-item ">
                <h5 class="font-weight-bold mb-0 d-block"><?=folowers($info['id'])['count(id)']?></h5><small class="text-muted"><i class="fa fa-picture-o mr-1 text-primary"></i><?=images($info['id'])['count(id)']?></small>
              </li>
              <li class="list-inline-item">
                <h5 class="font-weight-bold mb-0 d-block">متابع</h5><small class="text-muted"><i class="fa fa-user-circle-o mr-1 text-primary"></i>صوره</small>
              </li>
            </ul>

          </div>
        </div>
      </div>
    </a>
          
    </div>
   <?php }?>
   
            

  </div>
</div>

   <?php  }elseif(isset($_GET['faild'])){ ?>
    <div class="container py-5">
  
  <div class="row pb-5 mb-1" >

<?php
foreach (photographer_fields($_GET['faild']) as $photographer_fields) {

foreach(photographerinfo($photographer_fields['phtographer_id']) as $info)
 {
    ?>
 

 <div class="col-lg-3 col-md-6 mb-4 mb-5" dir="rtl">
    <!-- Card-->
    <a href="profile.php?username=<?=$info['username']?>">
    <div class="card rounded shadow-sm border-0 card-link">
      <div class="card-body p-0">
        <div class="px-5 py-4 text-center card-img-top coverimg" id="coverimg" style="background-image:url(assets/img/cover/<?=$info['cover']?>)" ><img src="assets/img/avatar/<?=$info['avatar']?>" alt="..." width="100" class="rounded-circle mb-2 img-thumbnail d-block mx-auto">
        <h5 class="text-white mb-0 "> <?=$info['username']?></h5>
          <p class="small text-white mb-0"> 
          <?php $fieldinfo=mysqli_query($conn,"select name from categoris inner join  photographer_fields on categoris.id=	photographer_fields.category_id where phtographer_id=".$info['id'] );
        foreach($fieldinfo as $field)
        {?>
        <span><?= $field['name']?> </span>

       <?php }?>
          </p>
        </div>
        <div class=" p-4 d-flex justify-content-center">
          <ul class="list-inline mb-0">
            <li class="list-inline-item ">
              <h5 class="font-weight-bold mb-0 d-block"><?=folowers($info['id'])['count(id)']?></h5><small class="text-muted"><i class="fa fa-picture-o mr-1 text-primary"></i><?=images($info['id'])['count(id)']?></small>
            </li>
            <li class="list-inline-item">
              <h5 class="font-weight-bold mb-0 d-block">متابع</h5><small class="text-muted"><i class="fa fa-user-circle-o mr-1 text-primary"></i>صوره</small>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </a>     
  </div>
 <?php }
 }?>
 
          

</div>
</div>
   <?php } ?>
   
  

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