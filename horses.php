<!doctype html>
<html>
<head>
	<title>Coming Soon</title>	
	<?phprequire("initBootstrap.php");?>
	<style type="text/css">
		.horses{
			margin-left:5em;
			margin-top: -5em;
		}
		.back-button{
			margin-left: 33em;
		}
	</style>
	<script type="text/javascript">
		function goback(){
			window.history.back();
		}
	</script>
</head>
<body>
	<?php require("navbar_2.php");?>
		
	<img class="horses" src="res/hold-your-horses__99295_zoom.jpg">
	<h2 style="margin-left:37%;">Feature Coming Soon...</h2>
	<button type="button" onclick="goback()" class="btn btn-warning btn-lg back-button">Go Back&nbsp;<span style="color:lavender;" class="fa fa-undo"></span></button>
	<?php require("footer.php");?>
</body>
</html>