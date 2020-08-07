<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username']))
{
	header("location:login.php");
	exit;
}
?>

<?php
include 'elements_from_db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Σύστημα Προσομοίωσης Παρόδιας Στάθμευσης</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">   
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
 
<style>
#popup-form
{
  overflow: scroll;
  height: 100%;
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light  bg-white nav-pills fixed-top scrolling-navbar">
  	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
			<li class="nav-item ">
				<a class="nav-link" href="admin_index.php">Αρχική σελίδα διαχειριστή</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" href="admin_db_manage.php">Διαχείριση βάσης δεδομένων</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="admin_elements.php">Διαχείριση οικοδομικών τετραγώνων</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="admin_simulation.php">Εκτέλεση εξομοίωσης</a>
			</li>
		</ul>
		<div class="nav navbar-nav ml-auto">
			<li>
				<a class="nav-link" href="logout.php">Αποσύνδεση</a>
			</li>
		</div>
	</div>
  </div>
</nav>

<div id="mapid" style="width: auto; height: 800px; position: relative; outline: none;" class="leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
<div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
<div class="leaflet-pane leaflet-tile-pane">
<div class="leaflet-layer " style="z-index: 1; opacity: 1;">
<div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);">

<?php include 'elements_from_db.php';?>

<script>
//end of functions find centroid	
	var coords= JSON.parse('<?php echo json_encode($datas); ?>');
	var population= JSON.parse('<?php echo json_encode($datas_pop); ?>');
	var parking= JSON.parse('<?php echo json_encode($datas_parking); ?>');
	var curves=JSON.parse('<?php echo json_encode($datas_curves); ?>');
	var curve_type=JSON.parse('<?php echo json_encode($datas_curve_type); ?>');
	console.log(curve_type);
	var x=0;//temp variable
		
	for(var i = 0; i < coords.length; i++) {
		id_len=coords[i].id;
	}
	
	//kampules zitiseis apo vasi se pinaka
	var center=[];
	var residence=[];
	var stable=[];
	
	for(var i = 0; i < curves.length; i++) {
		center[i]=curves[i].center;
	}
	for(var i = 0; i < curves.length; i++) {
		residence[i]=curves[i].residence;
	}
	for(var i = 0; i < curves.length; i++) {
		stable[i]=curves[i].stable;
	}
	
	console.log(center);
	var mymap = L.map('mapid').setView([40.640266,  22.939524], 13);	
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);
	
  var template = '<form id="popup-form">\
  <label for="input-parkingNumber"> Νέες θέσεις στάθμευσης:</label>\
  <input id="input-parkingNumber" class="popup-input" type="number" />\
   <br>\
  <label for="input-curve_type">Νέα καμπύλη ζήτησης:</label>\
  <input id="input-curve_type" class="popup-input" type="array" />\
   <br>\
  <table class="popup-table">\
  <tr class="popup-table-row">\
      <th class="popup-table-header">ID:</th>\
      <td id="value-id" class="popup-table-data" name="did" value="value-id"></td>\
    </tr>\
    <tr class="popup-table-row">\
      <th class="popup-table-header">Θέσεις στάθμευσης:</th>\
      <td id="value-parkingNumber" class="popup-table-data" name="dpositions" value="value-parkingNumber"></td>\
    </tr>\
	<tr class="popup-table-row">\
      <th class="popup-table-header">Είδος Καμπύλη Ζήτησης:</th>\
      <td id="value-curve_type" class="popup-table-data" name="dcurve_type" value="value-curve_type"></td>\
    </tr>\
  </table>\
  <button id="button-submit" type="button" >Αποθήκευση αλλαγών</button>\
	</form>';
	
function layerClickHandler (e) {

  var polygon = e.target,
      properties = e.target.feature.properties;
  
  if (polygon.hasOwnProperty('_popup')) {
    polygon.unbindPopup();
  }

  polygon.bindPopup(template);
  polygon.openPopup();
  
  L.DomUtil.get('value-id').textContent = properties.id;  
  L.DomUtil.get('value-parkingNumber').textContent = properties.parkingNumber;
  L.DomUtil.get('value-curve_type').textContent = properties.curve_type;

  var inputParkingNumber = L.DomUtil.get('input-parkingNumber');
  inputParkingNumber.value = properties.parkingNumber;
  L.DomEvent.addListener(inputParkingNumber, 'change', function (e) {
   properties.parkingNumber = e.target.value;
   
   var uid=properties.id;
   var parking_number=properties.parkingNumber;
   if (window.XMLHttpRequest) 
   {   
   xmlhttp = new XMLHttpRequest();// code for modern browsers
	} else {
   // code for old IE browsers
   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
   xmlhttp.open("GET", "ajax_update.php?uid=" + uid + "&parking_number=" + parking_number , true);
   xmlhttp.send();
   console.log(xmlhttp);
  });

 var inputCurve_type = L.DomUtil.get('input-curve_type');
  inputCurve_type.value = properties.curve_type;
  L.DomEvent.addListener(inputCurve_type, 'change', function (e) {
    properties.curve_type = e.target.value;
	var uid=properties.id;	
  var curve_type=properties.curve_type;
   if (window.XMLHttpRequest) 
   {   
   xmlhttp = new XMLHttpRequest();// code for modern browsers
	} else {
   // code for old IE browsers
   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
   xmlhttp.open("GET", "ajax_two.php?uid=" + uid + "&curve_type=" + curve_type , true);
   xmlhttp.send();
   console.log(xmlhttp);
  });
  
  var buttonSubmit = L.DomUtil.get('button-submit');
  L.DomEvent.addListener(buttonSubmit, 'click', function (e) {
    polygon.closePopup();
  });

}

function onEachFeature(feature, layer) {
    //bind click
    layer.on({
        click: layerClickHandler
    });
}


var geojson = {};
geojson['type'] = 'FeatureCollection';
geojson['features'] = [];

var panagia=[];
var temp_coords=[];
for(var j = 0; j <=id_len; j++) 
{
	temp_coords=[];
	for(var i = 0; i < coords.length; i++) 
	{
		if(coords[i].id == j) 
		{
			temp_coords.push([parseFloat(coords[i].point_x),parseFloat(coords[i].point_y)]);
		}
		
	}
	
	var temp_curve;
	if (curve_type[j].type == 1) {
	  temp_curve=center;
	} else if (curve_type[j].type ==2) {
	  temp_curve=residence;
	} else {
	  temp_curve=stable;
	}
	panagia[j]={
		"type": "Feature",
		"properties": { "id": j,
					    "parkingNumber":parking[j].positions,
						"occupiedResidentPositions":parseInt(20/100 * population[j].population),
						"curve_type":curve_type[j].type,
						"curveDemand_0":temp_curve
						},
		"geometry": {
			"type": "Polygon",
			"coordinates": [temp_coords],
			//gfhtrng"color":"#ff7800"
					}
				}

}

console.log(panagia);


var layerGroup = L.geoJSON(panagia,{
    onEachFeature: function (feature, layer) {
    layer.on('click', layerClickHandler)
	layer.setStyle({color : 'grey'}) 
  }
}).addTo(mymap);

var t1 = performance.now();
console.log(t1);



</script>
</body>
</html>
?>

