<!--
//login.php
!-->

<?php

include('database_connection.php');

$message = '';

if(isset($_SESSION['staff_id']))
{
 header('location:index.php');
}

if(isset($_POST["login"]))
{
 $query = "
 SELECT * FROM staff 
    WHERE username = :username
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
      ':username' => $_POST["username"]
     )
 );
 $count = $statement->rowCount();
 if($count > 0)
 {
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   if(password_verify($_POST['password'], $row['password']))
   {
    $_SESSION['staff_id'] = $row['staff_id'];
    $_SESSION['username'] = $row['username'];
    header('location:index.php');
   }
   else
   {
    $message = '<label>Wrong Password</label>';
   }
  }
 }
 else
 {
  $message = '<label>Wrong Username</labe>';
 }
}


?>

<html>  
    <head>  
		<title>Administrator</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
   <br />
   
   <h3 align="center">Administrator</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Login</div>
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"><?php echo $message; ?></p>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
     </form>
	   <div align="center">
     <a href="../index.php" class="btn btn-primary">Home Page</a>
      </div>
    </div>
   </div>
  </div>
    </body>  
</html>
