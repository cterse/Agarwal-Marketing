<?php

$servername = "localhost";
$username = "root";
$password = "";

//Create connection
$conn = mysqli_connect($servername,$username,$password);

//Check connection
if(!$conn)
{
	die("Connection to MySQL failed: " . mysqli_connect_error());
}
echo "MySQL connection successful.";

?>