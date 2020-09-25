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
      <li class="nav-item active">
        <a class="nav-link" href="#">Απεικόνιση στοιχείων πόλης</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="parking_search.php">Αναζήτηση προτάσεων περιοχής στάθμευσης</a>
      </li>    
    </ul>
  </div>  
</nav>


Ώρα Εξομοίωσης: <input type="time" id="myTime" value="12:00:00">

<label for="number">Συμπλήρωσε Βήμα Εξομοίωσης(λεπτά)</label>
<input type="number" id="myNumber" min="1" max="60">
<button onclick="minutesUP()">+</button>
<button onclick="minutesDown()">-</button>
<button onclick="showTime()">Δείξε ώρα</button>
<button onclick="simulationRun()">Τρέξε εξομοίωση</button>

<div id="mapid" style="width: auto; height: 800px; position: relative; outline: none;" class="leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
<div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
<div class="leaflet-pane leaflet-tile-pane">
<div class="leaflet-layer " style="z-index: 1; opacity: 1;">
<div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);">

<?php include 'elements_from_db.php';?>

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
//var centroids=[];
var temp_coords=[];
var temp_centroids=[];

function simulationRun()
{ 

var what_time=parseInt(document.getElementById("myTime").value);//tsekaroume ti ora einai

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
		

}

var myJSON = JSON.stringify(panagia);
console.log(myJSON);

function getColor(d) {
	 return d>84 ? 'red' :
			d>59 ? 'yellow' :
				   'green';

}	


function style(feature) {
    return {
        color: getColor(feature.properties.percentOccupied)
}
}

var layerGroup = L.geoJSON(panagia,{
	style:style,
    onEachFeature: function (feature, layer) {
	//layer.setStyle({color : 'red'}) 
  }
}).addTo(mymap);

//mymap.off('click', simulationRun);
var t1 = performance.now();
console.log(t1)

}
</script>



</body>
</html>
</body>
</html>
