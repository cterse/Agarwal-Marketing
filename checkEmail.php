<?php

	$q = $_REQUEST["q"];
	$ans = "";
	if($q !== ""){
		$q = strtolower($q);
		$conn = mysqli_connect("localhost","root","","main_db");
		$sql = mysqli_query($conn,"SELECT * FROM user_info WHERE user_email = '".$q."'");
		if(mysqli_num_rows($sql) > 0)
			$ans =  "none";
		else $ans = "inline";
	}

echo $ans;

?>