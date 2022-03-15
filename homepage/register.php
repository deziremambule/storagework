<!--
//register.php
!-->

<?php

include('database_connection.php');

session_start();

$message = '';

//check staff_id validation before accessing 
if(isset($_SESSION['staff_id']))
{
 header('location:index.php');
}
//recieve these registeration inputs 
if(isset($_POST['register']))
{
 $username = trim($_POST["username"]);
 $password = trim($_POST["password"]);
 $check_query = "
 SELECT * FROM staff 
 WHERE username = :username
 ";
 $statement = $connect->prepare($check_query);
 $check_data = array(
  ':username'  => $username
 );
 if($statement->execute($check_data)) //set up validation for username and password
 {
  if($statement->rowCount() > 0)
  {
   $message .= '<p><label>Username already taken</label></p>';
  }
  else
  {
   if(empty($username))
   {
    $message .= '<p><label>Username is required</label></p>';
   }
   if(empty($password))
   {
    $message .= '<p><label>Password is required</label></p>';
   }
   else
   {
 
   }
   if($message == '')
   {
    $data = array(
     ':username'  => $username,
     ':password'  => password_hash($password, PASSWORD_DEFAULT) //apply hash password to password
    );

    $query = "
    INSERT INTO staff 
    (username, password) 
    VALUES (:username, :password)
    ";

    $statement = $connect->prepare($query);

    if($statement->execute($data))
    {
     $message = '<label label-success>Registration Completed</label>';
    }
   }
  }
 }
}

?>

<html>  
    <head>  
        <title>General Chat Registration</title>  
		<!--bootstrap and javascript Libraries for navigation and css-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	</head>
	
	  <style>
  body{  
	color:#A50000;  
	 font-family:arial;  
	font-size: 20px;
	}  
	
	
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #A50000;
   color: white;
   text-align: left;
}
  </style>
  
    <body>  
	
		<!-- navigation bar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="../index.htm">United Material</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../index.htm">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Match Day<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../usermatchday/index.php">Match Day</a></li>
            <li><a href="../fixtures/index.php">Match Fixtures</a></li>
            <li><a href="../userkits/index.php">Team Kits</a></li>
            <li><a href="../userstats/index.php">Team Tactics</a></li>
          </ul>
        </li>
		 <li><a href="index.php">News</a></li>
		 
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">League Tables<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../userprem/index.php">Premier League</a></li>
            <li><a href="..usereuropa/index.php">Europa League</a></li>
          </ul>
        </li>
		
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Players<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../userplayerprofile/index.php">Player Profiles</a></li>
            <li><a href="../userplayerstats/index.php">Player Stats</a></li>
          </ul>
        </li>
		
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Forums<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../chatmatchday/index.php">Match Day Chat</a></li>
            <li><a href="../chatnews/index.php">News Chat</a></li>
            <li><a href="index.php">General Chat</a></li>
          </ul>
        </li>
		
	<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">History<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../userlegends/index.php">Club Legends</a></li>
            <li><a href="../userhistory/index.php">Manchester Untied History</a></li>
			<li><a href="../aboutus/index.php">About Us</a></li>
          </ul>
        </li>
      

			<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Highlights/Maps<span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="../highlights/index.php">Highlights</a></li>
			<li><a href="../maps/index.php">Maps</a></li>
          </ul>
        </li>
		
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Store<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../productfilter/index.php">Search Products</a></li>
            <li><a href="../store/index.php">Purchase Products</a></li>
            <li><a href="../checkout/index.php">Checkout</a></li>
			<li><a href="../contactus/index.php">Contact Us</a></li>
          </ul>
        </li>
		
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li  class="active" ><a href="../loginregister/index.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
      </ul>
    </div>
  </div>
</nav>


   <!--set up registeration form -->
   <div class="container">
   <br />
   
   <h3 align="center">General Chat Registration</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Register</div>
    <div class="panel-body">
     <form method="post">
      <span class="text-primary"><?php echo $message; ?></span>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" id="password" class="form-control" />
      </div>
      <div class="form-group">
       <label>Re-enter Password</label>
       <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" name="register" class="btn btn-info" value="Register" />
      </div>
	  <!--redirect to login page -->
      <div align="center">
       <a href="login.php">Login</a>
      </div>
     </form>
    </div>
   </div>
  </div>
  	<br><br>
	  <div class="footer">
      &copy; <?php echo date('Y'); ?> Dezire Mambule
</div>
</body>  
</html>