<?php

require 'connectToDB.php';

//sql to create table
$sql = "CREATE TABLE user_login_info_2(
		id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(30) UNIQUE NOT NULL,
		password VARCHAR(20) NOT NULL
	)";

//check sql success
if(mysqli_query($conn,$sql))
{
	echo "Table created successfully.";
}
else 
{
	echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);

?>