<?php

require_once('config.php');
// session_start();
//getting the input
 if (isset($_POST['create'])){
  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];

  $address=$_POST['address'];

  //check if the user name is exist
  $username_existance=$conn->query("select username from users where username='$username'");
  $username_existance=mysqli_fetch_array($username_existance);
  $email_existance=$conn->query("select email from users where email='$email'");
  $email_existance=mysqli_fetch_array($email_existance);


if(!isset($email_existance) and !isset($username_existance))
{
  
  $photographer= $conn->query("select id  from users where username='$username'");
  $conn->query("insert into users (username,email,password,role,address,avatar,is_locked)
   values('$username','$email','$password','باحث','$address','65a6217141f00.jpg',0)");
   $photographer= $conn->query("select id  from users where username='$username'");
   $photographerId=mysqli_fetch_array($photographer);
   foreach($scope as $item){
    $conn->query("insert into scope (photographerId,cityId)
    values($photographerId[0],$item)");
  }
  foreach( $fields as  $field){
   $conn->query("insert into photographer_fields (phtographer_id,category_id)
   values($photographerId[0], $field)");
  }
  $_SESSION['username']= $username;
  // $_SESSION['email']= $email;
  // $_SESSION['password']= $password;
  // $_SESSION['bio']= $bio;
  // $_SESSION['address']= $address;
  header("location:profile.php?username=$username");
}
else
{
  email_existance();
  username_existance();

}
}


function username_existance(){
  global $username_existance;
 if(isset($username_existance))
  {
  return'من فضلك اختر اسم اخر';
  }
  else{
    return  $username_existance;
  }
 }
function email_existance(){
global $email_existance;

if(isset($email_existance))
{
return'من فضلك اختر ايميل اخر';
}
else{
  return $email_existance;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Signup</title>
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
        <h1 class="me-1">فوتوغرافيا</h1>

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
 <form  method="post">
  <section class="vh-100 gradient-custom" >
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card text-dark rounded-4"  >
            <div class="card-body p-3 ">
  
              <div class="mb-md-5 mt-md-4 pb-3 text-center" dir="rtl">
  
                <h2 class="fw-bold mb-2 text-uppercase">تسجيل الدخول</h2>
                <p class=" mb-5 "> من فضلك قم بادخال الحقول المطلوبة</p>
  
                <div class="form-outline form-white mb-4 text-end">
                  <label class="form-label me-2" for="typeEmailX">اسم المستخدم:</label>
                  <input type="text" name =" username"id="username" value="<?=isset($username) ? $username : "" ?>"class="form-control form-control-lg  border border-secondary" required />
                  <label class="form-label me-2 text-danger" for="typeEmailX"> <?php echo username_existance()?></label>

                </div>
  
                <div class="form-outline form-white mb-4 text-end">
                  <label class="form-label me-2" for="typePasswordX">الايميل: </label>
                  <input type="email" name ="email" id="email" value="<?=isset($email) ? $email : "" ?>" class="form-control form-control-lg border border-secondary" required />
                  <label class="form-label me-2 text-danger" for="typePasswordX"><?php echo email_existance()?> </label>

                </div>

                <div class="form-outline form-white mb-4 text-end">
                  <label class="form-label me-2" for="typeEmailX"> كلمة السر:  </label>
                  <input type="password" name ="password" value="<?=isset($password) ? $password : "" ?>" id="password" class="form-control form-control-lg  border border-secondary" required />
                  
                </div>
  
              
             
  
                <div class="form-outline form-white mb-4 text-end">
                  <label class="form-label me-2" for="address"> عنوانك الحالي </label>
                  <input name="address" value="<?=isset($address) ? $address : "" ?>" tc:\Users\Samia Saleh\Desktop\photographya\photographya\reports.htmlype="text" id="address" class="form-control form-control-lg border border-secondary" required/>
                  
                </div>
          

                <div class="text-center">
                  <button class="btn btn-outline-dark btn-lg px-5 cta-btn" name="create" type="submit"> انشاء الحساب</button>
                
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