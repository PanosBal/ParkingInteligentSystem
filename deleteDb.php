<?php
if(isset($_POST['submit'])){

//connect to server
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

$sql="TRUNCATE TABLE placemark";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

$sql="TRUNCATE TABLE coordinates";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
$sql="TRUNCATE TABLE parking";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

$sql="TRUNCATE TABLE curve_type";
if ($conn->query($sql) === TRUE) {
				echo "Table cleared successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}



}
?>