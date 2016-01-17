<?php
$dbusername = "root";
$servername = "localhost";
$dbpassword = "";
$dbname = "main_db";

//Create connection
$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);

//Check connection
if(!$conn)
{
	die("Connection to DB failed: " . mysqli_error());
}

