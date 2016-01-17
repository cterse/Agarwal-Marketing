<?php
	
	require("connectToDB.php");

	//Create Admin Table
	$sql = "CREATE TABLE products (
				id int(20) PRIMARY KEY auto_increment,
				product_name varchar(255) NOT NULL UNIQUE,
				price varchar(32) NOT NULL,
				details text NOT NULL,
				category varchar(32) NOT NULL,
				subcategory varchar(32) NOT NULL,
				date_added date NOT NULL
			)";

	//Fire query
	if(mysqli_query($conn,$sql))
	{
		echo "Products table created successfully.";
	}
	else echo "Error creating Products table: " . mysqli_error($conn);

	mysqli_close($conn);

?>