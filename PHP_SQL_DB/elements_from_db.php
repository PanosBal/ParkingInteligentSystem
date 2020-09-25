<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web19";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="SELECT * FROM coordinates";     
$sql_pop="SELECT * FROM placemark";
$sql_park="SELECT * from parking";
$sql_curves="SELECT * from curves";
$sql_curve_type="SELECT * from curve_type";

$result=mysqli_query($conn,$sql);
$result_pop=mysqli_query($conn,$sql_pop);
$result_parking=mysqli_query($conn,$sql_park);
$result_curves=mysqli_query($conn,$sql_curves);
$result_curve_type=mysqli_query($conn,$sql_curve_type);

$datas=array();
$datas_pop=array();
$datas_parking=array();
$datas_curves=array();
$datas_curve_type=array();

if (mysqli_num_rows($result)){
	while($row=mysqli_fetch_assoc($result)){
		$datas[]=$row;
	}
}


if (mysqli_num_rows($result_pop)){
	while($row=mysqli_fetch_assoc($result_pop)){
		$datas_pop[]=$row;
	}
}

if (mysqli_num_rows($result_parking)){
	while($row=mysqli_fetch_assoc($result_parking)){
		$datas_parking[]=$row;
	}
}

if (mysqli_num_rows($result_curves)){
	while($row=mysqli_fetch_assoc($result_curves)){
		$datas_curves[]=$row;
	}
}

if (mysqli_num_rows($result_curve_type)){
	while($row=mysqli_fetch_assoc($result_curve_type)){
		$datas_curve_type[]=$row;
	}
}
//print_r($datas_pop);
?>



