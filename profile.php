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
if(isset($_POST['changecover']))
{


  if(isset($_FILES['cover']['name'])){


    $imagename=$_FILES['cover']['name'];
    $tempName=$_FILES['cover']['tmp_name'];
    $imageExtension=explode('.',$imagename);
    $imageExtension=strtolower(end($imageExtension));
    $newimagename=uniqid().'.'.$imageExtension;
    move_uploaded_file($tempName,'assets/img/cover/'.$newimagename);
    $file=$newimagename;

    $conn->query("update users set  cover='$file' where id=$loggedInUserid");

    header('location:profile.php?username='.$_SESSION['username']);
}  

}
if(isset($_POST['changeavatar']))
{
 

  if(isset($_FILES['avatar']['name'])){

    $imagename=$_FILES['avatar']['name'];
    $tempName=$_FILES['avatar']['tmp_name'];
    $imageExtension=explode('.',$imagename);
    $imageExtension=strtolower(end($imageExtension));
    $newimagename=uniqid().'.'.$imageExtension;
    move_uploaded_file($tempName,'assets/img/avatar/'.$newimagename);
    $file=$newimagename;

    $conn->query("update users set  avatar='$file' where id=$loggedInUserid");

    header('location:profile.php?username='.$_SESSION['username']);

   }  

}

$downloadesum=mysqli_fetch_array($conn->query("select sum(downloadenumber) from images where ownerid='$userprofileid'"));
$imagesum=mysqli_fetch_array($conn->query("select count(id) from images where ownerid='$userprofileid'"));
$folowersnumber=mysqli_fetch_array($conn->query("select count(id) from photographer_followers where user_Id='$userprofileid'"));
$folowingsnumber=mysqli_fetch_array($conn->query("select count(id) from photographer_followers where 	phtographer_id='$userprofileid'"));
$savesum=mysqli_fetch_array($conn->query("select count(id) from saved_images where userId='$userprofileid'"));
$likesum=mysqli_fetch_array($conn->query("select count(id) from likes where userId='$userprofileid'"));




$selectfolower="select username , avatar from users inner join photographer_followers on users.id=photographer_followers.user_Id 
where photographer_followers.phtographer_id=$userprofileid";

$selectfolower=mysqli_query($conn,$selectfolower);

function selectfolowing()

{
  global $conn;
    global $userprofileid;
  $selectfolowing="select * from  photographer_followers  where user_id=$userprofileid";
   $selectfolowing=mysqli_query($conn,$selectfolowing);
   return $selectfolowing;
}
function folowerinfo($id){
  global $conn;
  $selectfolowing="select * from  users  where id=$id";
  $selectfolowing=mysqli_query($conn,$selectfolowing);
  return $selectfolowing;
}




if(isset($_POST['changebio'])){
  $newbio=$_POST['bio'];
  $conn->query("update users set  bio='$newbio' where id=$loggedInUserid");
  header('location:profile.php?username='.$_SESSION['username']);


}

