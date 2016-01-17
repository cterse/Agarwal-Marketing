<?php

	session_start();
	$value = $_SESSION["testing"];
?>

<!doctype html>
<html>
	<body>
		<h1>Successful Login.</h1>
		<h3><?php echo "$value";?></h3>
	</body>
</html>