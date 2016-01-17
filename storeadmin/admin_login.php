<?php
	session_start();

	//Redirect to main page is session is set
	if(isset($_SESSION["username"]))
	{
		header("location: admin_main.php");
		exit();
	}

	//Function to filter inputs
	function filter_any_data($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$error = '';
	
	if(isset($_POST['submit']))
	{
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			
			$username = filter_any_data($_POST['username']);
			$password = filter_any_data($_POST['password']);

			$conn = mysqli_connect("localhost","root","","college_db");
			if(!$conn){
				die("Cant connect to db.");
			}
			else{
				//Fire query to check the credentials
				$sql = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");
				$rows = mysqli_num_rows($sql);
				if($rows == 1)
				{
					//Credentials exist in db

					//While loop only to get the id of the entered admin
					while($row = mysqli_fetch_array($sql)){
						$id = $row["id"];
					}

					//set session variables
					$_SESSION["id"] = $id;
					$_SESSION["password"] = $password;
					$_SESSION["username"] = $username;
					header("location: admin_main.php");
					exit();
				}
				else
				{
					echo "Username/Password error";
				}
			}
		}
		else{
			$error = "Enter both Username and Password.";
		}
		echo "$error";
		mysqli_close($conn);
	}
?>

<!doctype html>
<html>
	<head>
		<?php require("initBootstrap.php");?>
		<script type="text/javascript">
			function validateForm(){
				var user = document.forms["admin_login_form"]["username"].value;
				var pass = document.forms["admin_login_form"]["password"].value;
				if( (user==null || user=="") || (pass==null || pass=="")){
					alert("All fields required.");
					return false;
				}
			}
		</script>
	</head>
	<body>
		<?php require("../navbar_2.php");?>

		<div class="container">
			<h2>Administrator Login</h2>
			<div class="row">
				<div class="col-sm-6">
				<form role="form" name="admin_login_form" id="admin_login_form" onsubmit="return validateForm()" action="admin_login.php" method="POST">
					<div class="form-group">
						<label for="username">Username: </label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Enter username" autofocus>
					</div>
					<div class="form-group">
						<label for="password">Password: </label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
					</div>
					<button type="submit" name="submit" class="btn btn-success">Submit</button>
				</form>
				</div>
			</div>
		</div>

		<?php require("../footer.php");?>
	</body>
</html>