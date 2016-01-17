<?php
	session_start();
	
	//Redirect to login page if session isn't set
	if (!isset($_SESSION["username"])) {
    	header("location: admin_login.php"); 
    	exit();
	}

	else
	{
		//Function to filter inputs
		function filter_any_data($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		//Connect to db
		$conn = mysqli_connect("localhost","root","","main_db");
		if(!$conn){
			die("Error connectiong to db.");
		}

		//Get session variables
		$id = filter_any_data($_SESSION["id"]);
		$username = filter_any_data($_SESSION["username"]);
		$password = filter_any_data($_SESSION["password"]);

		//Fire query to check if the session variables exist in db
		$sql = mysqli_query($conn,"SELECT * FROM admin WHERE id='$id' AND username='$username' AND password='$password'");
		//Count no of rows of result
		$rows = mysqli_num_rows($sql);

		if($rows == 0)
		{
			//The session is forged.
			echo "Your record doesn't exist in the database.";	exit();
		}
		else {
			//The session is valid
		}
	}
?>

<!doctype html>
<html>
	<head>
		<?php require("initBootstrap.php");?>
		<title>Store Admin Area</title>
		
	</head>
	<body>
		<?php require("../navbar_2.php");?>

		<div class="container">
			<h1>Welcome, <?php echo "$username";?>!</h1>
			<h4>What would you like to do?</h4>
			<div class="row">
				<div class="col-sm-10">
					<a href="inventory_list.php"><button class="btn btn-info">Manage Inventory</button></a>
					<a href="enquiry.php"><button class="btn btn-info">Manage Enquiries</button></a>
				</div>
			</div><br><br><br><br><br><br><br><br><br><br><br><br>			
		</div>

		<?php require("../footer.php");?>


		<style type="text/css">	/*Hide Signin and Display Logout button in the navbar*/
			#signin_button{
				display: none;
			}
			#logout_button{
				display: block;
			}
		</style>

		<!--Signout script on clicking logout button-->
		<script type="text/javascript">
			$(document).ready(function(){
				$('#logout_button').click(function(){
					window.location.replace('destroy_session.php');
				});
			});
		</script>
	</body>
</html>