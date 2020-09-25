<?php
if(isset($_POST["submit"])){
$fileName =basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
echo $fileName;
$kmlFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

// Check kml file extension
if(isset($_POST["submit"])) {
   if($kmlFileType === "kml") {
        echo "_______________File is a KML file " ;
		$uploadOk = 1;
		} else {
        echo "File is not a KML file.";
		$uploadOk = 0;
	}
}
}

//upload to server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web19";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else{
	echo("Conection succes");
}

ini_set('max_execution_time', 300);
$kml = simplexml_load_file($fileName);
$placemarks = $kml->Document->Folder->Placemark;
//echo(sizeof($placemarks));
$norings = array(78, 97, 131, 381, 1290, 1475, 1613, 1649, 2223, 2866, 2902, 3009, 3120, 3164);

//population,parking in db
$x=0;
foreach ($pluthismos=$kml->Document->Folder->Placemark as $Item) {
   foreach($Item->description as $Attribute){ //loopa etsi oste na paroume to description gia kathe block
        //echo ($Attribute);
		$pieces = explode(" ", $Attribute);
		//echo sizeof($pieces);
		print_r ($pieces);
		if (sizeof($pieces)>16){ //se polla tetragona den uparxei pluthismos edo ginete o elegxos
			$piecesB = explode(">", $pieces[18]); 
			$pluthismos=intval($piecesB[1]); //gia na to eisxorisoume sti vasi prepei na to metatrepsoume se int
			//echo($piecesB[1]);
		} else {
			$pluthismos=0;

	
    }
	$sql = "INSERT INTO placemark (id, population) VALUES({$x}, {$pluthismos} )";//population
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
	
	$sql = "INSERT INTO parking (id, positions) VALUES({$x}, 50 )";//parking
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

	$sql = "INSERT INTO curve_type (id, type) VALUES({$x}, 1 )";//parking
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
$x=$x+1;
}
}

//coordinates in db
for ($i=0; $i<sizeof($placemarks); $i++){
	if (!in_array($i, $norings)){
		$coordinates =$placemarks[$i]->MultiGeometry->Polygon->outerBoundaryIs->LinearRing->coordinates;
		$pieces = explode(" ", $coordinates);		
		$num_of_points = count($pieces);

		for($y=1; $y<$num_of_points; $y++){			
			$points_in_map = explode(",", $pieces[$y]);
			$point_x = floatval($points_in_map[0]);
			$point_y = floatval($points_in_map[1]);			
			
			$sql = "INSERT INTO coordinates (id, point_x, point_y) VALUES({$i}, {$point_x}, {$point_y})";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
}	






?>