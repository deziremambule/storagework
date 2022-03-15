<?php
include('database.php');
if(isset($_POST["id"]))
{
 $query = "DELETE FROM storehomepage WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>