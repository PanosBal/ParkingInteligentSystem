<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web19";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
$id =$_GET["uid"];
$type = $_GET["curve_type"];

$query = "UPDATE curve_type SET type='$type' WHERE id='$id'" ;
$result=mysqli_query($connection,$query);

$hour=$_GET["ucurve"];
$demand = $_GET["udemand"];
?>