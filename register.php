<?php

if (!isset($_POST['submit']))
{ 
 	echo "Please submit the form."; 
 	die();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "main_db";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
{
	die("Connection to DB failed: " . mysqli_error($conn));
}

$email = $_POST["email"];
$name = $_POST["name"];
$pass = $_POST["pass2"];
$desig = $_POST["designation"];
$company = $_POST["comp_name"];
$comp_addr_start = $_POST["comp_addr_start"];
$comp_pin = $_POST["comp_pin_code"];
$comp_qt = $_POST["question"];
$comp_city = $_POST["comp_city"];
$comp_state = $_POST["comp_state"];

$sql = "INSERT INTO user_info (user_id,user_name,user_pass,user_email,user_desig,user_company) VALUES (null,'$name','$pass','$email','$desig','$company')";

if(mysqli_query($conn,$sql))
{
	echo "Row created successfully";
}
else
{
	echo "Error inserting row:" . mysqli_error($conn);
}

//echo $name." ".$email." ".$pass." ".$comp_qt." ".$desig." ".$company." ".$comp_addr_start." ".$comp_city." ".$comp_state." ".$comp_pin;

mysqli_close($conn);
?>