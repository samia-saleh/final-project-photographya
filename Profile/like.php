<?php
require_once('../config.php');

$id = $_POST['imageId'];
if(isset($id))
{
  $userId = $_POST['userId'];
  $sql = "select imageId  from likes where userId=$userId and imageId=$id";
  $is_liked=$conn->query("select imageId  from likes where userId=$userId and imageId=$id");
  $is_liked=mysqli_fetch_array($is_liked);
  if(isset($is_liked)){
    $conn->query("delete from likes where userId=$userId and imageId=$id");
  }
  else{
    $conn->query("insert into likes (imageId,userId) values($id,$userId)");  
  }

  $like_number=$conn->query("select count(imageId) from likes where imageId=$id");
  echo mysqli_fetch_array($like_number)[0];
}
?>