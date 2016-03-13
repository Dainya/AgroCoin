<?php
  session_start();
  if(!isset($_SESSION['logged']))
  {
    header("location:login.php");
    exit;
  }
  $user = json_decode($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>User</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
<link rel="stylesheet" href="css/custom.css"/>
<link rel="stylesheet" href="css/font-awesome.css"/>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- <link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'> -->
<script src="js/jquery.min.js"></script>
</head>
<body>
<div class="header">
	<div class="container">
		<div class="col-lg-4 col-md-4 col-sm-4">
			<div class="logo">
				<img src="img/logo2.png" alt="agrocoin logo" class="logo-section"/>
			</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 logo-edit-icons-section">
			<i class="fa fa-user fa-lg icons-inHeader"> <?=$user->Fname.' '.$user->Lname?></i>
			<!-- <i class="fa fa-cog fa-lg icons-inHeader"> Settings</i> -->
			
		</div>
	</div>
</div>



<div class="container user-setting-edit">
<ul class="nav nav-tabs">
<li role="presentation"><a href="accinfo.php">Account Infrmation</a></li>
  <li role="presentation" class="active"><a href="delete.php">Delete Account</a></li>
  <li role="presentation"><a href="update.php">Update Account</a></li>
  <li role="presentation"><a href="password.php">Password</a></li>
  
</ul>
</div>



		
<div class="container footer-bar">
   <div class="row">
      <div class="col-sm-12">
         <p class="navbar-text">
              &copy;AgroCoin 2016</class>
         </p>
      </div>
   </div>
</div>


<!--live chat script-->
<!-- <script type="text/javascript" src="http://localhost:8080/fieldgroup/livechat/php/app.php?widget-init.js"></script> -->

<!--jQuery (necessary for Bootstarp's javaScript plugins)-->
<script src="js/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>