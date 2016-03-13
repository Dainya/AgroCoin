<?php session_start();

//Only process the form if $_POST isnt empty

if(isset($_SESSION['logged']))
    {
      header("location:useraccount.php");
      exit;
    }


function getPostValue($index)
{
  return  isset($_POST[$index]) ? trim($_POST[$index]) : null;
}


if(! empty($_POST )){
  
  include('connections.php');

    //check errors

    $Username = getPostValue('Username');
    $Fname = getPostValue('Fname');
    $Lname = getPostValue('Lname');
    $Email = getPostValue('Email');
    $Password = getPostValue('Password');
    $PasswordAgain = getPostValue('PasswordAgain');
    $gender = getPostValue('gender');
    $address = getPostValue('address');
    $parish = getPostValue('parish');
    $country = getPostValue('country');
    $telephone = getPostValue('telephone');
    $image = getPostValue('image');
    $path_to_image =$_FILES["fileToUpload"]["name"];
    
    
    //password 7&hFFF!@%{!=}

    $errors = [];
      

    require_once("Validator.php");
    require_once("test_upload.php");
    $Validator = new Validator();

    if($Validator->isNull($Username) ||
         $Validator->isNull($Fname) || 
          $Validator->isNull($Lname) || 
            $Validator->isNull($Email) || 
              $Validator->isNull($Password)||
              $Validator->isNull($PasswordAgain)||
                $Validator->isNull($gender)||
                  $Validator->isNull($address)||
                    $Validator->isNull($parish)||
                     $Validator->isNull($country)||
                       $Validator->isNull($telephone))
                      
                       
                      

    {
      $errors[] = "All fields should be filled";
    }


    if(!$Validator->isEmail($Email))
    {
      $errors[] = "Email is invalid";
    }

    

    //database level validation

    $check = "SELECT UserId FROM user where Email='".$Email."'";

    $check = $mysqli->query($check);

    if($check->num_rows>0)
    {
      $errors[] = "Email already exists";
    }

    $check = "SELECT UserId FROM user where Username='".$Username."'";

    $check = $mysqli->query($check);

    if($check->num_rows>0)
    {
      $errors[] = "Username already exists";
    }



    if(count($errors)==0)
    {
        $_SESSION['register'] = true;
        $hash = md5( rand(0,1000) );
        $storePassword = md5($Password); //md5 password
        $storePassword2 = md5($PasswordAgain); //md5 password
      if($storePassword==$storePassword2){
        $uploader = new upload_image();
        $uploader->setFile('uploads/',$path_to_image);
        $file_path=$uploader->get_file_path();
    
      $sql = "INSERT INTO user (Username, Fname, Lname, Email, Password,PasswordAgain,hash, gender, parish, address, country, telephone,image) VALUES ('{$Username}', '{$Fname}','{$Lname}','{$Email}','{$storePassword}','{$storePassword2}','{$hash}','{$gender}','{$parish}', '{$address}','{$country}','{$telephone}','{$file_path}')";
      $insert = $mysqli->query($sql);
      header('location:login.php');
      exit();
    }
    else
    {
      $errors[]= "Password doesn't match";
    }

    }
    
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Registration</title>
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
<header>
<nav class="navbar navbar-custom  navbar-fixed-top" role="navigation">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
          <div class="col-lg-4 col-md-4 col-sm-4">
         <a class="navbar-brand" href="#"><img src="img/logo2.png" alt="agrocoin logo" class="logo-section2"/></a>
       </div>
      </div>

          <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.html">Home</a></li>
             <li><a href="gallery.html">About</a></li>
             <li><a href="gallery.html">Services</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="login.php">Sign in</a></li> 
         <!--end navbar form-->
      </ul>
   </div>
   </div>
      </nav>
      </header>
   <div class="container">
   <h2 style="margin-top:80px;">Customer's registration form...</h2>

   <div class="customer-register">
   <div class="container">
   <i class="fa fa-users fa-lg"> Customers Registration</i>
   </div>
   </div>
  
   <div class="customer-form-field">
   <div class="conatainer">
   <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12">
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
   <form action="" method="post" enctype="multipart/form-data">
   <div class="form-group cus-formfield-smaller">
            <label class="control-label">Username:<span class="red">*</span></label>
            <input type="text" class="form-control " placeholder="Eg: username"  name="Username" value="<?=getPostValue('Username')?>"></input>
          </div>
    <div class="form-group cus-formfield-smaller">
            <label class="control-label">Firstname:<span class="red">*</span></label>
            <input type="text" class="form-control " placeholder="Eg: John"  name="Fname" value="<?=getPostValue('Fname')?>"></input>
          </div>
    <div class="form-group cus-formfield-smaller">
            <label class="control-label">Lastname:<span class="red">*</span></label>
            <input type="text" class="form-control " placeholder="Eg: Doe"  name="Lname" value="<?=getPostValue('Lname')?>"></input>
          </div>
    <div class="form-group cus-formfield-smaller">
            <label class="control-label">Email:<span class="red">*</span></label>
            <input type="text" class="form-control " placeholder="Eg: name@aol.com"  name="Email" value="<?=getPostValue('Email')?>"></input>
          </div>
    <div class="form-group cus-formfield-smaller">
            <label class="control-label">Password:<span class="red">*</span></label>
            <input type="password" class="form-control " name="Password" value=""></input>
          </div>
    <div class="form-group cus-formfield-smaller">
            <label class="control-label">Confirm Password:<span class="red">*</span></label>
            <input type="password" class="form-control " name="PasswordAgain" value=""></input>
            <?php 
            $ctr= 0;
            if($ctr === 0){// if count variable ctr is 0 then that means there were no errors and the password is strong
             $errors[] = "<span style=color:green>-Strong Password</span>";
             }
            ?>

          </div>
    <div class="form-group cus-formfield-smaller">
            <label class="control-label">Gender:<span class="red" name="gender" value="<?=getPostValue('gender')?>">*</span></label>
            <select class="form-control" name="gender">
              <option>Female</option>
              <option>Male</option>
            </select>
      </div>
      <div class="form-group cus-formfield-smaller">
            <label class="control-label">Street Address:<span class="red">*</span></label>
            <input type="text" class="form-control " name="address" value="<?=getPostValue('address')?>"></input>
          </div>
      <div class="form-group cus-formfield-smaller">
        <label class="control-label">Parish:<span class="red" name="parish" value="<?=getPostValue('parish')?>">*</span></label>
        <select  class="form-control" name="parish">
          <option value=""></option>
          <option value="Hanover">Hanover</option>
          <option value="Westmoreland">Westmoreland</option>
          <option value="Trelawny">Trelawny</option>
          <option value="St. Elizabeth">St. Elizabeth</option>
          <option value="St. Catherine">St. Catherine</option>
          <option value="St. Mary">St. Mary</option>
          <option value="St. Ann">St. Ann</option>
          <option value="Manchester">Manchester</option>
          <option value="Clarendon">Clarendon</option>
          <option value="Kingston">Kingston</option>
          <option value="St. Andrew">St. Andrew</option>
          <option value="Portland ">Portland </option>
          <option value="St. Thomas">St. Thomas</option>
          <option value="St. James">St. James</option>
        </select>
      </div>
       <div class="form-group cus-formfield-smaller">
            <label class="control-label">Country:<span class="red">*</span></label>
            <input type="text" class="form-control "  placeholder="Eg: Jamaica" name="country" value="<?=getPostValue('country')?>"></input>
          </div>
      <div class="form-group cus-formfield-smaller">
               <label class="control-label">Cellphone#:<span class="red">*</span></label>
               <input type="tel" class="form-control" name="telephone" placeholder="876-123-4567" value="<?=getPostValue('telephone')?>"></input><!--end of for input-->
            </div>
      
      <div class="form-group cus-formfield-smaller">
          <label class="control-label">Profile Picture:<span class="red">*</span></label>
          <input type="file" name="fileToUpload" id="fileToUpload"></br>
          </div>

        <div class="form-group pulls-left">
         <input type="submit" name="register" value="register" class="btn btn-success btn-lg">
         </div>


   </form>
   </div>
   </div>
   </div>
   </div>

   <p class="bg-info width">Information collected is stored securely and is never shared without owners consent!</p>
   
 <div class="container footer-bar">
   <div class="row">
      <div class="col-sm-12">
         <p class="navbar-text">
              &copy;AgroCoin 2016</class>
         </p>
      </div>
     
     
   </div>
  
</div>

<!--jQuery (necessary for Bootstarp's javaScript plugins)-->
<script src="js/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>