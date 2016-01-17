<?php //Session start and validate session
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

<?php // Script Error Reporting 
  
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
?>

<?php //Insert new product into db

	if(isset($_POST['product_name'])){	
		if(isset($_POST["product_name"]) && isset($_POST["product_price"]) && isset($_POST["product_details"]) && isset($_POST["product_category"]) && isset($_POST["product_ID"])){

			$p_id = mysql_real_escape_string($_POST['product_ID']);
			$p_name = mysqli_real_escape_string($conn,$_POST["product_name"]);
			$p_price = mysqli_real_escape_string($conn,$_POST["product_price"]);
			$p_details = mysqli_real_escape_string($conn,$_POST["product_details"]);
			$p_category = mysqli_real_escape_string($conn,$_POST["product_category"]);

			$sql = mysqli_query($conn,"UPDATE products SET product_name='$p_name',price='$p_price',details='$p_details',category='$p_category' WHERE id='$p_id'") or die(mysqli_error($conn));
			if(!$sql){
				die("Problem with query");
			}	
			//Write code to upload file
			
		  	header("location: inventory_list.php"); 
		    exit();
		}
		else{
			echo "Form field error"; exit();
		}
	}
?>

<?php //Gather product information from GET variable on prev page	
	if(isset($_GET['pid'])){
		$targetID = $_GET['pid'];
		$sql = mysqli_query($conn,"SELECT * FROM products WHERE id='$targetID' LIMIT 1");
		$productCount = mysqli_num_rows($sql);
		if($productCount > 0){
			while($row = mysqli_fetch_array($sql)){
				$name = $row['product_name'];
				$details = $row['details'];
				$price = $row['price'];
				$category = $row['category'];
				$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			}
		}
		else{
			echo "The product doesn't exist.";
			exit();
		}
	}
?>

<!doctype html>
<html>
	<head>
		<?php require("initBootstrap.php");?>
		<title>Product Update Page</title>
	</head>
	<body>
		<?php require("../navbar_2.php");?>

		<div class="container">

			<!--Enter product link-->
			<div class="row">
				<div class="col-sm-9">
					<h2>Product Update Page</h2>
				</div>
			</div>

			<!--New product form-->
			<h3 style="border-bottom:0.05em solid grey;margin-bottom:1em;"><a name="form" style="text-decoration:none;color:black;">Update The Required Fields</a></h3>
			
			<form enctype="multipart/form-data" role="form" class="form-horizontal" action="inventory_edit.php" name="enterProductForm" method="POST">

				<div class="form-group">
					<label class="control-label col-sm-2">Product Name: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="<?php echo "$name";?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Product Price: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="product_price" name="product_price" placeholder="Price in INR" value="<?php echo "$price";?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Product Details: </label>
					<div class="col-sm-5">
						<textarea type="text" class="form-control" name="product_details" id="product_details"><?php echo "$details";?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Product Category: </label>
					<div class="col-sm-5">
						<select class="form-control" id="product_category" name="product_category">
							<option value="<?php echo "$category";?>"><?php echo "$name";?></option>
							<option value="clothing">Clothing</option>
							<option value="raw">Raw Material</option>
							<option value="decoration">Decoration</option>
							<option value="misc">Miscellaneous</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Product Image: </label>
					<div class="col-sm-5">
						<label class="form-control">
          					<input type="file" name="product_image" id="product_image"/>
        				</label>
					</div>
				</div>

				<input name="product_ID" id="product_ID" type="hidden" value="<?php echo $targetID; ?>" />

				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-2">
						<button class="btn btn-info" type="submit">Update Information</button>
					</div>
					<div class="col-sm-3" style="margin-left:5.5em;">
						<a type="button" id="clear_button" name="clear_button" class="btn btn-danger">Clear Fields</a>
						<a type="button" id="cancel_button" name="cancel_button" class="btn btn-danger">Cancel</a>
					</div>
					
				</div>

			</form>
		</div>

		<?php require("../footer.php");?>

		<!--Hide Signin and Display Logout button in the navbar-->
		<style type="text/css">
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

				$('#clear_button').click(function(){
					$('#product_name').val("");
					$('#product_category').val("");
					$('#product_price').val("");
					$('#product_details').val("");
				});

				$('#cancel_button').click(function(){
					window.location.replace('inventory_list.php');
				});
			});
		</script>
	</body>
</html>