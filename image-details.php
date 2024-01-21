<?php

require_once('config.php');
$imgid=$_GET["img"];
$imginfo="select name,tags,title,ownerid from images where id=$imgid";
$imginfo=mysqli_query($conn,$imginfo);
foreach($imginfo as $info)
{

  $imgname=$info['name'];
  $imgtitle=$info['title'];
  $imgtags=$info['tags'];
  $imgowner=$info['ownerid'];

}
if(isset($_SESSION['username'])){
  $loggedInUsername = $_SESSION['username'];
$loggedInUser=mysqli_fetch_array($conn->query("select * from users where username='$loggedInUsername'"));
$loggedInUserid=$loggedInUser['id'];
$loggedInUserRole=$loggedInUser['role'];
$is_saved=$conn->query("select imageId  from saved_images where userId=$loggedInUserid and imageId=$imgid");
$is_saved=mysqli_fetch_array($is_saved);
$is_liked=$conn->query("select imageId  from likes where userId=$loggedInUserid and imageId=$imgid");
$is_liked=mysqli_fetch_array($is_liked);
$is_folower=$conn->query("select user_Id  from photographer_followers where phtographer_id=$imgowner and user_Id=$loggedInUserid");
$is_folower=mysqli_fetch_array($is_folower);
}


// Donwload file
if (isset($_POST["download"])) {
  $id = $_POST['imageId'];
  $img = $_POST['image'];
  $conn->query("update images set downloadenumber=downloadenumber+1 where id='$id';");
  $file='uploads/'.$img;
  if(file_exists($file)){
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
  }

}


$imgownerinfo=$conn->query("select username, avatar,id from users where id=$imgowner");
$imgownerinfo=mysqli_fetch_array($imgownerinfo);
$explodedtags=explode(" ",$imgtags);


$conn->query("update images set viewnumber = viewnumber + 1 where Id=$imgid");

if(isset($_POST['save'])){
  $conn->query("update images set downloadenumber=downloadenumber+1 where id='$imgid';");
}

$downloade_number=$conn->query("select downloadenumber from images where id=$imgid");
$downloade_number=mysqli_fetch_array($downloade_number);


$viewnumber_number=$conn->query("select viewnumber from images where id=$imgid");
$viewnumber_number=mysqli_fetch_array($viewnumber_number);

   







$like_number=$conn->query("select count(imageId) from likes where imageId=$imgid");
$like_number=mysqli_fetch_array($like_number);






