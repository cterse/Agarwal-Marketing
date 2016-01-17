<?php
	
	//echo "Started";
	session_start();

	$error = "";

	if(isset($_POST['username']) && isset($_POST['password']))
	{
		echo "Submitted Successfully.";
		$user = $_POST['username'];
		$pass = $_POST['password'];

		$conn = mysqli_connect("localhost","root","","test");
		if(!$conn){
			die("Cant connect to database.");
		}

		$sql = mysqli_query($conn,"SELECT * FROM test WHERE login = '$user' AND pass = '$pass'");
		$rows = mysqli_num_rows($sql);
		if($rows == 1)
		{
			header("location:test_login_success.php");
			exit();
		}
		else{
			echo "Not Bad!!!";
			die();
		}

		mysqli_close($conn);
	}

?>

<!doctype html>
<html>
	<head></head>
	<body>
		<form action="test_login.php" method="POST">
			<label>Username: </label>
			<input type="text" name="username" id="username"><br>
			<label>Password: </label>
			<input type="password" name="password" id="password"><br>
			<button type="submit" name="submit" value="submit">Submit</button>
		</form>
	</body>
</html>