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

function getPostValue($index)
{
  return  isset($_POST[$index]) ? trim($_POST[$index]) : null;
}

if(isset($_POST['Add'])){


 include('connections.php');

  

    //check errors for animals
    $Name = getPostValue('Name');
    $Age = getPostValue('Age');
    $Dates = getPostValue('Dates');
    $Weight = getPostValue('Weight');
    $Units = getPostValue('Units');
    $Gender = getPostValue('Gender');
    $Price = getPostValue('Price');
    $Description = getPostValue('Description');
    $image = getPostValue('image');
    $path_to_image =$_FILES["fileToUpload"]["name"];
   
    

    $errors = [];
      

    require_once("animalProVal.php");
    require_once("test_upload.php");

    $animalProVal = new animalProVal();

    if($animalProVal ->isNull($Name) ||
         $animalProVal ->isNull($Age) || 
          $animalProVal ->isNull($Dates) || 
			$animalProVal ->isNull($Weight) || 
			 $animalProVal ->isNull($Units)||
			  $animalProVal ->isNull($Gender)||
			    $animalProVal ->isNull($Price)||
			      $animalProVal ->isNull($Description))




    {
      $errors[] = "All fields should be filled";
    }
    
    

    if(count($errors)==0)
    {
    	$uploader = new upload_image();
        $uploader->setFile('uploads/',$path_to_image);
        $file_path=$uploader->get_file_path();
      
      $sql = "INSERT INTO animals (Name, Age, Dates, Weight, Units,Gender,Price, Description,image) VALUES ('{$Name}', '{$Age}','{$Dates}','{$Weight}','{$Units}','{$Gender}','{$Price}','{$Description}','{$file_path}')";
      $insert = $mysqli->query($sql);
      header('location:	UserAccount.php');
      exit();
   
    }
  
    $mysqli->close();
}
   


