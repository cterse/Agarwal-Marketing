<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registration Form</title>
		<style type="text/css">
			table
			{
				margin-left: 25%;
				margin-top: 10px;
				background-color: #EDED8D;
				padding: 3px 3px 3px 3px;
				border: 1px solid black;
				border-radius: 20px;
			}
			td
			{
		
				padding-bottom:15px;
			}
			tr
			{
				
			}
			input
			{
				height:30px;
				border-radius: 5px;
			}
			.regButton
			{
				padding-top: 20px;
				padding-left: 50px
			}
			.error
			{
				color: #FF0000;
			}
		</style>
	</head>

	<body>

		<?php
			$email_err=$name_err=$comp_qt_err=$pass_err="";
			$email=$name=$pass=$desig=$company=$comp_addr_start=$comp_pin=$comp_qt=$comp_city=$comp_state="";
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if(empty($_POST["email"]))
				{
					$email_err = "Email Required";
				}
				else 
				{
					$email = test_input($_POST["email"]);
					// check if e-mail address is well-formed
    				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      					$email_err = "Invalid email format"; 
    				}
				}
				if(empty($_POST["name"]))
				{
					$name_err = "Name Required";
				}
				else 
				{
					$name = test_input($_POST["name"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
     					$name_err = "Only letters and white space allowed"; 
    				}
				}
				if(empty($_POST["pass2"]))
				{
					$pass_err = "!";
				}
				else 
				{
					$pass = test_input($_POST["pass2"]);
					if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{4,30}$/",$pass)) {
     					$pass_err = "Password must be alphanumeric and more than 3 characters."; 
    				}
				}
				if(empty($_POST["question"]))
				{
					$comp_qt_err = "!";
				}
				else 
				{
					$comp_qt = test_input($_POST["question"]);
				}
				$desig = test_input($_POST["designation"]);
				$company = test_input($_POST["comp_name"]);
				$comp_addr_start = test_input($_POST["comp_addr_start"]);
				$comp_pin = test_input($_POST["comp_pin_code"]);
				$comp_city = test_input($_POST["comp_city"]);
				$comp_state = test_input($_POST["comp_state"]);
			}

			function test_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>

		<h2 style="padding-left:25%">Register</h2>
		<span class="error" style="padding-left:25%;">* Required Field</span>
		<div>
			<form action="register.php" method="post" autocomplete="off">
				<table BORDER=2 CELLPADDING=2 CELLSPACING=2 WIDTH=50%>
					<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
					<tr>
						<td style="padding-bottom:5px"><b>Personal Information:</b></td>
					</tr>
					<tr></tr>
					<tr>
						<td>E-mail:<span class="error">*</span></td>
						<td><input type="email" name="email" placeholder="Enter Email Address" style="width:100%;height:30px"></td>
						<td><span class="error"><?php echo $email_err;?></span></td>
					</tr>
					<tr>
						<td>Name:<span class="error">*</span></td>
						<td><input type="text" name="name" placeholder="Enter Name" style="width:100%"></td>	
						<td><span class="error"><?php echo $name_err;?></span></td>
					</tr>
					<tr>
						<td>Do you work in a company?<span class="error">*</span></td>
						<td><input type="radio" name="question" value="yes" class="selector" checked>Yes</td>
						<td><input type="radio" name="question" value="no" class="selector">No</td>
					</tr>

					<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
					<tr>
						<td style="padding-bottom:5px"><b>Company Information:</b></td>
					</tr>
					<tr></tr>
						<tr>
							<td>Company Name:</td>
							<td><input type="test" name="comp_name" placeholder="Enter Company Name" style="width:100%"></td>
						</tr>
						<tr>
							<td>Company Address:</td>
							<td><input type="text" name="comp_addr_start" placeholder="First line of Company Address" style="width:100%"></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input class="form-control" list="city" name="comp_city" placeholder="Select City">
								<datalist id="city">
									<option value="Mumbai"></option>
									<option value="Chennai"></option>
									<option value="Delhi"></option>
									<option value="Kolkata"></option>
									<option value="Agra"></option>
							</td>
							<td>
								<input list="state" name="comp_state" placeholder="Select State">
								<datalist id="state">
									<option value="Maharashtra"></option>
									<option value="Tamil Nadu"></option>
									<option value="Kerala"></option>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="number" name="comp_pin_code" placeholder="Company Pin Code" style="width:100%">
							</td>
						</tr>
						<tr>
							<td style="padding-top:30px">Your Designation:</td>
							<td><input type="text" name="designation" placeholder="Designation" style="width:100%"></td>
						</tr>	

						<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
						<tr>
							<td>Enter Password:<span class="error">*</span></td>
							<td><input type="password" name="pass1" placeholder="Enter Password" style="width:100%"></td>
							<td><span class="error"><?php echo $pass_err;?></span></td>
						</tr>
						<tr>
							<td>Re-enter Password:<span class="error">*</span></td>
							<td><input type="password" name="pass2" placeholder="Enter Password" style="width:100%"></td>
							<td><span class="error"><?php echo $pass_err;?></span></td>
						</tr>

						<tr>
							<td></td>
							<td class="regButton">
								<input type="submit" name="submit" value="Register">
							</td>
						</tr>

				</table>
			</form>
		</div>
		<?php
			echo "Your input: ";
			echo $email." ".$name." ".$pass." ".$desig." ".$company." ".$comp_addr_start." ".$comp_pin." ".$comp_qt." ".$comp_city." ".$comp_state;
		?>
	</body>
</html>