if(isset($_POST['blockimg']))
{
  $conn->query("update images set is_NotAvailable=1  where id=".$_GET["img"]);
  header('location:home.php');
 
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Image Details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/whitelogo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  
  <!-- our project just needs Font Awesome Solid + Brands -->

  <link href="assets/vendor/fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free-6.4.2-web/css/brands.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free-6.4.2-web/css/solid.css" rel="stylesheet">
  <!-- -->
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/use-bootstrap-tag/use-bootstrap-tag.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/image-details.css" rel="stylesheet">

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

        <h1 class="me-1">فوتوغرافيا</h1>

        <img src="assets/img/whitelogo.png" class="bi bi-camera">
      </a>
   
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
  
    </div>
  </header><!-- End Header -->
  <main id="main">



    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details" dir="rtl">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 me-5">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="uploads/<?= $imgname?>" class="rounded img-thumbnail">
                  <div class="d-block mt-3">
                      <?php
                      
                      foreach($explodedtags as $explodedtag){
                        ?>
                        <a href="filtering.php?key=<?=$explodedtag?> "class="badge badge bg-light text-secondary border border-secondary"><?php print_r( $explodedtag);?></a>
                     <?php }
                      ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 " dir="rtl">
            <div class="portfolio-info" >
            <h4 class="display-6  "> <?php echo $imgtitle?></h4>
            <hr>
              <div class="buttons">

              <?php
              if(isset($_SESSION['username']) and isset($loggedInUserRole) and $loggedInUserRole=='admin' ){?>
              <form method="post">
              <button type="submit" name='blockimg'>
              <i class="fa-solid fa-circle-xmark"></i>
                حظر
              </button>
              </form>
              


           <?php }elseif(isset($_SESSION['username'])){ ?>
             <a href="report.php?img=<?=$_GET['img']?>"> <i class="fa fa-flag"></i> إبلاغ </a>
          <?php }else{ ?>
            <a href="login.php"> <i class="fa fa-flag"></i> إبلاغ </a>
          
         <?php }
              
              ?>
            
       <?php
       if(isset($_SESSION['username'])){?>
            <form method="post" >
            <input name="imageId" type="hidden" value="<?=$_GET['img']?>" />
              
            
            <button  id="likeButton" name="like" class="<?=isset($is_liked) ? "active" : "" ?>" type="button"> <i class="fa fa-heart ms-1"></i><span id="likesCountSpan"><?php echo  $like_number[0]?></span></button>
            <button id="saveButton" name="save" class="<?=isset($is_saved) ? "active" : "" ?>" type="button"> <i class="fa fa-bookmark  ms-1"></i>حفظ</button>
              </form>

    <?php   }else{?>
          <a href='login.php' > <i class="fa fa-heart ms-1"></i><span id="likesCountSpan"><?php echo  $like_number[0]?></span></a>
            <a href='login.php' > <i class="fa fa-bookmark  ms-1"></i>حفظ</a>
           
   <?php } ?>

            <form method="post">
            <input name="imageId" type="hidden" value="<?=$_GET['img']?>" />
            <input name="image" type="hidden" value="<?=$imgname?>"/>
              <button name="download" type="submit"><i class="fa fa-solid fa-download"></i> تنزيل </button>
            </form>

              </div>
             <div class="details" >
              <h6>تنزيل</h6>
              <h6>عرض</h6>
             </div>
             <div class="detailsnumbers" >

              <h6><?php echo $downloade_number[0]?></h6>
              <h6><?php echo $viewnumber_number[0]?></h6>
             </div>



            <a href="profile.php?username=<?php echo $imgownerinfo[0]?>" class="m-0 ms-5"><img src="assets/img/avatar/<?php print_r($imgownerinfo[1])?>" class="detailsimg">
              <label> <?php echo $imgownerinfo[0]?></label></a>
             <?php
             if((isset($loggedInUsername)) and $imgownerinfo[0]!=$loggedInUsername){?>

             <form  method="post" class='d-inline me-5'>
              <input name="ownerId" type="hidden" value="<?=$imgownerinfo[2]?>" />
              <button id="folowButton" name="folow" type="button" class="border-0 me-3 bg-light"> <i id="user"class="<?= isset($is_folower) ? "fa-solid fa-user-check" : "fa-solid fa-user-plus"?>"></i></button>
             
              </form>
            <?php }
            elseif( isset($loggedInUsername) and $imgownerinfo[0]==$loggedInUsername){

            }
            else{?>
             <form  method="post" class='d-inline me-5'>
               <a  href="login.php" class="border-0 me-4 bg-light"> <i id="user"class=" fa-solid fa-user-plus"></i></a>
            
              </form>
              

            <?php }
             ?>
              

            </div>
           
          </div>
         

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->
  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

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
  <script src="assets/vendor/use-bootstrap-tag/use-bootstrap-tag.min.js"></script>

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

        $('#saveButton').click(function(){

          var data = { imageId: <?=$_GET["img"]?>, userId: <?=$loggedInUserid?>};
          $.post('Profile/save.php', data , function(){
            $('#saveButton').toggleClass("active");        
          });
        });
    });
    $(function(){

        $('#folowButton').click(function(){

          var data = { ownerId: <?=$imgownerinfo[2]?>, userId: <?=$loggedInUserid?>};
          $.post('Profile/folow.php', data , function(){
            $('#user').toggleClass("fa fa-user-plus");
            $('#user').toggleClass("fa-solid fa-user-check");

         
          });
        });
    });
    
  </script>
</body>

</html>
<?php
if(isset($_GE['image'])){
  $file=$_GET['image'];
  if(file_exists($file)){
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
  }
}

?>