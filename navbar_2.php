<?php

	if(isset($_POST['search'])){
		$search = $_POST['search'];
		header("location: http://localhost/agar/boot/search.php?search=$search");
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<!--Setting the viewport-->
		<meta name="viewport" content="width=device-width initial-scale=1.0">

		<link rel="shortcut icon" href="favicon.ico"/>

		<!--Importing file containing import lines for BS-->
		<?php require("initBootstrap.php");?>
		
		<style type="text/css">
			#logout_button{
				display: none;
			}
		
		</style>

	</head>

	<body>

		<!--loginModal code-->
		<?php require("loginModal.php");?>


		<!--Navbar starts-->
		<div class="navbar navbar-inverse">
			<div class="container-fluid">

				<div class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			    		<span class="icon-bar"></span>
			        	<span class="icon-bar"></span>
			        	<span class="icon-bar"></span> 
			    	</button>

					<a class="navbar-brand" href="http://localhost/Agarwal-Marketing/home_2.php"><img src="http://localhost/Agarwal-Marketing/res/am.png" height="45" width="55" style="margin-top:-0.68em;"></a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
				<!--Links in the navbar--> 
				<ul class="nav navbar-nav">
					<li id="one"><a href="http://localhost/Agarwal-Marketing/home_2.php">Home</a></li>
					<li id="two"><a href="http://localhost/Agarwal-Marketing/HMIproducts.php">Products</a></li>
					<li id="three"><a href="http://localhost/Agarwal-Marketing/about.php">About Us</a></li>
					<li id="four"><a href="http://localhost/Agarwal-Marketing/contact_us1.php">Contact Us</a></li>
				</ul>

				<!--The signin Button-->
					<button id="signin_button" style="margin-right:2em;" type="button" class="btn btn-success navbar-btn navbar-right nav-signin" data-toggle="modal" data-target="#loginModal">
						Sign In
					</button>
					
				<!--The logout Button-->
				<button id="logout_button" style="margin-right:2em;" type="button" class="btn btn-danger navbar-btn navbar-right">
					Log Out
				</button>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
          				<a id="new_button" class="dropdown-toggle" data-toggle="dropdown" href="#">User
          				<span class="caret"></span></a>
          				<ul class="dropdown-menu">
				            <li><a href="#">Cart</a></li>
				            <li><a href="#">Something Else</a></li>
				            <li><a href="#">Something Else</a></li> 
          				</ul>
        			</li>
				</ul>
				
				<!--The Search Form-->
				<form class="navbar-form navbar-right" role="search" action="http://localhost/Agarwal-Marketing/navbar_2.php" method="post">
  					<div class="form-group">
    					<input type="text" size="50" name="search" id="search" class="form-control" placeholder="Search">
 				 	</div>
  					<button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>

				</form>
				</div>
			</div>
		</div>
		<!--Navbar ends-->

	</body>
</html>