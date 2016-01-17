<?php

	$conn = mysqli_connect("localhost","root","","test");
	if(!$conn)
	{
		die("Connection failed: " . mysqli_error());
	}

	$n = $_POST["name"];
	$p = $_POST["password"];

	$sql = "INSERT INTO user_login_info (id,login,pass) VALUES (null,'$n','$p')";

	if(mysqli_query($conn,$sql))
	{
		echo "Row inserted.";
	}
	else
	{
		echo "Error inserting row: " . mysqli_error($conn);
	}

?>