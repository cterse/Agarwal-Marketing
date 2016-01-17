<?php
	

	//Function to filter inputs
	function filter_any_data($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$name = $email = $password = "";
	$emailExists = "";
	$comp_qt = "no";

	if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['comp_qt']) && isset($_POST['password2'])){
		$email = filter_any_data(strtolower($_POST['email']));
		$name = filter_any_data($_POST['username']);
		$comp_qt = filter_any_data($_POST['comp_qt']);
		$password = filter_any_data($_POST['password2']);
			
		$conn = mysqli_connect("localhost","root","","main_db");
		if(!$conn){
			die("connection to db failed.");
		}

		$sql = mysqli_query($conn,"SELECT * FROM user_info WHERE user_email = '$email'") or die("query error");
		if(mysqli_num_rows($sql)>0){
			$emailExists = "Email already exists!";
			$email = "";
		}
		else{
			$sql = mysqli_query($conn,"INSERT INTO user_info (user_name,user_pass,user_email) VALUES ('$name','$password','$email')") or die("Insertion failed");
			$id = mysqli_insert_id($conn);
			
			//die("Successful registration");
		}	
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign Up</title>
		<?php require("initBootstrap.php");?>
		<script type="text/javascript" src="signUpScript.js"></script>
		<style type="text/css">
			#name_span,#email_span,#qt_span,#pass2_span,#pass1_span,#tnc_span,#no_pass_match{
				color: pink;
				display: none;
			}
			#form_container{
				background-color: lavender;
				padding-bottom: 1em;
			}
			#email_ok_span{
				display:none;
			}
		</style>
	</head>

	<body>
		<?php require("navbar_2.php");?>
		<?php require("tncmodal.php");?>

		<div class="container" id="form_container">
			<h1>Sign Up</h1>
			<h4 style="color:maroon;"><u>All fields are mandatory.</u></h4>
			<div class="row">
				<div class="col-md-6">

					<form role="form" action="signUp.php" method="post">
						<div class="form-group">
							<label>Email:&nbsp;&nbsp;<span id="email_span" class="fa fa-asterisk"></span><span style="color:red;"><?php echo "$emailExists";?></span></label><span id="email_ok_span" class="fa fa-check-circle" style="color:green;"></span>
							<input onfocusout="checkEmailAlreadyPresent(this.value)" type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address" value=<?php echo $email;?>>
						</div>

						<div class="form-group">
							<label>Name:&nbsp;&nbsp;<span id="name_span" class="fa fa-asterisk"></span></label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Enter Full Name" value=<?php echo $name;?>>
						</div>

							<label>Do you want to sign up as an employee of a garment/clothing trading company?&nbsp;&nbsp;<span id="qt_span" class="fa fa-asterisk"></span></label>
							<div class="radio">
								<label><input type="radio" id="comp_qt" name="comp_qt" value="yes" <?php echo ($comp_qt=='yes')?"checked":''; ?>>Yes</label>
							</div>
							<div class="radio">
								<label><input type="radio" id="comp_qt" name="comp_qt" value="no" <?php echo ($comp_qt=='no')?"checked":''; ?>>No</label>
							</div>

						<div class="form-group">
							<label>Password:&nbsp;&nbsp;<span id="pass1_span" class="fa fa-asterisk"></span></label>
							<input type="password" name="password1" id="password1" class="form-control" placeholder="Enter Password" value=<?php echo $password;?>>
						</div>
						<div class="form-group">
							<label>Enter Password Again:&nbsp;&nbsp;<span id="pass2_span" class="fa fa-asterisk"></span>&nbsp;&nbsp;<span style="color:red;" id="no_pass_match">Passwords Don't Match</span></label>
							<input type="password" name="password2" id="password2" class="form-control" placeholder="Enter Password" value=<?php echo $password;?>>
						</div>

						<label class="checkbox-inline"><input type="checkbox" id="tnc" name="tnc" value="true" checked>By Signing Up, I accept the <a data-toggle="modal" data-target="#tncmodal">Terms and Conditions.</a>&nbsp;&nbsp;<span id="tnc_span" class="fa fa-asterisk"></span></label>
						<div style="margin-top:1em;margin-bottom:-1.5em;" class="alert alert-info">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Password Tip:</strong> Password should at least be 6 characters long and should contain at least one number.
						</div>
						<br><br>
						<input style="" type="submit" name="submit" value="Let's Go" onclick="return validateForm()" class="btn btn-success">
					</form>
				</div>
			</div>
		</div>

		<?php require("footer.php");?>	
	</body>
</html>