<!doctype html>
<html>
	<head>
		<script>
			function validate(){
				var name = document.forms['testform']['username'].value;
				var pass = document.forms['testform']['password'].value;
				if(name=="" || pass==""){
					alert("Fields empty");
					return false;
				}
				else return true;
			}
		</script>
	</head>
	<body>
		<form name="testform" action="testformauth.php" method="post" onsubmit="validate()">
			<label>Username: </label>
			<input type="text" name="username" id="username"><br>
			<label>Password: </label>
			<input type="text" name="password" id="password"><br>
			<button type="submit">Submit</button>	
		</form>
	</body>
</html>