<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false">
    </script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script>
    <script type="text/javascript">
		var map;
		var service;
		var infowindow;

		function initialize() {
		  var pyrmont = new google.maps.LatLng(-33.8665433,151.1956316);

		  map = new google.maps.Map(document.getElementById('map'), {
			  mapTypeId: google.maps.MapTypeId.ROADMAP,
			  center: pyrmont,
			  zoom: 15
			});

		  var request = {
			location: pyrmont,
			radius: '500',
			query: 'place'
		  };

		  service = new google.maps.places.PlacesService(map);
		  service.textSearch(request, callback);
		}

		function callback(results, status) {
			console.log(results);
		  if (status == google.maps.places.PlacesServiceStatus.OK) {
			for (var i = 0; i < results.length; i++) {
			  //var place = results[i];
			  console.log(results[i]);
			  //createMarker(results[i]);
			}
		  }
		}
    </script>
  </head>
  <body onload="initialize()">
    <div id="map" style="width:500px; height:500px;"></div>
  </body>
</html>