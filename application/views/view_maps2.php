<!DOCTYPE html>
<html>
  <head>
  <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDx7Pe1xcH-53J184L9KuABGGVQIwhLljA"></script>
<script type="text/javascript" charset="utf8" src="/npsmart/js/maplabel-compiled.js"></script> 
<script type="text/javascript" charset="utf8" src="/npsmart/js/maplabel.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <title>Data Layer: Simple</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
  .ui-autocomplete {
    max-height: 300px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 300px;
  }	
	
 html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
    </style>
	<style type="text/css">
#dvMap {
    width: 100%;
	height: 1200px;
}
</style>
  </head>
  <body>
 <?php 
 foreach($nodebs as $row){
					#echo $row->node;
					 $nodeb[] = $row->nodeb;
					 $lat[$row->nodeb] = $row->lat;
					 $lon[$row->nodeb] = $row->lon;
 }
 
 #array_walk($lat, create_function('&$str', '$str = "\"$str\"";')); //put quotes in datetime
 ?> 
  <input id="pac-input" class="controls" type="text" placeholder="Search Box" onkeydown="search(this)">
    <div id="map"></div>
    <script>

var nodeb = <?php echo json_encode($nodeb) ?>;	
var lat = <?php echo preg_replace('/"([^"]+)"\s*:\s*/', '$1:', json_encode($lat,JSON_PRETTY_PRINT)); ?>;	
var lon = <?php echo json_encode($lon,JSON_PRETTY_PRINT) ?>;	

$(function() {
	$("#pac-input").autocomplete({
		source:nodeb
	});
});


	function search(ele) {
		if(event.keyCode == 13) {
			//alert(lat[ele.value]);
			moveToLocation(lat[ele.value],lon[ele.value]);
			zoom: 4;
		}
	}
	
	var map;
	var infowindow 
	
	function initMap() {
		infowindow = new google.maps.InfoWindow();
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          //center: {lat: -28, lng: 137}
		  center: {lng: -47.8692016601562,lat: -15.8022003173828},
		  zoomControl: true,
		  scaleControl: true,
		  streetViewControl: true,
		  rotateControl: true,
		  fullscreenControl: true,
		  mapTypeControl: true,
		  mapTypeControlOptions: {
			  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			  mapTypeIds: [
			  google.maps.MapTypeId.ROADMAP,
			  google.maps.MapTypeId.TERRAIN,
			  google.maps.MapTypeId.SATELLITE,
			  google.maps.MapTypeId.HYBRID
      ]
    }
        });
		
	
		google.maps.event.addListener(map,'click',function() {
        infowindow.close();
    });

        // NOTE: This uses cross-domain XHR, and may not work on older browsers.
        //map.data.loadGeoJson('https://storage.googleapis.com/maps-devrel/google.json');
		var cells_layers = new google.maps.Data();
		cells_layers.loadGeoJson('/npsmart/json/cell_layers.json');
        //map.data.loadGeoJson('http://localhost/npsmart/json/color_new.json');
		
		// Color each letter gray. Change the color when the isColorful property
		  // is set to true.
		  
		  cells_layers.setStyle(function(feature) {
		  //map.data.setStyle(function(feature) {
		

		//var color = '#FF8700';
			//if (feature.getProperty('isColorful')) {
			  color = feature.getProperty('color');
			//}
			return /** @type {google.maps.Data.StyleOptions} */({
			  fillColor: color,
			  strokeColor: color,
			  strokeWeight: 2,
			  zIndex:feature.getProperty('zindex')
			});
		  });
		  
		  cells_layers.setMap(map);
		  
		// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        //var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);	

		// searchBox.addListener('places_changed', function() {
				  // var places = searchBox.getPlaces();

				  // if (places.length == 0) {
					// return;
				  // }	
		// }				  
			
	  // Set event listener for each feature.
	  cells_layers.addListener('click', function(event) {
		 infowindow.setContent(event.feature.getProperty('rnc')+"<br>"+event.feature.getProperty('cell')+"<br>"+event.feature.getProperty('cellid')+"<br>"+event.feature.getProperty('lac')+"<br>"+event.feature.getProperty('psc')+"<br>"+event.feature.getProperty('core'));
		 infowindow.setPosition(event.latLng);
		 infowindow.setOptions({pixelOffset: new google.maps.Size(0,-34)});
		 infowindow.open(map);
	  });	
	  
	  // Add mouseover and mouse out styling for the GeoJSON State data
		cells_layers.addListener('mouseover', function(e) {
		 cells_layers.overrideStyle(e.feature, {
		 strokeColor: '#2a2a2a',
		 strokeWeight: 2,
		 zIndex: 2
		 });
		});

		cells_layers.addListener('mouseout', function(e) {
		 cells_layers.revertStyle();
		});

		for (var i = 0; i < nodeb.length; i++) {
			var mapLabel = new MapLabel({
				  text: nodeb[i],
				  position: new google.maps.LatLng(lat[nodeb[i]],lon[nodeb[i]]),
				  map: map,
				  fontSize: 15,
				  //align: 'right'
				});
        mapLabel.set('position', new google.maps.LatLng(lat[nodeb[i]],lon[nodeb[i]]));	
    	}
		 

	  
      }
	  
	  function moveToLocation(lat, lng){
		var center = new google.maps.LatLng(lat, lng);
		// using global variable:
		map.panTo(center);
	}
	
google.maps.event.addDomListener(window, 'load', initMap);
//google.maps.event.addDomListener(window, 'load', initMap);	  
    </script>
<!--<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&callback=initMap&key=AIzaSyDx7Pe1xcH-53J184L9KuABGGVQIwhLljA"></script>-->

	
  </body>
</html>