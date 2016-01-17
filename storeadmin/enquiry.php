<?php //Session start and validate session
	session_start();
	
	//Redirect to login page if session isn't set
	if (!isset($_SESSION["username"])) {
    	header("location: admin_login.php"); 
    	exit();
	}

	else
	{
		//Function to filter inputs
		function filter_any_data($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		//Connect to db
		$conn = mysqli_connect("localhost","root","","main_db");
		if(!$conn){
			die("Error connectiong to db.");
		}

		//Get session variables
		$id = filter_any_data($_SESSION["id"]);
		$username = filter_any_data($_SESSION["username"]);
		$password = filter_any_data($_SESSION["password"]);

		//Fire query to check if the session variables exist in db
		$sql = mysqli_query($conn,"SELECT * FROM admin WHERE id='$id' AND username='$username' AND password='$password'");
		//Count no of rows of result
		$rows = mysqli_num_rows($sql);

		if($rows == 0)
		{
			//The session is forged.
			echo "Your record doesn't exist in the database.";	exit();
		}
		else {
			//The session is valid
		}
	}
?>

<?php // Script Error Reporting 
  
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
?>

<?php //Delete individual queries
	if(isset($_GET['deleteid'])) {
		echo "Do you really want to delete this query?";
		echo '<a href="enquiry.php?yesdelete='. $_GET['deleteid'] .'">Yes</a> | <a href="enquiry.php">No</a>  ';
		exit();
	}
	if(isset($_GET['yesdelete'])) {
		// remove item from system and delete its picture
  		// delete from database
  		$id_to_delete = $_GET['yesdelete'];
  		$sql = mysqli_query($conn,"DELETE FROM query WHERE q_id='$id_to_delete' LIMIT 1") or die (mysql_error());
  		
  		header("location: enquiry.php"); 
      	exit();
	}
?>

<?php  //Delete all queries //not working

	if(isset($_GET['deletechoice'])) {
		echo "Do you really want to purge the entire query table?";
		echo '<a href="enquiry.php?yesdelete='. $_GET['deletechoice'] .'">Yes</a> | <a href="enquiry.php">No</a>  ';
		exit();
	}
	if(isset($_GET['yesdelete'])) {
		// remove item from system and delete its picture
  		// delete from database
  		$sql = mysqli_query($conn,"DELETE FROM query") or die (mysql_error());
  		
  		header("location: enquiry.php"); 
      	exit();
	}	

?>

<?php //Grab queries for viewing

	$conn = mysqli_connect("localhost","root","","main_db");
	if(!$conn){
		die("DB connection error");
	}

	$queryList = "";

	$sql = mysqli_query($conn,"SELECT * FROM query ORDER BY q_id DESC") or die("Query error".mysqli_error($conn));

	$queryCount = mysqli_num_rows($sql);
	if($queryCount > 0){
		while($row = mysqli_fetch_array($sql)){
			$id = $row["q_id"];
			$query = $row["query"];
			$username = $row["username"];
			$email = $row["email"];
			$c_name = $row["c_name"];
			$c_address = $row["c_address"];
			$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			$queryList .= "<tr>
							<td>$id</td>
							<td>$date_added</td>
							<td>$username</td>
							<td>$query</td>
							<td><a href='http://localhost/agar/boot/horses.php'><button class='btn btn-success'>Reply</button></a>&nbsp;&nbsp;
							<a href='http://localhost/agar/boot/horses.php'><button class='btn btn-success'>View User Data</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href='enquiry.php?deleteid=$id'><button class='btn btn-warning'>Delete</button></a></td>
							</tr>
							";
		}
		} else{
		$queryList =  "<h3>Sit back, relax. There are no queries yet!&nbsp;&nbsp;<span class='fa fa-glass' style='color:pink'></span></h3>";
	}

?>

<!doctype html>
<html>
	<head>
		<title>Manage Inquiry</title>
		<?php require("H:/xampp/htdocs/agar/boot/initbootstrap.php");?>
		<style type="text/css">
			h2{
				border-bottom: 0.09em solid grey;
			}
			.refresh-button{
				margin-left: 21%; 
			}
		</style>
		<script type="text/javascript">
			function reloadpage(){
				location.reload();
			}
		</script>
	</head>	
	<body>
		<?php require("../navbar_2.php");?>

		<div class="container">
			<p><a href="inventory_list.php">Go to Inventory List</a></p>
			<h2>Enquiry Management Center</h2>
			<div class="row">
				<div class="col-md-5"><h4>View and Reply to queries submitted by the users.</h4></div>
				<div class="col-md-3"><input style="margin-left:100%;padding:0.3em;" id="searchText" placeholder="Search" onkeyup="doSearch()" type="text"></div>
				<div class-"col-md-3"><button onclick="reloadpage()" class="btn btn-info refresh-button">Refresh</button></div>
			</div>
			
			<table class="table" id="queryTable" style="margin-top:2em;">
				<thead>
					<tr>
						<th class="col-sm-1">#</th>
						<th class="col-sm-1">Date Added</th>
						<th class="col-sm-1">Name</th>
						<th class="col-sm-4">Enquiry</th>
						<th class="col-sm-4">Operations</th>
					</tr>
				</thead>
				<tbody>
					<?php echo "$queryList";?>
				</tbody>
			</table>
		</div>

		<?php require("../footer.php");?>
		
		<!--Hide Signin and Display Logout button in the navbar-->
		<style type="text/css">
			#signin_button{
				display: none;
			}
			#logout_button{
				display: block;
			}
			.table{
				width: auto;
			}
			.table th{
				text-align: center;
			}
			.table td{
				text-align: center;
			}
		</style>

		<script type="text/javascript">
			$(document).ready(function(){
				//Signout script on clicking logout button
				$('#logout_button').click(function(){
					window.location.replace('destroy_session.php');
				});
			});

			function doSearch(){
				var searchText = document.getElementById("searchText").value;
				var targetTable = document.getElementById("queryTable");
				var targetTableColCount;

				for(var rowIndex=0; rowIndex<targetTable.rows.length; rowIndex++){
					var rowData = "";

					if(rowIndex == 0){
						targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
						continue;
					}

					for(var colIndex=0; colIndex<targetTableColCount; colIndex++ ){
						rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).innerText;
					}

					rowData = rowData.toLowerCase();
					searchText = searchText.toLowerCase();

					if(rowData.indexOf(searchText)==-1)
						targetTable.rows.item(rowIndex).style.display = 'none';
					else
						targetTable.rows.item(rowIndex).style.display = 'table-row';
				}
			}
		</script>
	</body>	
</html>