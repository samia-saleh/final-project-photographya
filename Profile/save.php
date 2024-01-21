<?php
require_once('../config.php');

$id = $_POST['imageId'];

if(isset($id))
{
    $userId = $_POST['userId'];
    $sql = "select imageId  from saved_images where userId=$userId and imageId=$id";
  $is_saved=$conn->query("select imageId  from saved_images where userId=$userId and imageId=$id");
  $is_saved=mysqli_fetch_array($is_saved);
  if(isset($is_saved)){
    $conn->query("delete from saved_images where userId=$userId and imageId=$id");

  }
  else{
  $conn->query("insert into saved_images (imageId,userId)
  values($id,$userId)");


  }
   

}
?>