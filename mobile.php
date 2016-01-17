<!doctype html>
<html>
	<head>
		<title>Sorry</title>
		<?php require("initBootstrap.php");?>
		<style type="text/css">
			*{
				text-align: center;
			}
			h2{
				text-decoration: underline;
				color: green;
			}
			#happy_cat{
				display: none;
			}
		</style>
		<script type="text/javascript">
			function showCat(){
				document.getElementById("happy_cat").style.display = "inline";
			}
		</script>
	</head>
	<body>
		<div class="container">
			<h2><span style="color:red;">Sorry,</span> Visit Us From Your Computer</h2>
			<h4>We currently don't support access from a mobile phone or a tablet.</h4>
			<h4>Not that we hate those devices, it's just that the site is under construction for viewing on small screen devices.</h4>
			<h4>But hey, as soon as it works, we'll let you know! God Promise! <span style="color:maroon;" class="fa fa-smile-o"></span></h4>
			<br><br><br>
			<h4>Till then, <a href="#" onclick="showCat()">Check out this happy cat :)</a></h4>
			<h4><img id="happy_cat" src="res/cat-happy-cat-e1329931204797.jpg" height="427" width="540"></h4>
		</div>
	</body>
</html>