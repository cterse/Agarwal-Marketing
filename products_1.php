<?php //View products

	$conn = mysqli_connect("localhost","root","","main_db");
	if(!$conn){
		echo "Connection to DB error.";
		die();
	}
	$dynamicList = "";
	$sqlClothing = mysqli_query($conn,"SELECT * FROM products WHERE category = 'Clothing'");
	$clothingCount = mysqli_num_rows($sqlClothing);
	$sqlDecor = mysqli_query($conn,"SELECT * FROM products WHERE category = 'Decoration'");
	$decorCount = mysqli_num_rows($sqlDecor);
	$sqlRaw = mysqli_query($conn,"SELECT * FROM products WHERE category = 'Raw Material'");
	$rawCount = mysqli_num_rows($sqlRaw);

	$f1 = "";	$f2 = "";
	$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY date_added DESC");
	if(isset($_POST['submit_clear'])){
		$sql = mysqli_query($conn,"SELECT * FROM products ORDER BY date_added DESC");
	}

	//Code to apply filter
	if(isset($_POST['submit'])){
		if(!empty($_POST['filter'])){
			$checked = $_POST['filter'];
			$count = count($checked);
			if($count == 3){}
			else if($count == 2){
				$f1 = $_POST['filter'][0];	$f2 = $_POST['filter'][1];
				$sql = mysqli_query($conn,"SELECT * FROM products WHERE category = '$f1' OR category = '$f2'");
			}
			else{
				$f1 = $_POST['filter'][0];	$f2 = "";
				$sql = mysqli_query($conn,"SELECT * FROM products WHERE category = '$f1'");	
			}
		}
	}

	if(!$sql){
		die("Error filtering");
	}


	$productCount = mysqli_num_rows($sql);
	if($productCount > 0){

		while($row = mysqli_fetch_array($sql)){
			$id = $row["id"];
			$product_name = $row["product_name"];
			$product_price = $row["price"];
			$product_details = $row["details"];
			$dynamicList .= '<div class="container" style=""><table style="font-size:1.2em;" class="table" width="100%" border="0" cellspacing="0" cellpadding="6"><tbody>
      <tr>
        <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="150" height="150" border="1" /></a></td>
        <td style="" width="83%" valign="top"><b>' . $product_name . '</b><br />
              Rs.' . $product_price . '<br />' .$product_details. '<br/>
        <a href="product.php?id=' . $id . '">View Product Details</a></td>
      </tr></tbody>
      </table></div>';
		}

	}else{
		$dynamicList .= '<h3>Sorry, we don\'t have products in that category yet!</h3>';
	}
	mysqli_close($conn);
?>

<!doctype html>
<html>
	<head>
		<title>Products</title>
		<?php require("initBootstrap.php");?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#two").addClass("active");
			});
		</script>
	</head>
	<body>
		<?php require("navbar_2.php");?>

		<!--Div for displaying products-->
		<div class="container-fluid" style="background-color:lavender;margin-top:-1.4em;margin-bottom:-1.9em;">
			<div class="row">

				<!--Column for categories-->
				<div class="col-sm-3">
					<h3>Categories</h3>
					<form role="form" action="products_1.php" method="post">
						<div class="checkbox">
							<label><input type="checkbox" name="filter[]" value="clothing" <?php echo ( (($f1 == "clothing")||($f2 == "clothing")) ? 'checked' : '');?>>Clothing (<?php echo "$clothingCount";?>)</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="filter[]" value="raw material" <?php echo ( (($f1 == "raw material")||($f2 == "raw material")) ? 'checked' : '');?>>Raw Materials (<?php echo "$rawCount";?>)</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="filter[]" value="decoration" <?php echo ( (($f1 == "decoration")||($f2 == "decoration")) ? 'checked' : '');?>>Decoration (<?php echo "$decorCount";?>)</label>
						</div>
						<button type="submit" name="submit" style="width:7em;margin:1em;" class="btn btn-default btn-success">Filter</button>
						<button type="submit_clear" name="submit_clear" style="width:7em;margin:1em;" class="btn btn-default btn-danger">Clear Filter</button>
					</form>
				</div>

				<!--Product display column-->
				<div class="col-sm-8" style="border-left:solid 1px grey;">
					<p><?php echo "$dynamicList";?></p>
				</div>
			</div>
		</div>

		<?php require("footer.php");?>
	</body>
</html>