<?php
	
	require("../navbar_2.php");	
	@session_start();

	session_unset();

	session_destroy();

	echo 'Session destroyed. <a href="admin_login.php">Click Here</a> to go to admin login page';

	require("../footer.php");
?>