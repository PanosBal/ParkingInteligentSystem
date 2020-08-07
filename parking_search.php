<?php 
include"login.php"
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
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jDBSCAN.js"></script>         
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

<nav class="navbar navbar-expand-lg navbar-light nav-pills fixed-top scrolling-navbar">
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Αρχική σελίδα</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="city_elements.php">Απεικόνιση στοιχείων πόλης</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Αναζήτηση προτάσεων περιοχής στάθμευσης</a>
      </li>    
    </ul>
	
  </div>  
</nav>


Επιθυμητή Ώρα Παρκαρίσματος: <input type="time" id="myTime" value="12:00:00">
<button onclick="getTime()">Δείξε ώρα</button> 
Μέγιστη Ακτίνα Στάθμευσης(μέτρα): <input type="number" id="myRadius" value="100" min="1" max="6000">

<div id="mapid" style="width: auto; height: 800px; position: relative; outline: none;" class="leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
<div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
<div class="leaflet-pane leaflet-tile-pane">
<div class="leaflet-layer " style="z-index: 1; opacity: 1;">
<div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);">

<?php include 'elements_from_db.php';?>
<?php include 'dbscan.php';?>

<script>

function getTime() {
	    var now= new Date();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
          
        var dateTime = hour+':'+minute;   
        return dateTime;
    }

document.getElementById('myTime').value = getTime();

mymap =new L.map('mapid').setView([40.640266,  22.939524], 13);	
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);

function showTime()
{
	var x=parseInt(document.getElementById("myTime").value);
	//alert(x);
	if (x==0){
		alert("00:00");
	}else if (x==1){
		alert("01:00");
	}else if (x==2){
		alert("02:00");
	}else if (x==3){
		alert("03:00");
	}else if (x==4){
		alert("04:00");
	}else if (x==5){
		alert("05:00");
	}else if (x==6){
		alert("06:00");
	}else if (x==7){
		alert("07:00");
	}else if (x==8){
		alert("08:00");	
	}else if (x==9){
		alert("09:00");
	}else if (x==10){
		alert("10:00");
	}else if (x==11){
		alert("11:00");
	}else if (x==12){
		alert("12:00");
	}else if (x==13){
		alert("13:00");
	}else if (x==14){
		alert("14:00");
	}else if (x==15){
		alert("15:00");	
	}else if (x==16){
		alert("16:00");
	}else if (x==17){
		alert("17:00");
	}else if (x==18){
		alert("18:00");
	}else if (x==19){
		alert("19:00");
	}else if (x==20){
		alert("20:00");	
	}else if (x==21){
		alert("21:00");
	}else if (x==22){
		alert("22:00");
	}else if (x==23){
		alert("23:00");		
	}
}


//functions for find centroid
    function Point(x, y) {
        this.x = x;
        this.y = y;
    }

    function Region(points) {
        this.points = points || [];
        this.length = points.length;
    }

    Region.prototype.area = function () {
        var area = 0,
            i,
            j,
            point1,
            point2;

        for (i = 0, j = this.length - 1; i < this.length; j = i, i += 1) {
            point1 = this.points[i];
            point2 = this.points[j];
            area += point1.x * point2.y;
            area -= point1.y * point2.x;
        }
        area /= 2;

        return area;
    };

    Region.prototype.centroid = function () {
        var x = 0,
            y = 0,
            i,
            j,
            f,
            point1,
            point2;

        for (i = 0, j = this.length - 1; i < this.length; j = i, i += 1) {
            point1 = this.points[i];
            point2 = this.points[j];
            f = point1.x * point2.y - point2.x * point1.y;
            x += (point1.x + point2.x) * f;
            y += (point1.y + point2.y) * f;
        }

        f = this.area() * 6;

        return new Point(x / f, y / f);
    };
//end of functions find centroid
	
	var coords= JSON.parse('<?php echo json_encode($datas); ?>');
	var population= JSON.parse('<?php echo json_encode($datas_pop); ?>');
	var parking= JSON.parse('<?php echo json_encode($datas_parking); ?>');
	var curves=JSON.parse('<?php echo json_encode($datas_curves); ?>');
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
	 

 
var geojson = {};
geojson['type'] = 'FeatureCollection';
geojson['features'] = [];

