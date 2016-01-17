<!doctype html>
<html>
	<head>
		<title>Map</title>
		<style type="text/css">
      		html, body { height: 100%; margin: 0; padding: 0; }
      		#map { height: 100%; }
    	</style>
    	<?php require("initBootstrap.php");?>
	</head>
	
	<body>	
		<div class="container-fluid">
			<div id="map"></div>
			
			<script type="text/javascript">
				var map;
				function startMap(){
					map = google.maps.Map(document.getElementById('map'),{
						center: {lat: 19.116227 ,lng: 72.873960},
						zoom: 14
					});
				}
			</script>
			<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBPK-J5T-VdpIxw8nYmnm9wubPnuICYos&callback=startMap">
			</script>
		</div>
	</body>	
</html>