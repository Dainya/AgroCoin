<?php
  session_start();
  if(!isset($_SESSION['logged']))
  {
    header("location:login.php");
    exit;
  }
  $user = json_decode($_SESSION['user']);
?>
<?php

include('connections.php');



if(isset($_GET['del'])){

	$id = $_GET['del'];

	$delete = "DELETE FROM user WHERE UserID= '$UserID' "; 

	$res= mysqli_query($delete) or die('Unable to delete Account');
	header('Location: login.php');
}

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
<ul class="nav nav-tabs ">
<li role="presentation"><a href="accinfo.php">Account Infrmation</a></li>
  <li role="presentation" class="active"><a href="delete.php">Delete Account</a></li>
  <li role="presentation"><a href="update.php">Update Account</a></li>
  <li role="presentation"><a href="password.php">Password</a></li>
  
</ul>
</div>

<div class="container padding-bottom">

<h2>Delete Account</h2>
<p><?=$user->Email?></p>
</br>
<p>Thank you for using AgroCoin, we are sorry that you are leaving. In case there is anything we can do for you please feel free to <a href="#">contact us</a><br/>
Please let us know why you are leaving
</p>
<form method"get" action="">
<div class="checkbox">
	 <label>
      <input type="checkbox"> AgroCoin is boring
    </label>
    </div>
    <div class="checkbox">
    <label>
      <input type="checkbox"> AgroCoin is hard to use
    </label>
    </div>
    <div class="checkbox">
    <label>
      <input type="checkbox"> I dont remeber siging up for this website
    </label>
    </div>
    <div class="form-group">
	 <label for="comment">Comment:</label>
	 <textarea class="form-control size-down" rows="5" id="comment"></textarea>
      </div>

	<div class="form-group">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-8 ">
    <div class="form-group">
		     <input type="submit" name="del" value="Delete" class="btn btn-info " style="margin-left:17px;">
		</div>

	<div class="form-group">
		      <input type="submit" name="cancel" onclick="goBack()" value="Cancel" class="btn btn-info" style="margin-left:16%; margin-top:-86px;">
		</div>

  </div>
</div>

</form>
<h4><i class="fa fa-arrow-left"><a href="UserAccount.php">Home</a></i></h4>
</div>

<script type="text/javascript" src="http://localhost:8080/fieldgroup/livechat/php/app.php?widget-init.js"></script>

		
<div class="container footer-bar">
   <div class="row">
      <div class="col-sm-12">
         <p class="navbar-text">
              &copy;AgroCoin 2016</class>
         </p>
      </div>
   </div>
</div>