<!DOCTYPE html>
<html>
	<head>
		<?php require("initBootstrap.php");?>
		<style type="text/css">
			*
			{
				margin:0;
				padding: 0;
			}
			#image
			{
				position: relative;
				z-index: -1;
			}
			#image2
			{
				position: relative;
				z-index: -1;
			}
			#content
			{
				position:relative;
				z-index: 1;
				background-color: lightblue;
				min-height: 100%;
			}
		</style>
		<script type="text/javascript">
				function writeLines(n)
				{
					var c = n;
					for(c;c>0;c--)
					{
						document.write('<h3>Some content for scrolling...</h3>');
					}
				}

				function parallax()
				{
					var ypos,image,image2;
					ypos = window.pageYOffset;
					image = document.getElementById('image');
					image2 = document.getElementById('image2');
					image.style.top = ypos * 0.8 + 'px';
					image2.style.top = (ypos * 1) + 'px';
				}

				window.addEventListener('scroll',parallax);
			</script>
	</head>
	<body>
		<img id="image" src="res/1(1400x650).jpg" height="400" width="100%">
		<div id="content" class="container-fluid">
			<h1>Content on the page.</h1>
			<script type="text/javascript">
				writeLines(17);
			</script>
		</div>
		<img id="image2" src="res/1(1400x650).jpg" height="400" width="100%">
	</body>	
</html>