function getLatestsavedImages(){

 global $conn;
 global $loggedInUser;

  $latestsavedImages = mysqli_query($conn,"select * from images, saved_images where images.id=saved_images.imageId  and saved_images.userId=" . $loggedInUser['id'] . " and is_NotAvailable=0 order by saved_images.id desc limit 8");

   return $latestsavedImages;
 
 }

 function categories(){

  global $conn;
  global $userprofileid;
  $select="select name from categoris inner join photographer_fields on categoris.id=photographer_fields.category_id where phtographer_id='$userprofileid'";
  $selectresult=mysqli_query($conn,$select);
  return($selectresult);
  
  }

  function getLatestLikedImages(){
    global $conn;
    global $loggedInUser;

   $latestLikedImages = mysqli_query($conn,"select * from images, likes where images.id=likes.imageId and likes.userId=" . $loggedInUser['id'] . " and is_NotAvailable=0 order by likes.id desc limit 8");

   return $latestLikedImages;
   }

  function getLatestImages(){
    global $conn;
    global $userprofileid;
    $latestImages=mysqli_query($conn, "select * from images where ownerid=". $userprofileid . " and is_NotAvailable=0 order by id desc limit 8");
    
    return($latestImages); 
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
  function scops()
{
    global $conn;
    global $userprofileid;
    $searhresult=mysqli_query($conn,"select * from cities inner join scope on cities.id=scope.cityid where photographerid=$userprofileid ");
    
    return $searhresult;

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

        <?php
        if ( isset($loggedInUsername) and $username == $loggedInUsername)
        {?>
          <button  class="editavatar"  type="button" 
       data-bs-toggle="modal" data-bs-target="#profileModal"> <i class="fa fa-edit"></i></button>
       <?php } ?>
      
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
          <li><a href="#facts" class="nav-link scrollto"><i class="bx bx-user"></i> <span class="me-1">المعلومات الشخصيه</span></a></li>
          <?php
          if (  isset($loggedInUsername) and $username == $loggedInUsername  )
          {?>
            <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-bookmark"></i> <span class="me-1">سجل المحفوظات</span></a></li>
         
        <?php  }?>
        <?php
        if($role!='باحث' and $role!='admin'){?>
        <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-image"></i> <span class="me-1">صور</span></a></li>
         
       <?php }
        ?>
            <?php
          if ( isset($loggedInUsername) and $username == $loggedInUsername )
          {?>
          <li><a href="#services" class="nav-link scrollto"><i class="bx bx-heart"></i> <span class="me-1">تسجيل الاعجاب</span></a></li>
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
          <li><a href="?logout&username=<?=$loggedInUsername?>" class="nav-link scrollto"><i class="bx bx-log-out"></i> <span class="me-1"> تسجيل خروج</span></a></li>
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
  <?php
        if ( isset($loggedInUsername) and $username == $loggedInUsername)
        {?> 
  <button  class="editcover"  type="button" 
       data-bs-toggle="modal" data-bs-target="#coverModal"> <i class="fa fa-edit"></i></button>
       <?php } ?>
       <?php
       if(  isset($loggedInUsername) and $role!='باحث' and $userprofilename!=$loggedInUsername ){ ?>
          <form method="post" style="float:left ;margin-top:70px;margin-left:20px">
           <input name="ownerId" type="hidden" value="<?=$userprofileid?>" />
        <h2> <button id="folowButton" name="folow" type="button" class="border-0 me-3 bg-light"> <i id="user"class="<?= isset($is_folower) ? "fa-solid fa-user-check" : "fa-solid fa-user-plus"?>"></i></button>
          </h2>   
         
           </form>
      <?php }
       ?>
       
    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts" >
      <div class="container">

        <div class="section-title" >
          <h2>المعلومات الشخصيه  </h2>
          <p class="d-inline">
           <span> <?= $userprofile['bio']?></span>
           <?php if ( isset($loggedInUsername) and $username == $loggedInUsername and $role!='باحث')
        {?>
          <button  class="editbio"  type="button" 
       data-bs-toggle="modal" data-bs-target="#bioModal"> <i class="fa fa-edit"></i></button>
        </div>
        <?php }?>
            <br>
          <?php
          if($role!='باحث' and $role!='admin'){?>
            نطاق التصوير:
            <?php
          
          foreach(scops() as $scope ){
            echo $scope ['name']."  ";
            }
             }  ?>
        
          </p>
         
        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" >

          <?php
          if($role=='مصور'){?>

<button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#folowereModal">
              <div class="count-box">
                <i class="bi bi-people"></i>
                <span data-purecounter-start="0" data-purecounter-end="<?=$folowingsnumber['count(id)']?>" data-purecounter-duration="1" class="purecounter"></span>

              </div>
            </button>
       <?php   }
          
          ?>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="100">
           <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#folowingleModal">
            <div class="count-box">
              <i class="bi bi-person-fill"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?=$folowersnumber['count(id)']?>" data-purecounter-duration="1" class="purecounter"></span>

            </div>
           </button>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="count-box">
              <i class="bi bi-image"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?=$imagesum['count(id)'];?>" data-purecounter-duration="1" class="purecounter"></span>

            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="count-box">
              <i class="bi bi-download"></i>
             
              <span data-purecounter-start="0" data-purecounter-end="<?= isset($downloadesum['sum(downloadenumber)']) ? $downloadesum['sum(downloadenumber)'] : 0?>" data-purecounter-duration="1" class="purecounter"></span>

            </div>
          </div>

        </div>

      </div>
    </section><!-- End Facts Section -->

 

    <!-- ======= Resume Section ======= -->
    <?php
          if (  isset($loggedInUsername) and $username == $loggedInUsername)
          {?>
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>سجل المحفوظات</h2>

        </div>

      

        <section  class="portfolio ">
          <div class="container">
 
    
            <div class="row " data-aos="fade-up" data-aos-delay="100" >
            <?php
              // getLatestsavedImages();
             foreach( getLatestsavedImages() as $row){
              
            ?>
             <div class="col-lg-4 col-md-6 portfolio-item " >
                <div class="portfolio-wrap" >
                  <img src="uploads/<?php echo $name=$row['name']?>" class="img-fluid" alt="" >
                  <div class="portfolio-links">
                    <a href="uploads/<?php echo $name=$row['name']?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bi bi-arrows-angle-expand"></i></a>
                    <!-- <a href="<?php  echo'image-details.php?img='.$name=$row['name']?>" title="More Details"><i class="bx bx-link"></i></a> -->
                    <a href="image-details.php?img=<?=$row['imageId']?>&username=<?=$_SESSION['username']?>" class=""><i class="bi bi-link-45deg"></i></a>
                 
                  </div>
                </div>
              </div>
               <?php
                }
            
               ?>
               <?php
              
              if($savesum['count(id)']>9) { ?>
                 <div class="col-lg-4 col-md-6 portfolio-item ">
               <a href="saves.php?username=<?=$userprofilename?>">
                <div class="portfolio-wrap text-center p-5">
                 
                  <h1 title="More Details"><i class="bx bx-plus"></i></h1>
                
                </div>
               </a>
              </div>


              <?php } ?>
    
            </div>
    
          </div>
        </section> 
     
       
          

      </div>
    </section>
    <!-- End Resume Section -->
     <?php }?>
    <!-- ======= Portfolio Section ======= -->
    <?php
    if($role!='باحث'){?>
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>صور</h2>
             </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">الكل</li>

              <?php
              
              $categories= categories();
              foreach($categories as $category){
               
                ?>
                 <li data-filter=".<?php echo $category['name']?>"><?php echo $category['name']?></li>
             <?php }?>

            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
          
        <?php
       
             foreach(getLatestImages() as $row){
              $category = getImageCategory($row);
            
            ?>
            <div class="col-lg-4 col-md-6 portfolio-item <?=$category?>">
                <div class="portfolio-wrap" >
                  <img src="uploads/<?=$row['name']?>" class="img-fluid" alt="" >
                  <div class="portfolio-links">
                    <a href="uploads/<?=$row['name']?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bi bi-arrows-angle-expand"></i></a>
                    <a href="<?= 'image-details.php?img='.$row['id']?>" title="More Details"><i class="bx bx-link"></i></a>
                     </div>
                </div>
              </div>
               <?php  }  ?>

              <?php
              
              if($imagesum['count(id)']>9) { ?>
                 <div class="col-lg-4 col-md-6 portfolio-item ">
               <a href="pictures.php?username=<?=$userprofilename?>">
                <div class="portfolio-wrap text-center p-5">
                 
                  <h1 title="More Details"><i class="bx bx-plus"></i></h1>
                
                </div>
               </a>
              </div>


              <?php } ?>

             
               
              
        </div>

      </div>
     
    </section> 
   <?php }
    
    
    ?>

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
               <?php
              
              if($likesum['count(id)']>9) { ?>
                 <div class="col-lg-4 col-md-6 portfolio-item ">
               <a href="likes.php?username=<?=$userprofilename?>">
                <div class="portfolio-wrap text-center p-5">
                 
                  <h1 title="More Details"><i class="bx bx-plus"></i></h1>
                
                </div>
               </a>
              </div>


              <?php } ?>
            </div>
    
            
    
          </div>
        </section> 
     

      </div>
    </section>
    <!-- End Services Section -->
    <?php }?>
  <!-- Modal -->
  <div class="modal fade " id="folowereModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog popupwidth ">
      <div class="modal-content ">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">المتابعين</h1>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class="modal-body ">
          <div class="portfolio-info " >
           <?php
           

           foreach($selectfolower as $row){?>
            <div>
            <a href="profile.php?username=<?= $row['username']?>"><img src="assets/img/avatar/<?php echo $row['avatar'] ?>" class="detailsimg">
              <label> <?php echo $row['username']?> </label></a>

          </div>

           
       <?php   }
           
           ?>
              
       

                     </div>
        </div>
        <div class="modal-footer" dir="rtl">
          <button type="button" class="btn " data-bs-dismiss="modal">إغلاق</button>
        </div>
      </div>
    </div>
  </div>
   <!-- Modal -->
  <div class="modal fade " id="folowingleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog popupwidth ">
      <div class="modal-content ">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">يتابع</h1>
           </div>
        <div class="modal-body ">
          <div class="portfolio-info " >
           <?php
           
           foreach(selectfolowing() as $row){
            $row['phtographer_id'];
            foreach( folowerinfo($row['phtographer_id']) as $folower){ ?>
              

              <div>
              <a href="profile.php?username=<?=$folower['username']?>"><img src="assets/img/avatar/<?php echo $folower['avatar'] ?>" class="detailsimg">
                <label> <?php echo $folower['username']?> </label></a>
            </div>
      <?php    }
            ?>
             

           
       <?php   }
           
           ?>
              
       

                     </div>
        </div>
        <div class="modal-footer" dir="rtl">
          <button type="button" class="btn " data-bs-dismiss="modal">إغلاق</button>
        </div>
      </div>
    </div>
  </div>
<form method="post" enctype="multipart/form-data">
<div class="modal" tabindex="-1" id='profileModal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تحديث البروفايل</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <div class="form-outline form-white mb-4 text-end">
                  
                  <input type='file' name="avatar" id="files" accept=".jpg, jpeg ,png" class="form-control form-control-lg  border border-secondary" required multiple/>
                  
                </div>
      </div>
      <div class="modal-footer">
      <button name="changeavatar" type="submit" class="changbuttn p-1 border-0 bg-light">تحديث </button>
        <button type="button" class="btn " data-bs-dismiss="modal">اغلاق</button>
        
      </div>
    </div>
  </div>
</div>
</form>
<form method="post" enctype="multipart/form-data" dir="rtl">
<div class="modal" tabindex="-1" id='coverModal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تحديث الغلاف</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <div class="form-outline form-white mb-4 text-end">
                  
                  <input type='file' name="cover" id="files" accept=".jpg, jpeg ,png" class="form-control form-control-lg  border border-secondary" required multiple/>
                  
                </div>
      </div>
      <div class="modal-footer " >
        
        <button name="changecover" type="submit" class="changbuttn p-1 border-0 bg-light">تحديث </button>
        <button type="button" class="btn " data-bs-dismiss="modal">اغلاق</button>
      </div>
    </div>
  </div>
</div>
</form>
<form method="post"  dir="rtl">
<div class="modal" tabindex="-1" id='bioModal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تحديث البايو</h5>

      </div>
      <div class="modal-body">
      <textarea  id="" name="bio" class="form-control form-control-lg border border-secondary" required >
      </textarea>
      </div>
      <div class="modal-footer " >
        
        <button name="changebio" type="submit" class="changbuttn p-1 border-0 bg-light">تحديث</button>
        <button type="button" class="btn " data-bs-dismiss="modal">اغلاق</button>
      </div>
    </div>
  </div>
</div>
</form>

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