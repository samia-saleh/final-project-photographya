<?php
require_once('../config.php');


$id = $_POST['ownerId'];
if(isset($id))
{
   $userId = $_POST['userId'];
   $sql = "select user_Id  from photographer_followers where phtographer_id=$id and user_Id=$userId";
  $is_folower=$conn->query("select user_Id  from photographer_followers where phtographer_id=$id and user_Id=$userId");
  $is_folower=mysqli_fetch_array($is_folower);
  if(isset($is_folower)){
    $conn->query("delete from photographer_followers where phtographer_id=$id and user_Id=$userId");

  }
  else{
  $conn->query("insert into photographer_followers (user_Id,phtographer_id)
  values($userId,$id)");

  
  }
   

}

?>
