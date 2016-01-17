<?php // Script Error Reporting
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
?>

<?php

	if(isset($_GET['id'])){
		$conn = mysqli_connect("localhost","root","","main_db");
		if(!$conn){
			die("Connection error");
		}
		$id = preg_replace('#[^0-9]#i', '', $_GET['id']);
		$sql = mysqli_query($conn,"SELECT * FROM products WHERE id = '$id' LIMIT 1");
		if(!$sql){
			die("Sql error");
		}

		$count = mysqli_num_rows($sql);
		if($count > 0){
			while($row = mysqli_fetch_array($sql)){
		  		$product_name = $row["product_name"];
		  		$product_details = $row["details"];
		  		$product_price = $row["price"];
		  		$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
		  		$category = $row["category"];
		  	}
		}else{
			die("Item doesn't exist.");
		}
	}else{
		die("Data to render page missing.");
	}
?>

<!doctype html>
<html>
	<head>
		<title><?php echo "$product_name";?></title>
		<?php require("initBootstrap.php"); ?>
	</head>
	<body>
		<?php require("navbar_2.php");?>

		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<img style="border:#666 0px solid;margin-left:6em;" src="inventory_images/<?php echo "$id";?>.jpg" alt="<?php echo "$product_name";?>" width="400" height="400" border="1" />
				</div>
				<div class="col-sm-5">
					<h1 style="color:blue;"><b><?php echo "$product_name";?></b></h1>
					<h5 style="font-size:1.5em;margin:1em;"><b> Category : </b><?php echo "$category";?></h5>
					<h5 style="font-size:1.5em;margin:1em;"><b> Price : </b>Rs. <?php echo "$product_price";?></h5>
					<h5 style="font-size:1.5em;margin:1em;"><b>Description: </b><p><?php echo "$product_details";?></p></h5>
					<a href="http://localhost/agar/boot/horses.php"><button class="btn btn-success" style="width:35em;height:3.5em;margin:1em;">Add To Cart</button></a>
				</div>
			</div>
		</div>

		

		<?php require("footer.php");?>
	</body>
</html>