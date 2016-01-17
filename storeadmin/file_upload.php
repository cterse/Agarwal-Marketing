<?php
	
	if(isset($_POST['submit'])){
		if(isset($_FILES['file']['name'])){
			$name = $_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];

			$location = "../inventory_images/";

			if(move_uploaded_file($temp_name, $location.$name)){
				echo "Uploaded!";
			}
			else{
				echo "Not uploaded";
			}
		}
		else{
			echo "Choose a file";
		}
	}
	
?>

<!doctype html>
<html>
	<body>
		<form enctype="multipart/form-data" action="file_upload.php" method="POST">
			<input type="file" name="file" id="file">
			<button type="submit">Submit</button>
		</form>
	</body>
</html>