if(! empty($_POST )){


  
  include('connections.php');

    
    //check errors produce
    $proName = getPostValue('proName');
    $proWeight = getPostValue('proWeight');
    $proUnits = getPostValue('proUnits');
    $proPrice = getPostValue('proPrice');
    $proDescription = getPostValue('proDescription');

    $errors = [];
      

    require_once("animalProVal.php");
     require_once("test_upload.php");

    $animalProVal = new animalProVal();



    if($animalProVal ->isNull($proName) ||
			$animalProVal ->isNull($proWeight) || 
			 $animalProVal ->isNull($proUnits)||
			   $animalProVal ->isNull($proPrice)||
			      $animalProVal->isNull($proDescription))
    	/*CREATE TABLE products
(
	 prod_Id int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
     UserId int(6) NOT NULL,
     proName varchar (150) NOT NULL,
     proWeight decimal(7,3) NOT NULL,
     proUnits varchar (10) NOT NULL,
     proPrice decimal(6,2) NOT NULL,
     proDescription varchar (150) NOT NULL,
     image varchar(150) NOT NULL
     
    );


    CREATE TABLE user
(
	 UserId int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
     prod_Id int(6) NOT NULL,
     animal_Id int(6) NOT NULL,
     Username varchar (150) NOT NULL,
     Fname varchar (150) NOT NULL,
     Lname varchar (150) NOT NULL,
     Email varchar (150) NOT NULL,
     Password varchar (150) NOT NULL,
     PasswordAgain varchar (150) NOT NULL,
     gender varchar (6) NOT NULL,
     address varchar (150) NOT NULL,
     parish varchar (150) NOT NULL,
     country varchar (10) NOT NULL,
     telephone varchar(15) NOT NULL,
     image varchar(150) NOT NULL,
     hash varchar(150) NOT NULL
    );

	CREATE TABLE animals
(
	 animal_Id int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
     UserId int(6) NOT NULL,
     Name varchar (150) NOT NULL,
     Age tinyint(2) NOT NULL,
     Dates varchar(8) NOT NULL,
     Weight decimal(8,2) NOT NULL,
     Units varchar (5) NOT NULL,
     Gender varchar(6) NOT NULL,
     Price decimal(8,2) NOT NULL,
     Description varchar (150) NOT NULL,
     image varchar(150) NOT NULL
     
    );

    */
			                       
                      

    {
      $errors[] = "All fields should be filled";
    }
    
    

    if(count($errors)==0)
    {
   		$uploader = new upload_image();
        $uploader->setFile('uploads/',$path_to_image);
        $file_path=$uploader->get_file_path();
      $sql = "INSERT INTO products (proName, proWeight, proUnits, proPrice, proDescription,image) VALUES ('{$proName}', '{$proWeight}','{$proUnits}','{$proPrice}','{$proDescription}','{$file_path}')";
      $insert = $mysqli->query($sql);
      header('location:UserAccount.php');
       exit();
   
    }

    
    $mysqli->close();
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
			<i class="fa fa-cog fa-lg icons-inHeader"> Settings</i>
			
		</div>
	</div>
</div>
<div class="container">
	<div class="col-lg-12 col-md-12 col-sm-12 style">
		<div class="col-md-2 col-sm-2 side-menu pull-left">
		<img src=<?php echo $user->image ?> class="side-menu-edit" style="width: 188px; height: 160px; margin-left: -4px">
		<h5 style="color:#828282; margin-left:14px;">Hello <?=$user->Fname.' '.$user->Lname?></h5>
		<form role="search" method="get" action="search.php">
				<div class="form-group">
               <input type="text" class="form-control" id="searchInput" placeholder="Search this site" name="q">
               <span class="fa fa-search searchIcon-inside"></span>
           	   </div>
         </form>

         <ul class="navbar navbar-left" style="margin-left: -37px;">
         <li><a href="buyerAcc.php"><i class="main-grey-color fa fa-arrow-left fa-lg"> Switch Accounts</i></a></li><br/>
         <li><a href="#"><i class="main-grey-color fa fa-shopping-cart fa-lg"> Add an item</i></a></li><br/>
    <li><a href="#"><i class="main-grey-color fa fa-trash-o fa-lg"> Delete an item</i></a></li><br/>
    <li><a href="#"><i class="main-grey-color fa fa-wrench fa-lg"> Update an item</i></a></li><br/>
     <li><a href="logout.php"><i class="main-grey-color fa fa-sign-out fa-lg"> Log Out</i></a></li><br/>
     <li><a href="delete.php"><i class="main-grey-color fa fa-cog fa-lg"> User Settings</i></a></li><br/>
    </div> 
		</ul>
		  <?php
if(isset($errors) && is_array($errors) && count($errors)>0):
?>
  <div class="errors">
  <ul>
  <?php foreach($errors AS $e): ?>
    <li class ="errors"><?=$e?></li>
  <?php endforeach; ?>
  </ul>
  </div>
<?php
endif;
?>

		<div class="col-md-10 col-sm-10 content pull-left">
			<h3>Add an Animal or Produce</h3>
			<p><i class="fa fa-home fa-lg"> Home</i></p>
			<div class="col-md-5 col-sm-5 products-section">
				<p style="font-size:1.3em">
					 Animal
				</p>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label">Name:</label>
						<input type="text" class="form-control" name="Name" value="<?=getPostValue('Name')?>"></input>
						<p>
							 Eg: Cow, Pig, Goat...
						</p>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-xs-2 age-unit-edit">
								<label class="control-label">Age:</label>
								<select class="form-control" name="Age" style="margin-top: 5px;">
									<option value=""></option>
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
									<option value="4"> 4 </option>
									<option value="5"> 5 </option>
									<option value="6"> 6 </option>
									<option value="7"> 7 </option>
									<option value="8"> 8 </option>
									<option value="9"> 9 </option>
									<option value="10"> 10 </option>
								</select>
							</div>
						
							<div class="col-xs-2 age-unit-edit">
								<label class="control-label">Date:</label>
								<select class="form-control age-unit-edit" name="Dates">
									<option></option>
									<option>Days</option>
									<option>Weeks</option>
									<option>Months</option>
									<option>Years</option>
								</select>
							</div>
					
							<div class="col-xs-2 age-unit-edit">
								<label class="control-label">Wieght:</label>
								<input type="text" class="form-control age-unit-edit" name="Weight" value="<?=getPostValue('Weight')?>"></input>
							</div>
						
							<div class="col-xs-2 age-unit-edit">
								<label class="control-label">Units:</label>
								<select class="form-control age-unit-edit" name="Units">
									<option>lbs</option>
								</select>
							</div>
						</div>
					</div>
					<br/>
					<div class="form-group">
						<label class="control-label">Animal's Gender:</label>
						<select class="form-control" name="Gender">
							<option>Female</option>
							<option>Male</option>
						</select>
						<p>
							 Eg: Animal's Gender
						</p>
					</div>
					<br/>
					<div class="form-group">
						<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
						<div class="input-group">
							<div class="input-group-addon">
								$
							</div>
							<input type="text" class="form-control" name="Price" value="<?=getPostValue('Price')?>" id="exampleInputAmount" placeholder="Price: eg 15000, 24500">
							<div class="input-group-addon">
								.00
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="comment">Description:</label>
						<textarea class="form-control" rows="5" name="Description"><?=@$_POST['Description']?></textarea>
						<!--end of for input-->
					</div>
					<p>
						image 1 <br>
						 Choose file to upload
					</p>
					<input type="file" name="fileToUpload" id="fileToUpload"></br>
					

					 <!-- <p>
						image 2 <br>
						 Choose file to upload
					</p>
					<input type="file" name="fileToUpload" id="fileToUpload"></br>-->

				 <div class="form-group pulls-left">
		         <input type="submit" name="Add" value="Add More" class="btn btn-info">
		         </div>

		         <div class="form-group pulls-left">
		         <input type="submit" name="Continue" value="Continue" class="btn btn-info">
		         </div>
		         </form>

				<br/><br/>
			</div>
			<div class="col-md-5 col-sm-5 products-section left-sm">
				<p style="font-size:1.3em">
					 Produce
				</p>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label">Name:</label>
						<input type="text" class="form-control" name="proName" value="<?=getPostValue('proName')?>"></input>
						<p>
							 Eg: Tomatos, Yams, Dasheen, Pumpkin...
						</p>
					</div>
					
					<div class="row">
					<div class="form-group">
							<div class="col-xs-2 age-unit-edit">
								<label class="control-label">Wieght:</label>
								<input type="text" class="form-control age-unit-edit" name="proWeight" value="<?=getPostValue('proWeight')?>"></input>
							</div>
						
							<div class="col-xs-2 age-unit-edit">
								<label class="control-label">Units:</label>
								<select class="form-control age-unit-edit" name="proUnits">
									<option>lbs</option>
								</select>
							</div>
						</div>
						</div>
						<br/>

						<div class="form-group">
						<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
						<div class="input-group">
							<div class="input-group-addon">
								$
							</div>
							<input type="text" class="form-control" name= "proPrice" value="<?=getPostValue('proPrice')?>" id="exampleInputAmount" placeholder="Price: eg 15000, 24500">
							<div class="input-group-addon">
								.00
							</div>
						</div>
					</div>
					<br/>


					<div class="form-group">
						<label for="comment">Description:</label>
						<textarea class="form-control" rows="5" name="proDescription"><?=@$_POST['proDescription']?></textarea>
						<!--end of for input-->
					</div>
					<br/>

					<p>
						image 1 <br>
						 Choose file to upload
					</p>
					<input type="file" name="fileToUpload" id="fileToUpload"></br>
					

					 <!-- <p>
						image 2 <br>
						 Choose file to upload
					</p>
					<input type="file" name="fileToUpload" id="fileToUpload"></br>-->

				 <div class="form-group pulls-left">
		         <input type="submit" name="Add" value="Add More" class="btn btn-info">
		         </div>

		         <div class="form-group pulls-left">
		         <input type="submit" name="Continue" value="Continue" class="btn btn-info">
		        
		         </div>
					
				</form>
				<br/>
			</div>
		</div>
		<!--endof content-->
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


<!--live chat script-->
<!-- <script type="text/javascript" src="http://localhost:8080/fieldgroup/livechat/php/app.php?widget-init.js"></script> -->

<!--jQuery (necessary for Bootstarp's javaScript plugins)-->
<script src="js/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>