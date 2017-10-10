<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>GeoJSON to Google Maps</title>
	<style type="text/css">
		#left{
			width: 500px;
			height: 500px;
			float:left;
		}
		#right{
			width: 200px;
			height: 500px;
			float:left;
			padding: 10px;
		}
		#right div{
			margin-bottom: 4px;
		}
		#right textarea{
			height: 150px;
			width: 300px;
		}
		#map{
			height:100%;
		}
		#infoBox {
			width:300px;
		}
		
	</style>
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="/npsmart/js/GeoJSON.js"></script>
	<script type="text/javascript">
		var map;
		currentFeature_or_Features = null;
		
		var geojson_Point = {
			"type": "Point",
			"coordinates": [-80.66252, 35.04267]
		};
		
		var geojson_MultiPoint = {
			"type": "MultiPoint",
			"coordinates": [
				[-80.66252, 35.04267],
				[-80.66240, 35.04255]
			]
		};
		
		var geojson_LineString = {
			"type": "LineString",
			"coordinates": [
				[-80.661983228058659, 35.042968081213758],
				[-80.662076494242413, 35.042749414542243],
				[-80.662196794397431, 35.042626481357232],
				[-80.664238981504525, 35.041175532632963]
			]
		};
		var geojson_MultiLineString = {
			"type": "MultiLineString",
			"coordinates": [
				[
					[-80.661983228058659, 35.042968081213758],
					[-80.662076494242413, 35.042749414542243],
					[-80.662196794397431, 35.042626481357232],
					[-80.664238981504525, 35.041175532632963]
				],[
					[-80.660716952851203, 35.043580586227073],
					[-80.660819057590672, 35.042614204165666],
					[-80.660860211132032, 35.042441083434795],
					[-80.660927975876391, 35.042312940446855],
					[-80.661024889425761, 35.042200170467524],
					[-80.661384194084519, 35.041936069070361]
				]
			]
		};
		
		// var geojson_Polygon = 
		// {"type":"Polygon","coordinates":
			// [[[-47.8692016601562,-15.8022003173828],
			// [-47.8694577881248,-15.8012118624177],
			// [-47.8692807785197,-15.8011844508978],
			// [-47.8691015000598,-15.8011861713816],
			// [-47.8689250938626,-15.8012169745313],
			// [-47.868756618682,-15.8012759770134],
			// [-47.8686009058463,-15.801361486829],
			// [-47.8684624207157,-15.8014710518327],
			// [-47.8683451346333,-15.8016015300494],
			// [-47.8692016601562,-15.8022003173828]]]};
		
		var geojson_Polygon = {
			"type": "Polygon",
			"coordinates": [
				[
					[-80.662120612605904, 35.042875219905184],
					[-80.662141716053014, 35.042832740965068],
					[-80.662171938563816, 35.042789546962993],
					[-80.662209174653029, 35.042750233165179],
					[-80.662250709107454, 35.042716920859959],
					[-80.662627586829899, 35.043072078075667],
					[-80.662595574310288, 35.043162322407341],
					[-80.662142312824884, 35.043015448098977],
					[-80.662145396323511, 35.042970839922489],
					[-80.662117972448982, 35.042908385949438],
					[-80.662120612605904, 35.042875219905184]
				]
			]
		};
		
		var geojson_Polygon_hole = {
			"type": "Polygon",
			"coordinates": [
				[
					[-80.662120612605904, 35.042875219905184],
					[-80.662141716053014, 35.042832740965068],
					[-80.662171938563816, 35.042789546962993],
					[-80.662209174653029, 35.042750233165179],
					[-80.662250709107454, 35.042716920859959],
					[-80.664191013603950, 35.041343401901145],
					[-80.664311100312809, 35.041354401320908],
					[-80.664601012011108, 35.041627401070109],
					[-80.662899986829899, 35.042822078075667],
					[-80.662638586829899, 35.043032078075667],
					[-80.662595574310288, 35.043162322407341],
					[-80.662142312824884, 35.043015448098977],
					[-80.662145396323511, 35.042970839922489],
					[-80.662117972448982, 35.042908385949438],
					[-80.662120612605904, 35.042875219905184]
				],
				[
					[-80.663660240030611, 35.042285014551399],
					[-80.663323010340658, 35.041963021011493],
					[-80.663477030360489, 35.041855013227392],
					[-80.663801010040396, 35.042180031153971]
				]
			]
		};
		var geojson_MultiPolygon = {
			"type": "MultiPolygon",
			"coordinates": [
				[
					[
						[-80.661917125299155, 35.042245264120233],
						[-80.662257428469147, 35.042566288770765],
						[-80.662116500253873, 35.042670715828088],
						[-80.661715367137106, 35.042389935257198],
						[-80.661917125299155, 35.042245264120233]
					]
				],[
					[
						[-80.661547137566686, 35.042510563404129],
						[-80.661677171806787, 35.042417322902836],
						[-80.662084018102888, 35.042702102858307],
						[-80.662039854197829, 35.042756211162953],
						[-80.662002555672572, 35.042820528162387],
						[-80.661457640151127, 35.042647387136952],
						[-80.661547137566686, 35.042510563404129]
					]
				]
			]
		};
		
		var geojson_GeometryCollection = {
			"type": "GeometryCollection",
			"geometries": [
				{
					"type": "Point",
					"coordinates": [-80.66256, 35.04271]
				},{
					"type": "MultiPolygon",
					"coordinates": [
						[
							[
								[-80.661917125299155, 35.042245264120233],
								[-80.662257428469147, 35.042566288770765],
								[-80.662116500253873, 35.042670715828088],
								[-80.661715367137106, 35.042389935257198],
								[-80.661917125299155, 35.042245264120233]
							]
						],[
							[
								[-80.661547137566686, 35.042510563404129],
								[-80.661677171806787, 35.042417322902836],
								[-80.662084018102888, 35.042702102858307],
								[-80.662039854197829, 35.042756211162953],
								[-80.662002555672572, 35.042820528162387],
								[-80.661457640151127, 35.042647387136952],
								[-80.661547137566686, 35.042510563404129]
							]
						]
					]
				},{
					"type": "LineString",
					"coordinates": [
						[-80.661983228058659, 35.042968081213758],
						[-80.662076494242413, 35.042749414542243],
						[-80.662196794397431, 35.042626481357232],
						[-80.664238981504525, 35.041175532632963]
					]
				}
			]
		};
		
		var geojson_Feature = {
			"type": "Feature",
			"properties": {
				"object_type": "Road",
				"name": "Fairfield Rd."
			},
			"geometry": {
				"type": "LineString",
				"coordinates": [
					[-80.661983228058659, 35.042968081213758],
					[-80.662076494242413, 35.042749414542243],
					[-80.662196794397431, 35.042626481357232],
					[-80.664238981504525, 35.041175532632963]
				]
			}
		};
		
		var geojson_Feature_GeometryCollection = {
			"type": "Feature",
			"properties": {
				"name": "Fountainbrook Rd."
			},
			"geometry": {
				"type": "GeometryCollection",
				"geometries": [
					{
						"type": "Point",
						"coordinates": [-80.66256, 35.04271]
					},{
						"type": "LineString",
						"coordinates": [
							[-80.661983228058659, 35.042968081213758],
							[-80.662076494242413, 35.042749414542243],
							[-80.662196794397431, 35.042626481357232],
							[-80.664238981504525, 35.041175532632963]
						]
					}
				]
			}
		};
		
		var geojson_FeatureCollection = {
			"type": "FeatureCollection",
			"features": [
				{
					"type": "Feature",
					"properties": {
						"object_type": "Parcel",
						"sq_ft": 43000
					},
					"geometry": {
						"type": "Polygon",
						"coordinates": [
							[
								[-80.662120612605904, 35.042875219905184],
								[-80.662141716053014, 35.042832740965068],
								[-80.662171938563816, 35.042789546962993],
								[-80.662209174653029, 35.042750233165179],
								[-80.662250709107454, 35.042716920859959],
								[-80.662627586829899, 35.043072078075667],
								[-80.662595574310288, 35.043162322407341],
								[-80.662142312824884, 35.043015448098977],
								[-80.662145396323511, 35.042970839922489],
								[-80.662117972448982, 35.042908385949438],
								[-80.662120612605904, 35.042875219905184]
							]
						]
					}
				},{
					"type": "Feature",
					"properties": {
						"object_type": "Road",
						"name": "Fairfield Rd."
					},
					"geometry": {
						"type": "LineString",
						"coordinates": [
							[-80.661983228058659, 35.042968081213758],
							[-80.662076494242413, 35.042749414542243],
							[-80.662196794397431, 35.042626481357232],
							[-80.664238981504525, 35.041175532632963]
						]
					}
				},{
					"type": "Feature",
					"properties": {
						"object_type": "Address",
						"display": "2314 Fairfield Rd."
					},
					"geometry": {
						"type": "Point",
						"coordinates": [-80.66252, 35.04267]
					}
				}
			]
		};
		
		var roadStyle = {
			strokeColor: "#FFFF00",
			strokeWeight: 7,
			strokeOpacity: 0.75
		};
		
		var addressStyle = {
			icon: "img/marker-house.png"
		};
		
		var parcelStyle = {
			strokeColor: "#FF7800",
			strokeOpacity: 1,
			strokeWeight: 2,
			fillColor: "#46461F",
			fillOpacity: 0.25
		};
		
		var infowindow = new google.maps.InfoWindow();
		
		function init(){
			map = new google.maps.Map(document.getElementById('map'),{
				zoom: 17,
				//center: new google.maps.LatLng(-15.8022003173828,-47.8692016601562),
				center: new google.maps.LatLng(35.042248, -80.662319),
				//center: new google.maps.LatLng(-80.662319,35.042248),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
		}
		function clearMap(){
			if (!currentFeature_or_Features)
				return;
			if (currentFeature_or_Features.length){
				for (var i = 0; i < currentFeature_or_Features.length; i++){
					if(currentFeature_or_Features[i].length){
						for(var j = 0; j < currentFeature_or_Features[i].length; j++){
							currentFeature_or_Features[i][j].setMap(null);
						}
					}
					else{
						currentFeature_or_Features[i].setMap(null);
					}
				}
			}else{
				currentFeature_or_Features.setMap(null);
			}
			if (infowindow.getMap()){
				infowindow.close();
			}
		}
		function showFeature(geojson, style){
			clearMap();
			currentFeature_or_Features = new GeoJSON(geojson, style || null);
			if (currentFeature_or_Features.type && currentFeature_or_Features.type == "Error"){
				document.getElementById("put_geojson_string_here").value = currentFeature_or_Features.message;
				return;
			}
			if (currentFeature_or_Features.length){
				for (var i = 0; i < currentFeature_or_Features.length; i++){
					if(currentFeature_or_Features[i].length){
						for(var j = 0; j < currentFeature_or_Features[i].length; j++){
							currentFeature_or_Features[i][j].setMap(map);
							if(currentFeature_or_Features[i][j].geojsonProperties) {
								setInfoWindow(currentFeature_or_Features[i][j]);
							}
						}
					}
					else{
						currentFeature_or_Features[i].setMap(map);
					}
					if (currentFeature_or_Features[i].geojsonProperties) {
						setInfoWindow(currentFeature_or_Features[i]);
					}
				}
			}else{
				currentFeature_or_Features.setMap(map)
				if (currentFeature_or_Features.geojsonProperties) {
					setInfoWindow(currentFeature_or_Features);
				}
			}
			
			document.getElementById("put_geojson_string_here").value = JSON.stringify(geojson);
		}
		function rawGeoJSON(){
			clearMap();
			currentFeature_or_Features = new GeoJSON(JSON.parse(document.getElementById("put_geojson_string_here").value));
			if (currentFeature_or_Features.length){
				for (var i = 0; i < currentFeature_or_Features.length; i++){
					if(currentFeature_or_Features[i].length){
						for(var j = 0; j < currentFeature_or_Features[i].length; j++){
							currentFeature_or_Features[i][j].setMap(map);
							if(currentFeature_or_Features[i][j].geojsonProperties) {
								setInfoWindow(currentFeature_or_Features[i][j]);
							}
						}
					}
					else{
						currentFeature_or_Features[i].setMap(map);
					}
					if (currentFeature_or_Features[i].geojsonProperties) {
						setInfoWindow(currentFeature_or_Features[i]);
					}
				}
			}else{
				currentFeature_or_Features.setMap(map);
				if (currentFeature_or_Features.geojsonProperties) {
					setInfoWindow(currentFeature_or_Features);
				}
			}
		}
		function setInfoWindow (feature) {
			google.maps.event.addListener(feature, "click", function(event) {
				var content = "<div id='infoBox'><strong>GeoJSON Feature Properties</strong><br />";
				for (var j in this.geojsonProperties) {
					content += j + ": " + this.geojsonProperties[j] + "<br />";
				}
				content += "</div>";
				infowindow.setContent(content);
				infowindow.setPosition(event.latLng);
				infowindow.open(map);
			});
		}
	</script>
</head>
<body onload="init();">
	<div id="left">
		<div id="map"></div>
	</div>
	<div id="right">
		<div><input type="button" value="GeoJSON Point" onclick="showFeature(geojson_Point);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON MultiPoint" onclick="showFeature(geojson_MultiPoint);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON LineString" onclick="showFeature(geojson_LineString);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON MultiLineString" onclick="showFeature(geojson_MultiLineString);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON Polygon" onclick="showFeature(geojson_Polygon);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON Polygon with hole" onclick="showFeature(geojson_Polygon_hole);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON MultiPolygon" onclick="showFeature(geojson_MultiPolygon);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON GeometryCollection" onclick="showFeature(geojson_GeometryCollection);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON Feature" onclick="showFeature(geojson_Feature);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON Feature with GeometryCollection" onclick="showFeature(geojson_Feature_GeometryCollection);" /></div>
		<div><br /></div>
		<div><input type="button" value="GeoJSON FeatureCollection" onclick="showFeature(geojson_FeatureCollection);" /></div>
		<textarea id="put_geojson_string_here"></textarea>
		<div><input type="button" value="Show GeoJSON above" onclick="rawGeoJSON();" /></div>
	</div>
</body>
</html>