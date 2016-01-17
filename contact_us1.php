<?php 	//add query to database
	$success = "";
	if(isset($_POST['enquiry'])){
		if(isset($_POST['enquiry']) && isset($_POST['name']) && isset($_POST['email'])){
			$enquiry = $_POST['enquiry'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$company_name = $conpany_address = "";
			if(isset($_POST['company_name'])){
				$company_name = $_POST['company_name'];
			}
			if(isset($_POST['company_address'])){
				$company_address = $_POST['company_address'];
			}
			
			$conn = mysqli_connect("localhost","root","","main_db");
			if(!$conn){
				die("connection to db error.");
			}
			
			$sql = mysqli_query($conn,"INSERT INTO query (query,username,email,c_name,c_address,date_added) VALUES ('$enquiry','$name','$email','$company_name','$company_address',NOW())") or die(mysqli_error($conn));

			$success =  "Query successfully submitted.";

			//send an email to cterse@gmail.com
			$recipient = "cterse@gmail.com";
			$subject = "Testing forms to email transfers.";
			$sender = $name;
			$senderEmail = $email;
			$message = $enquiry;
			$mailBody = "Name: $sender\nEmail: $senderEmail\nMessage: $enquiry\n";
			mail($recipient, $subject, $mailBody, "From: abc@gmail.com");
		} else{
			echo "Please fill the required fields.";
		}
	}
?>

<!doctype html>
<html>
    <head>
        
        <title>Contact us</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/smoothscroll.js"></script>
		<link rel="stylesheet" type="text/css" href="font-awesome-4.4.0/css/font-awesome.min.css">
		<link rel="shortcut icon" href="http://localhost/agar/boot/favicon.ico"/>


        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Import the Bootstrap css libs-->
		<!--Import the Bootstrap JQuery and Javascript libs in that order-->
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		-->
		<!--style section for google map-->
		<style>
			body { 
		  		background-color:#CCC 
		  	}
			#map-outer {  
			  	height: 300px; 
				padding: 20px; 
				border: 2px solid #CCC; 
				margin-bottom: 20px; 
				background-color:#FFF
			}
		  	#map-container { 
		  		height: 300px 
		  	}
		  	@media all and (max-width: 991px) {
				#map-outer  { 
					height: 650px 
				}
			}
			.close-success:hover{
				cursor: pointer;
			}
			.successMessage{
				color: maroon;
				background-color: lavender;
				border-radius: 1em;
				margin:10em;
			}
			.successMessage:hover{
				cursor:pointer;
				color:red;
			}
		</style>		
		<script type="text/javascript">
			$(document).ready(function(){
				$("#four").addClass("active");
			});
		</script>
            
    </head>
    
    <body>
    	<?php require("navbar_2.php");?>
		<!--container excluding navbar and footer for background image to content-->
		<div class="container-fluid" style="background-color:lavender;margin-top:-1.4em;margin-bottom:-1.6em;">	
	
			<div class="container"> <!--container for address and enquiry form-->
	
				<!--section for address and details-->
				<div class="col-sm-4">
				
					<div id="address">
						<div class="page-header">
						<h2>Our Location</h2>
						</div>
						<address style="padding-left:20px">
							<p><strong><span class="glyphicon glyphicon-map-marker" style="color:BLUE;"></span>AGARWAL MARKETING</strong><br/>
							<span style="padding-left:20px"></span>Shop no. L-8, near sai service gate,<br/>
							<span style="padding-left:20px"></span>D.S. Road, Gandhinagar,<br/>
							<span style="padding-left:20px"></span>Worli, Lower Parel,<br/>
							<span style="padding-left:20px"></span>Mumbai-400 013<br/></p>
							<p><abbr><span class="glyphicon glyphicon-phone-alt" style="color:BLUE;"></span> P:</abbr> 022-24966056<br/>
							<abbr><span class="glyphicon glyphicon-phone-alt" style="color:BLUE;"></span> P:</abbr> 022-24955928<br/></p>
							<p><abbr><span class="glyphicon glyphicon-phone" style="color:BLUE;"></span> M:</abbr> 9320857310<br/></p>
							<p><span class="glyphicon glyphicon-envelope" style="color:blue;"></span> agarwalmarketingmumbai@gmail.com</p>
						</address>
					</div>
				
				</div>
				<!--section for address ends-->
				
				<!--section for enquiry form-->
				<div class="col-sm-8">
					
					<div class="page-header">
					<h2>Business Enquiry Form</h2>
					</div>
					<form action="contact_us1.php" method="POST" class="form-horizontal" role="form" style="padding-right:10%">
						<div class="form-group">
							<label class="control-label col-sm-3" for="enquiry"><span class="fa fa-asterisk" style="color:pink;"></span>&nbsp;Enquiry:</label>
							<div class="col-sm-9">
							<textarea class="form-control" name="enquiry" rows="6" id="comment" placeholder="Describe your requirements in detail like: products you are looking for features/specifications application/usage, minimum order quantity, etc.. to get best quotes!!" required></textarea>
							</div>
						</div>
							
						<div class="form-group">
						
 						<label class="control-label col-sm-3" for="companyname">Company name:</label>
						
						<div class="col-sm-9">
						<input type="text" name="company_name" class="form-control" id="name" placeholder="Enter company name">
						</div>
						</div>

						<div class="form-group">
 						<label class="control-label col-sm-3" for="name"><span class="fa fa-asterisk" style="color:pink;"></span>&nbsp;Contact person:</label>
						<div class="col-sm-9">
						<input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required>
						</div>
						</div>					

						<div class="form-group">
						<label class="control-label col-sm-3" for="email"><span class="fa fa-asterisk" style="color:pink;"></span>&nbsp;Email:</label>
						<div class="col-sm-9">
						<input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
						</div>
						</div>
						
						<div class="form-group">
						<label class="control-label col-sm-3" for="address">Address:</label>
						<div class="col-sm-9">          
						<input type="text" name="company_address" class="form-control" id="address" placeholder="Enter company adrress">
						</div>
						</div>
						
						<div class="form-group">        
						<div class="col-sm-offset-2 col-sm-10" style="margin-right:3em;">
						<button type="submit" class="btn btn-primary">Send Enquiry</button>&nbsp;&nbsp;<div><span class="successMessage" onclick="this.parentNode.style.display = 'none';"><?php echo "$success";?></span></div>
						</div>
						</div>
					
					</form>
					<div class="col-sm-3"></div>
					
				</div>
				<!--section for enquiry form ends-->	
			</div>
			<!--container for address and enquiry form ends-->
			
			
				
			<!--section for google maps-->
			<div class="container" style="margin-top:10px">
				
				<div id="map-container">
							
					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
					
					<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
					<script>	
						 
						function init_map() {
						var var_location = new google.maps.LatLng(18.995010, 72.823071);
						 
						var var_mapoptions = {
							center: var_location,
							zoom: 14
						};
						 
						var var_marker = new google.maps.Marker({
							position: var_location,
							map: var_map,
							title:"Agarwal Marketing"});
						 
						var var_map = new google.maps.Map(document.getElementById("map-container"),
							var_mapoptions);
						 
							var_marker.setMap(var_map);	
						 
							}
						 
						google.maps.event.addDomListener(window, 'load', init_map);
						 
					</script>
								
				</div><!-- /map-outer -->
				
			</div>
			<!--section for map ends-->
			<br><br>

		</div>
		<!--end of background image container-->
		<?php require("footer.php");?>
		<script type="text/javascript">
			function close(){
				document.getElementById("success").style.display = "none";
			}
		</script>
    </body>

</html>