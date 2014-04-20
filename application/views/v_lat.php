<!DOCTYPE html> 
<html> 
	<head> 
		<meta charset="utf-8"> 

		<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css"> 
		<style type="text/css"> 
			#country {
				text-align: center;
			}
			#map_canvas {
				height: 75%;
				width:379px;
			}
		</style> 
	<script type="text/javascript"src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script> 
	<script type="text/javascript"> 
		var geocoder;
		function initialize() {
			var styleOff = [{ visibility: 'off' }];
			var stylez = [
				{   
					featureType: 'administrative',
					elementType: 'labels',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.province',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.locality',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.neighborhood',
					stylers: styleOff
				},
				{   
					featureType: 'administrative.land_parcel',
					stylers: styleOff
				},
				{   
					featureType: 'poi',
					stylers: styleOff
				},
				{   
					featureType: 'landscape',
					stylers: styleOff
				},
				{  
					featureType: 'road',
					stylers: styleOff
				}
			];
			geocoder = new google.maps.Geocoder();
			var mapDiv = document.getElementById('map_canvas');
			var map = new google.maps.Map(mapDiv, {
				center: new google.maps.LatLng(53.012924,18.59848),
				zoom: 4,
				mapTypeId: google.maps.MapTypeId.SATELLITE,
				draggableCursor: 'pointer',
				draggingCursor: 'pointer',
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI:true,
				disableDoubleClickZoom:true,
				draggable:false,
				mapTypeControl: false,
				mapTypeControlOptions: {
					mapTypeIds: ['Border View']
				}
			});
			var customMapType = new google.maps.StyledMapType(stylez,{name: 'Border View'});
			map.mapTypes.set('Border View', customMapType);
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(53.012924,18.59848),
				map: map
			});
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script> 
	</head> 
	<body>
		<div id="map_canvas"></div> 
	</body> 
</html> 