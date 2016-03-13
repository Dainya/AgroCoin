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
<title>search results</title>
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
		<img src=<?php echo $user->image ?> class="side-menu-edit" style="width: 188px; height: 146px; margin-left: -4px">
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
				<div class="container search_results">
				<?php
					  include('connections.php');
					 
					 if(!$mysqli)
					 {
					 ?>
						<p>We cannot process your query at this time</p>
					<?php
					 }
					 else
					 {
						if(isset($_GET['q']))
						{
							$q = $_GET['q'];
							
							// $query = mysqli_query($mysqli, "select * from user where Fname 
							// 	LIKE '%".$q."%' OR Lname LIKE '%".$q."%'");
							
							$query = mysqli_query($mysqli, "SELECT p.*, a.*, u.* FROM products p, animals a, user u WHERE 'p.UserId = u.UserId, a.UserId= u.UserId' ");
							if(mysqli_num_rows($query)>0)
							{
								while($row=mysqli_fetch_assoc($query))
								{
									?>
								<div class="col-lg-3 margin-bottom pull-left border-bottom">
											
												
								<span>Firstname : <?=$row->Fname?></span><br/>
								<span>Lastname : <?=$row->Lname?></span><br/>
								<span>Parish : <?=$row->parish?></span><br/>
								<span>Email : <?=$row->prodname?></span><br/>
								<span>Email : <?=$row->proPrice?></span><br/>
								<span>Email : <?=$row->Name?></span><br/>
								<span>Email : <?=$row->Price?></span><br/>
								</div>
											
									
									
									<?php
								}
							}
							else
							{
								echo '<p>No results were found, try searching again!</p>';
								echo '<p style="padding-bottom:45%;">by checking the spelling</p>';
								
							}
							
							
						}
						else
						{
							echo '<p>Please enter a search criteria </p>';
						}
					 }
					 
					 if($mysqli)
					 {
						mysqli_close($mysqli);
					 }
				
				?>
				
				
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

<!--navbar-->
<!--end of navbar navbar-inverse navbar-fixed-bottom-->



<!--jquery necessary for google geoloation-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="https://maps.google.com/maps/api/js?sensor=true"></script>

<!--jQuery (necessary for Bootstarp's javaScript plugins)-->
<script src="js/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>