var panagia=[];
var print_JSON=[];
var centroids=[];
var temp_coords=[];
var temp_centroids=[];
var what_time=parseInt(document.getElementById("myTime").value);//tsekaroume ti ora einai
var marker;
var kentro;
for(var j = 0; j <=id_len; j++) 
{
	temp_coords=[];
	temp_centroids=[];
	for(var i = 0; i < coords.length; i++) 
	{
		if(coords[i].id == j) 
		{
			temp_coords.push([parseFloat(coords[i].point_x),parseFloat(coords[i].point_y)]);
			temp_centroids.push({x:parseFloat(coords[i].point_x),y:parseFloat(coords[i].point_y)});
		}
		region=new Region(temp_centroids);
	}
	
	panagia[j]={
		"type": "Feature",
		"properties": { "id": j,
						"percentOccupied":parseInt((100*((parseInt(parking[j].positions)-parseInt(20/100 * population[j].population))*center[what_time]))/parking[j].positions),
						"centroid":region.centroid()
						},
		"geometry": {
			"type": "Polygon",
			"coordinates": [temp_coords],
			//gfhtrng"color":"#ff7800"
					}
				}
	kentro=region.centroid();
	var a=Number(kentro.x);
	var b=Number(kentro.y);
	//console.log(kentro);
	centroids.push([parseFloat(a),parseFloat(b)]);
	
	
}
//evresi apostasis
function getDistance(origin, destination) {
    // return distance in meters
    var lon1 = toRadian(origin[1]),
        lat1 = toRadian(origin[0]),
        lon2 = toRadian(destination[1]),
        lat2 = toRadian(destination[0]);

    var deltaLat = lat2 - lat1;
    var deltaLon = lon2 - lon1;

    var a = Math.pow(Math.sin(deltaLat/2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon/2), 2);
    var c = 2 * Math.asin(Math.sqrt(a));
    var EARTH_RADIUS = 6371;
    return c * EARTH_RADIUS * 1000;
}
function toRadian(degree) {
    return degree*Math.PI/180;
}
//Telos evresis apostasis

//50 metra makria
function getCoordinate(coord){
    var r = 50 / 111300
        , y0 = coord[0]
        , x0 = coord[1]
        , u = Math.random()
        , v = Math.random()
        , w = r * Math.sqrt(u)
        , t = 2 * Math.PI * v
        , x = w * Math.cos(t)
        , y1 = w * Math.sin(t)
        , x1 = x / Math.cos(y0)
    
    var newY = y0 + y1,
        newX = x0 + x1;
    return [newY, newX];
}

//function for toggle marker
var theMarker = {};
var parkMarker={};

var circle;
  mymap.on('click',function(e){
	var radius=parseInt(document.getElementById("myRadius").value);
    lat = e.latlng.lat;
    lon = e.latlng.lng;
	
    console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );
        //Clear existing marker, 

        if (theMarker != undefined) {
              mymap.removeLayer(theMarker);
        };
		if (circle != undefined) {
              mymap.removeLayer(circle);
        };

    //Add a marker to show where you clicked.
     theMarker = L.marker([lat,lon]).addTo(mymap);
	 circle=L.circle([lat,lon], radius).addTo(mymap);
	
	//generate simeia
	var a,b;
	var point_data=[];
	for (i = 0, len = centroids.length; i < len; i++) { 
		a=centroids[i][0];
		b=centroids[i][1];
		var distance = getDistance([lat, lon], [b, a])
		if (distance<radius){                          //check
			//console.log(parking[i]);
			for (j=0; j<parking[i].positions; j++){
				//console.log(j,getCoordinate([a,b]));
				var temp=(getCoordinate([a,b]));
				point_data.push({location:{latitude:parseFloat(temp[0]),longitude:parseFloat(temp[1])}});
			}
		}
	}
	//console.log(point_data);
	var dbscanner = jDBSCAN().eps(0.0075).minPts(1).distance('HAVERSINE').data(point_data);
	var point_assignment_result = dbscanner();
	//console.log(point_assignment_result);
	//console.log(Math.max.apply(null,point_assignment_result));
	var cluster_centers = dbscanner.getClusters();
    //console.log(cluster_centers);
	var max=Math.max.apply(Math, cluster_centers.map(function(o) { return o.dimension; }))//evresi simeiou me perissotera clusters
	//console.log(max);
	
	for(var z in cluster_centers){
		if (max==cluster_centers[z].dimension){
			if (parkMarker != undefined) {
              mymap.removeLayer(parkMarker);
			};
			parkMarker = L.marker([cluster_centers[z].location.longitude, cluster_centers[z].location.latitude]).addTo(mymap);
			var lati=cluster_centers[z].location.latitude;
			var longi=cluster_centers[z].location.longitude;
			var dist=getDistance([cluster_centers[z].location.longitude, cluster_centers[z].location.latitude], [lat, lon]);
			var obj = { latitude: lati, logitude: longi, Apostasi: dist };
			var myJSON = JSON.stringify(obj);
			console.log(myJSON);
			}	
					
	}
				
});
//end of function for toggle marker

var layerGroup = L.geoJSON(panagia,{
    onEachFeature: function (feature, layer) {
	layer.setStyle({color : 'grey'}) 
  }
}).addTo(mymap);
 


</script>



</body>
</html>
</body>
</html>
