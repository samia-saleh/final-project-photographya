<?php

require_once('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.8.1/src/Exception.php';
require 'PHPMailer-6.8.1/src/PHPMailer.php';
require 'PHPMailer-6.8.1/src/SMTP.php';


if(isset($_POST['send'])){
  
   $email=trim($_POST['email']);
   $is_valiad=$conn->query("select email from users where email= '$email'");
   $is_valiad=mysqli_fetch_array($is_valiad);
   if($is_valiad==null)
   {
   
    $err= 'الايميل غير موجد';
   //   header('location:resetpassword.php');
   }
   else{

   
   $str="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
   $password_length=7;
   $shuffl_str=str_shuffle($str);
   $newpass=substr($shuffl_str,0,$password_length);
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = "salesamia1999@gmail.com";
    $mail->Password   = 'samia1999saleh'; //app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; // 587
    $mail->CharSet = 'UTF-8'; // Set UTF-8 character encoding
    $mail->setFrom("salesamia1999@gmail.com");
    $mail->addAddress($_POST['email']); 
    $mail->isHTML(true);
    $mail->Subject = 'تغيير كلمة السر ';
    $mail->Body    ="تستطيع الدخول الى حسابك بكلمة السر الجديدة :".$newpass; // $strMessage;
    $mail->send();
    $hashed_pass=password_hash($newpass,PASSWORD_DEFAULT);
    $is_valiad=$conn->query("select email from users whrer email= $email");
    if(isset( $is_valiad)){
       header('location:login.php');
    }else{
       header('location:resetpassword.php');
    }

   }
}






?>