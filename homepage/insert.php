<?php
include('database.php');
if(isset($_POST["heading"], $_POST["description"]))
{
 $heading = mysqli_real_escape_string($connect, $_POST["heading"]);
 $description = mysqli_real_escape_string($connect, $_POST["description"]);
 $query = "INSERT INTO storehomepage(heading, description) VALUES('$heading', '$description')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
