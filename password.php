<?php 
session_start();


include('connections.php');
  
  if(!isset ($_SESSION["logged"]))
  	header('Location: login.php');
  $user = json_decode($_SESSION['user']);
  $update = false;
  $password = false;

  function getPostValue($index)
{
	return  isset($_POST[$index]) ? trim($_POST[$index]) : null;
}

  if(isset($_POST['update']))
  {
  	  
		$Password = getPostValue('Password');
		
		$errors = [];

		require_once("Validate.php");
		
		//do update
			if($Password!=null)
			{
					$mysqli->query("UPDATE user SET Password='".md5($Password)."' WHERE UserID='".$user->UserID."'");
					$update = true;
					$password = true;
			}
			
		}

  $mysqli->close();
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
  <li role="presentation"><a href="delete.php">Delete Account</a></li>
  <li role="presentation"><a href="update.php">Update Account</a></li>
  <li role="presentation" class="active"><a href="password.php">Password</a></li>
  
</ul>
</div>

<div class="container padding-bottom">

<h2>Update Password</h2>
<p><?=$user->Email?></p>
</br>

<?php
if(isset($errors) && is_array($errors) && count($errors)>0):
?>
	<div class="errors">
	<ul>
	<div class="container" style="padding-left: 22.5%; margin-top: 63px; color: #D8000C">
	<?php foreach($errors AS $e): ?>
		<?=$e?>
	<?php endforeach; ?>
	</div>
	</ul>
	</div>
<?php
endif;
?>
<div class="container" style="padding-left: 22.5%; margin-top: 63px; color: #4F8A10;">
<?php if($password==true): ?>
	<p>Password changed successfully</p>
<?php endif; ?>
</div>
<div class="container">
<div class="updatepade">

<form action="" method="post" enctype="mulitpart/form-data" class="form-horizontal">
<fieldset>


<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Password">Password</label>
  <div class="col-md-5">
    <input  name="Password" type="password" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-8 ">
    <div class="form-group">
		     <input type="submit" name="update" value="Update" class="btn btn-info " style="margin-left:17px;">
		</div>

	<div class="form-group">
		      <input type="submit" name="cancel" onclick="goBack()" value="Cancel" class="btn btn-info" style="margin-left:16%; margin-top:-86px;">
		</div>
  </div>
</div>

</fieldset>
</form>
<h4><i class="fa fa-arrow-left"><a href="UserAccount.php">Home</a></i></h4>
</div>
</div>
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

</div>
<script>
function goBack() {
    window.history.back();
}
</script>
<script type="text/javascript" src="http://localhost:8080/fieldgroup/livechat/php/app.php?widget-init.js"></script>
</body>
</html>
