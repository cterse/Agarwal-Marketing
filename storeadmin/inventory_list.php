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

<?php //Delete products
	if(isset($_GET['deleteid'])) {
		echo "Do you really want to delete this product?";
		echo '  <a href="inventory_list.php?yesdelete='. $_GET['deleteid'] .'">Yes</a> | <a href="inventory_list.php">No</a>  ';
		exit();
	}
	if(isset($_GET['yesdelete'])) {
		// remove item from system and delete its picture
  		// delete from database
  		$id_to_delete = $_GET['yesdelete'];
  		$sql = mysqli_query($conn,"DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die (mysql_error());
  		// unlink the image from server
  		// Remove The Pic -------------------------------------------
      	$pictodelete = ("../inventory_images/$id_to_delete.jpg");
      	if (file_exists($pictodelete)) {
         	unlink($pictodelete);
      	}
  		header("location: inventory_list.php"); 
      	exit();
	}
?>

<?php //add products to db

	if(isset($_POST['product_name'])){
		if(isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_category']) && isset($_POST['product_details'])){

			$p_name = mysqli_real_escape_string($conn,$_POST['product_name']);
			$p_price = mysqli_real_escape_string($conn,$_POST['product_price']);
			$p_details = mysqli_real_escape_string($conn,$_POST['product_details']);
			$p_category = mysqli_real_escape_string($conn,$_POST['product_category']);

			//Check if product with same name already exists
			$sql = mysqli_query($conn,"SELECT id FROM products WHERE product_name = '$p_name'");
			if(mysqli_num_rows($sql)>0){
				echo "Product Already exists.";
				exit();
			}

			//Add product to db
			$sql = mysqli_query($conn,"INSERT INTO products (product_name,price,details,category,date_added) VALUES ('$p_name','$p_price','$p_details','$p_category',NOW())") or die(mysqli_error($conn));;
			
			$pid = mysql_insert_id();
    		// Place image in the folder 
  			$newname = "$pid.jpg";
  			move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
  			header("location: inventory_list.php"); 
      		exit();
		}
	}

?>

<?php  //Grab products for viewing

	$product_list = "";
	require("../connectToDB.php");

	if(isset($_GET['orderbyname'])){
		$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY product_name ASC");	
	}
	else if(isset($_GET['orderbydate'])){
		$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY date_added DESC");	
	}
	else if(isset($_GET['orderbycategory'])){
		$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY category ASC");	
	}
	else if(isset($_GET['orderbyprice'])){
		$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY price DESC");	
	}
	else if(isset($_GET['orderbyid'])){
		$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY id ASC");	
	}
	else{
		$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY id ASC");
	}
	$productCount = mysqli_num_rows($sql);
	if($productCount > 0)
	{
		while($row = mysqli_fetch_array($sql)){
			$id = $row["id"];
			$p_name = $row["product_name"];
			$p_price = $row["price"];
			$p_category = $row["category"];
			$p_date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			$product_list .= "<tr>
								<td>$id</td>
								<td><strong>$p_name</strong></td>
								<td>Rs. $p_price</td>
								<td>$p_date_added</td>
								<td><a href='inventory_edit.php?pid=$id'>Edit</a> &bull; <a href='inventory_list.php?deleteid=$id'>Delete</a><br /></td>
								</tr>";
		}
	}
	else{
		$product_list =  "No products available... Yet!";
	}
?>

<!doctype html>
<html>
	<head>
		<?php require("initBootstrap.php");?>
		<title>Inventory List</title>
	</head>
	<body>
		<?php require("../navbar_2.php");?>
		<p style="margin-left:8%;"><a href="enquiry.php">Go to Enquiry Management Center</a></p>

		<div class="container">

			<!--Enter product link-->
			<div class="row">
				<div class="col-sm-9">
					<h2>Inventory Management Center</h2>
				</div>
				<div class="col-sm-3">
					<a href="#form" class="smoothScroll"><button id="enter_item_button" class="btn btn-success">Enter New Item</button></a>
				</div>
			</div>

			<!--Div for displaying products list-->
			<div>
				<br>
				<h3 style="border-bottom:0.05em solid grey;margin-bottom:0.2em;">Products List</h3>
					<input style="margin-left:79%;margin-bottom:1em;padding:0.3em;" id="searchText" placeholder="Search" onkeyup="doSearch()" type="text">
					<table class="table" id="productsTable">
						<thead>
							<th onclick="sortById()">Product ID&nbsp;<span id="id_span" class="fa fa-caret-down" style="color:grey;"></span></th>
							<th onclick="sortByName()">Product Name&nbsp;<span id="name_span" class="fa fa-caret-down" style="color:grey;"></span></th>
							<th onclick="sortByPrice()">Product Price&nbsp;<span id="price_span" class="fa fa-caret-down" style="color:grey;"></span></th>
							<th onclick="sortByDate()">Date Added&nbsp;<span id="date_span" class="fa fa-caret-down" style="color:grey;"></span></th>
							<th>Operations</th>
						</thead>
						<tbody>
							<?php echo "$product_list"; ?>
						</tbody>
					</table>
			</div>

			<!--New product form-->
			<h3 style="border-bottom:0.05em solid grey;margin-bottom:1em;"><a name="form" style="text-decoration:none;color:black;">Product Entry Form</a></h3>
			
			<form enctype="multipart/form-data" role="form" class="form-horizontal" action="inventory_list.php" name="enterProductForm" method="POST">

				<div class="form-group">
					<label class="control-label col-sm-2">Product Name: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Product Price: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="product_price" name="product_price" placeholder="Price in INR">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Product Details: </label>
					<div class="col-sm-5">
						<textarea type="text" class="form-control" name="product_details" id="product_details"></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Product Category: </label>
					<div class="col-sm-5">
						<select class="form-control" id="product_category" name="product_category">
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

					<div class="col-sm-2"></div>
					<div class="col-sm-3">
						<button class="btn btn-info" type="submit">Add Product</button>
					</div>

					<div class="col-sm-3">
						<a type="button" id="clear_button" class="btn btn-danger">Clear Fields</a>
					</div>

			</form>
			
		</div>


		<?php require("../footer.php");?>

		<!--Hide Signin and Display Logout button in the navbar-->
		<style type="text/css">
			.fa-caret-down{
				display: none;
			}
			#signin_button{
				display: none;
			}
			#logout_button{
				display: block;
			}
			table th{
				text-align: center;
			}
			table th:hover{
				cursor: pointer;
				text-decoration: underline;
			}
			table thead{
				background-color: lavender;
			}
			table td{
				text-align: center;
			}
			#searchText{
				padding: 0.5em;
				margin-left: 50%;
				width: 15em;
			}
		</style>

		
		<script type="text/javascript">
			$(document).ready(function(){
				//Signout script on clicking logout button
				$('#logout_button').click(function(){
					window.location.replace('destroy_session.php');
				});

				//Clear Button Script
				$('#clear_button').click(function(){
					$('#product_name').val("");
					$('#product_category').val("");
					$('#product_price').val("");
					$('#product_details').val("");
				});

				var currentURL = window.location.href;
				if(currentURL.indexOf("?")==-1)
					document.getElementById("id_span").style.display = "inline";
				if(currentURL.indexOf("name")!=-1)
					document.getElementById('name_span').style.display = "inline";
				if(currentURL.indexOf("price")!=-1)
					document.getElementById('price_span').style.display = "inline";
				if(currentURL.indexOf("date")!=-1)
					document.getElementById('date_span').style.display = "inline";
				if(currentURL.indexOf("id")!=-1)
					document.getElementById('id_span').style.display = "inline";
			});

			function sortByName(){
				window.location.replace("inventory_list.php?orderbyname=true");
			}
			function sortByPrice(){
				window.location.replace("inventory_list.php?orderbyprice=true");
			}
			function sortByDate(){
				window.location.replace("inventory_list.php?orderbydate=true");
			}
			function sortById(){
				window.location.replace("inventory_list.php?orderbyid=true");
			}

			function doSearch(){
				var searchText = document.getElementById("searchText").value;
				var targetTable = document.getElementById("productsTable");
				var targetTableColCount;

				for(var rowIndex=0; rowIndex<targetTable.rows.length; rowIndex++){
					var rowData = "";

					if(rowIndex == 0){
						targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
						continue;
					}

					for(var colIndex=0; colIndex<targetTableColCount; colIndex++ ){
						rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).innerText;
					}

					rowData = rowData.toLowerCase();
					searchText = searchText.toLowerCase();

					if(rowData.indexOf(searchText)==-1)
						targetTable.rows.item(rowIndex).style.display = 'none';
					else
						targetTable.rows.item(rowIndex).style.display = 'table-row';
				}
			}
		</script>
	</body>
</html>