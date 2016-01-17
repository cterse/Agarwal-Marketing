<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Navbar</title>
		<!--Import FA css libs-->
		<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
		<!--Import the Bootstrap css libs-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<!--Import the Bootstrap JQuery and Javascript libs in that order-->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style type="text/css">
			.site-footer{
				background-color: #222222;
				color:white;
				margin-top: 30px;
				padding: 20px;
			}
		</style>
	</head>


	<body>
			
		<header>
			<!--Header Jumbotron-->
			<div class="jumbotron" style="margin-bottom:0px;background-color:black;">
				<div class="container">
					<h1 style="text-align:center;font-family:verdana;color:white;">AGARWAL MARKETING</h1>
				</div>
			</div>	
			<!--Header Jumbotron ends-->

			<!--Navbar starts here-->
			<div class="navbar navbar-inverse" style="padding-top:0%">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="#" class="navbar-brand">AGRAWAL MARKETING</a>
					</div>
					<div class="collapse navbar-collapse" id="mainNavbar">
	 					<ul class="nav navbar-nav">
	 						<li><a href="#">HOME</a></li>
	 						<li><a href="#">PRODUCTS</a></li>
	 						<li><a href="#">ABOUT US</a></li>
	 						<li><a href="#">CONTACT US</a></li>
	 					</ul>
						
	 					<!--Search bar and button-->
	 					<form action="" class="navbar-form navbar-right" role="search">
	 						<div class="form-group">
	 							<input type="text" class="form-control" placeholder="Search Products">
	 						</div>
	 						<button type="submit" class="btn btn-primary">Search</button>
	 					</form>
	 					<!--Search bar and button ends-->

	 					<!--Sign In button with an user icon and tooltip-->
	 					<button type="submit" class="btn btn-success navbar-btn navbar-right" data-toggle="modal" data-target="#myModal" data-placement="auto bottom" title="Sign In">
	 						<span class="glyphicon glyphicon-user"></span>
	 					</button>
	 					<!--Sign In button with an user icon and tooltip ends-->
	 					<!--Modal starts-->
	 					<div id="myModal" class="modal fade" role="dialog">
	 						<div class="modal-dialog">
	 							<div class="modal-content">
	 								<div class="modal-header">
	 									<button type="button" class="close" data-dismiss="modal">&times;</button>
	 									<h4 class="modal-title">Sign In</h4>
	 								</div>
	 								<div class="modal-body">
	 									<form class="form-horizontal" role="form">
										  <div class="form-group">
										    <label class="control-label col-sm-2" for="email">Email:</label>
										    <div class="col-sm-10">
										      <input type="email" class="form-control" id="email" placeholder="Enter email">
										    </div>
										  </div>
										  <div class="form-group">
										    <label class="control-label col-sm-2" for="pwd">Password:</label>
										    <div class="col-sm-10"> 
										      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
										    </div>
										  </div>
										  <div class="form-group"> 
										    <div class="col-sm-offset-2 col-sm-10">
										      <div class="checkbox">
										        <label><input type="checkbox"> Remember me</label>
										      </div>
										    </div>
										  </div>
										  <div class="form-group"> 
										    <div class="col-sm-offset-2 col-sm-10">
										      <button type="submit" class="btn btn-default">Submit</button>
										    </div>
										  </div>
										</form>
	 								<div class="modal-footer">
          								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        							</div>
	 							</div>
	 						</div>
	 					</div>
	 					<!--Modal ends-->

					</div>
				</div>
			</div>
			<!--Navbar ends-->
		</header>

		<!--JQuery Script for Bootstrap tooltips-->
		<script type="text/javascript">
    		$(function () {
        	$("[rel='#myTooltip']").tooltip();
    	});
		</script>
	</body>
</html>