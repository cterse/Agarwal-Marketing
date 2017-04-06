<?php

require 'connectToSQL.php';

//Create Database
$sql = "CREATE DATABASE main_db";
if(mysqli_query($conn,$sql))
{
	echo "Database created successfully.";
}
else 
{
	echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);

?>