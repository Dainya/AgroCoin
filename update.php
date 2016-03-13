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
  	    $Username = getPostValue('Username');
		$Fname = getPostValue('Fname');
		$Lname = getPostValue('Lname');
		$Password = getPostValue('Password');
		$image = getPostValue('image');
    	//$path_to_image =$_FILES["fileToUpload"]["name"];

		$errors = [];

		require_once("updateValidator.php");
		require_once("test_upload.php");


		$updateValidator = new updateValidator();

		if(	 $updateValidator->isNull($Fname) || 
				 	$updateValidator->isNull($Lname))
		{
			$errors[] = "All fields should be filled";
		}

		if(count($errors)==0)
		{
			//do update
			// $uploader = new upload_image();
    //     		$uploader->setFile('uploads/',$path_to_image);
    //     		$file_path=$uploader->get_file_path();
    
					$mysqli->query("UPDATE user SET Fname='".$Fname."', Lname='".$Lname."', Password='".md5($Password)."' WHERE UserID='".$user->UserID."'");
					$update = true;
				
			{
				$mysqli->query("UPDATE user SET Fname='".$Fname."', Lname='".$Lname."' WHERE UserID='".$user->UserID."'");
				$ob = $mysqli->query("SELECT * FROM user where UserID='".$user->UserID."'");
				$_SESSION['user'] = json_encode($ob->fetch_object());
				$update = true;

			}
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
  <li role="presentation"  class="active"><a href="update.php">Update Account</a></li>
  <li role="presentation"><a href="password.php">Password</a></li>
  
</ul>
</div>

<div class="container padding-bottom">

<h2>Update Account</h2>
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
<?php if($update==true): ?>
	<p>Updated successfully</p>
<?php endif; ?>

</div>
<div class="container">
<div class="updatepade">

<form action="" method="post" enctype="mulitpart/form-data" class="form-horizontal">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Firstname</label>  
  <div class="col-md-5">
  <input name="Fname" type="text" placeholder="Eg:John" class="form-control input-md" value="<?=getPostValue('Fname')?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Lastname</label>  
  <div class="col-md-5">
  <input name="Lname" type="text" placeholder="Eg: Doe" class="form-control input-md" value="<?=getPostValue('Lname')?>">
    
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
<script type="text/javascript" src="http://localhost:8080/fieldgroup/livechat/php/app.php?widget-init.js"></script>
</script>
</body>
</html>
