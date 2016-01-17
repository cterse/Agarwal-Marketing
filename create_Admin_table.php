<?php

	require("connectToDB.php");

	//Create Admin Table
	$sql = "CREATE TABLE admin (
				id int(20) PRIMARY KEY auto_increment,
				username varchar(30) UNIQUE NOT NULL,
				password varchar(30) NOT NULL,
				last_log_date date NOT NULL
			)";

	//Fire query
	if(mysqli_query($conn,$sql))
	{
		echo "Admin table created successfully.";
	}
	else echo "Error creating Admin table: " . mysqli_error($conn);

	mysqli_close($conn);

?>