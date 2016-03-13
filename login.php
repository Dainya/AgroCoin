<?php 
		error_reporting(E_ALL ^ E_NOTICE);
		session_start();
//Only process the form if $_POST isnt empty

		if(isset($_SESSION['logged']))
		{
			header("location:UserAccount.php");
			exit;
		}

$error = false;

function getPostValue($index)
{
	return  isset($_POST[$index]) ? trim($_POST[$index]) : null;
}


	if(! empty($_POST ))
	{
		
    include('connections.php');



		//check if log in button is clicked
		if(isset($_POST['LogIn']))
		{
			
			
			  $EM = getPostValue('Email');
			  $PW = getPostValue('Password');

			  #check database
			  $query = $mysqli->query("SELECT * FROM user WHERE (Email='".$EM."' || Username='".$EM."') AND Password='".md5($PW)."'");

			  if($query->num_rows>0)
			  {
			  	$_SESSION['logged'] = true;
			  	$_SESSION['user'] = json_encode($query->fetch_object());
			  	header("location:UserAccount.php");
			  	exit;
			  }
			  else
			  {
			  	$error = true;
			  }

			  $mysqli->close();
		}
	}
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
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
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
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
            <li><a href="Login.php">Sign In</a></li>
          
          </ul>
   </div>
   </div>
      </nav>
      </header>
    <div class="container">
    

   <div class="col-lg-6 col-md-6 col-sm-6 movePanel-right">
   <h3 style="margin-top:80px; ">Login to Your Account</h3>
   </div>
   
    <div class="container" style="padding-left:27.5%;">
    <?php  if (isset($_SESSION["register"])) { ?>
    <p style="color: #4F8A10;">Congrats! Your account has been created, <br /></p>
    <?php unset($_SESSION['register']); } ?>
    </div>

    <div class="container" style="padding-left:23.5%;">
    <form method='post' action='login.php'>
    <?php  if($error==true): ?>
    <p style="color:#D8000C">Login unsuccessful</p>
    <?php endif; ?>
    </form>
    </div>

          
        <div style="margin-top:65px;" class="  movePanel-right">
           <div class="panel panel-default ">
              <div class="panel-heading panel-heading-custom3 ">
                  <h3 class="panel-title">Sign In</h3>
                  <div style="float:right; font-size: 80%; position: relative; top:-10px" class="panel-title"><a href="#">Forgot password?</a></div>
               </div>
                <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form action="" method="post" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control " placeholder="username or email"  name="Email" value="<?=getPostValue('Email')?>"></input>                                      
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" class="form-control " name="Password" value=""></input>
                            </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input type="submit" id="btn-login" class="btn btn-success" name="LogIn" id="LogIn" value="Login">
                                      </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid #888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="custregistration.php">Sign Up Here</a>
                                        
                                        </div>
                                    </div>
                                </div>    
                            </form>
               </div>
               </div>
               </div>
               <div class="float-left">
              <div class="col-lg-12">
              <img src="img/loginimage.jpg" class="img-responsive"><br/>
                <h4 style="font-family:lucida calligraphy,arial,'sans serif';">
                The Farmer has to be an optimist or he wouldnt still be a farmer.<br/>-Will Rodgers</h4>
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
        


<!--jQuery (necessary for Bootstarp's javaScript plugins)-->
<script src="js/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>