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
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="logo">
				 Logo goes Here
			</div>

			<i class="fa fa-user fa-lg icons-inHeader"> <?=$user->Fname?></i>
			<i class="fa fa-cog fa-lg icons-inHeader"> Settings</i>
		</div>
	</div>
</div>
<div class="container">
	<div class="col-lg-12 col-md-12 col-sm-12 style">
		<div class="col-md-2 col-sm-2 side-menu pull-left ">
			<img src=<?php echo $user->image ?> class="side-menu-edit" style="width: 188px; height: 146px; margin-left: -4px">
		<h5 style="color:#828282; margin-left:14px;">Hello <?=$user->Fname.' '.$user->Lname?></h5>
					<form role="search" method="get" action="search.php">
				<div class="form-group">
					<input type="text" class="form-control" id="searchInput" placeholder="Search this site" name="q">
					<span class="fa fa-search searchIcon-inside"></span>
				</div>
			</form>
			<ul class="navbar navbar-left" style="margin-left: -38px;">
				<li><a href="#"><i class="main-grey-color fa fa-shopping-cart fa-lg"> Orders</i></a></li>
				<br/>
				<li><a href="#"><i class="main-grey-color fa fa-star-o fa-lg"> Favorites</i></a></li>
				<br/>
				<li><a href="#"><i class="main-grey-color fa fa-wrench fa-lg"> Update Order</i></a></li>
				<br/>
				<li><a href="logout.php"><i class="main-grey-color fa fa-sign-out fa-lg"> Log Out</i></a></li>
				<br/>
				<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" a
          ria-expanded="false"><i class="main-grey-color fa fa-cog fa-lg"> User Settings </i><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="update.php" style="padding:10px; color:#333;">Update Acount</a></li>
            <li><a href="#" style="padding:10px; color:#333;">Delete Account</a></li>
         </ul>
       </li>
			</div>
		</ul>
		<div class="container padding">
		<h3>Dashboard</h3>			
			<i class="fa fa-database fa-4x icons-edit buyers-edit">
			<h4 class="pull-right">105 <br/>New animals added</h4>
			</i>
			
			

			
			<i class="fa fa-shopping-cart fa-4x icons-edit2 buyers-edit">
			<h4 class="pull-right">15 <br/>New produce added</h4>
			</i>
			
		
			
			<i class="fa fa-tasks fa-4x icons-edit3 buyers-edit">
			<h4 class="pull-right">3 <br/> New tasks</h4>
			</i>
			<p class="bg-info width" style="width:780px"><i class="fa fa-bar-chart">Place and Order</i></p>
			
			<img src="img/veggies2.jpg" class="img-responsive" atl="vegies" height="450" width="780" style="padding-bottom:3%;"/>

		 	

			<h3>Inventory Items</h3>
			<table border="1" style="width: 60%; height: 50px; border:1px solid #f4f4f4" cellpadding="1">
			<tr>
				<td style="text-align:center;">
					<strong>Farmer</strong>
				</td>
				<td style="text-align:center;">
					<strong>Type</strong>
				</td>
				<td style="text-align:center;">
					<strong>Name</strong>
				</td>
				<td style="text-align:center;">
					<strong>Price</strong>
				</td>
				<td style="text-align:center;">
					<strong>Weight</strong>
				</td>
			</tr>
			<tr>
				<td>
				<?=$user->Fname.' '.$user->Lname?>
				</td>
				<td>
					 <a></a>
				</td>
				<td>
					<p>
					<!--?=$animals->Price?-->
					</p>
				</td>
				<td>
					<!-- <p>
					<?=$animals->Weight?>
					</p> -->
				</td>
				<td>
					<p>
					</p>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<a></a>
				</td>
				<td>
					<p>
					</p>
				</td>
				<td>
					<p>
					</p>
				</td>
				<td>
					<p>
					</p>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<a></a>
				</td>
				<td>
					<p>
					</p>
				</td>
				<td>
					<p>
					</p>
				</td>
				<td>
					<p>
					</p>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<a></a>
				</td>
				<td>
					<p>
					</p>
				</td>
				<td>
					<p>
					</p>
				</td>
				<td>
					<p>
					</p>
				</td>
				<tr>
					<td>
					</td>
					<td>
						<a></a>
					</td>
					<td>
						<p>
						</p>
					</td>
					<td>
						<p>
						</p>
					</td>
					<td>
						<p>
						</p>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<a></a>
					</td>
					<td>
						<p>
						</p>
					</td>
					<td>
						<p>
						</p>
					</td>
					<td>
						<p>
						</p>
					</td>
					<tr>
						<td>
						</td>
						<td>
							<a></a>
						</td>
						<td>
							<p>
							</p>
						</td>
						<td>
							<p>
							</p>
						</td>
						<td>
							<p>
							</p>
						</td>
					</tr>
					</table>
				</div>
			</div>
			</div>
			  </div>
	<div class="container footer-bar">
   <div class="row">
      <div class="col-sm-12">
         <p class="navbar-text">
              &copy;AgroCoin</class>
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