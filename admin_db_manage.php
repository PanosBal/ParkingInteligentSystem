<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Σύστημα Προσομοίωσης Παρόδιας Στάθμευσης</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">   
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/myAjaxuploadkml.js"></script>

<style>
body {
  background-image: url("kalo.jpg");
  height: 450px;
  /* Center and scale the image nicely */
  background-position: 50% 50%;
  background-repeat: no-repeat;
  background-size: cover;
} 
container {
  width: 960px;
  background: rgba(11, 13, 24, 0.6);
  margin: 265px auto;
  border-radius: 10px;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
  -o-border-radius: 10px;
  -ms-border-radius: 10px; 
  background-color: black;
} 

form {
  padding: 35px 70px 51px 70px; }

submit {
  background: #f8ba0f;
  color: #fff;
  font-size: 14px;
  margin-top: 23px;
  padding: 15px 20px;
  cursor: pointer; }

</style>

</head>


<body>

<nav class="navbar navbar-expand-lg navbar-light  bg-white nav-pills fixed-top scrolling-navbar">
  	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
			<li class="nav-item ">
				<a class="nav-link" href="admin_index.php">Αρχική σελίδα διαχειριστή</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="admin_db_manage.php">Διαχείριση βάσης δεδομένων</a>
			</li>
			<li class="nav-item">
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
  </nav>

  
  
 <div class="container">
	
		 <form action="upload.php" method="post" enctype="multipart/form-data">
		 
			 <label for="email">Επέλεξε αρχείο KML:</label>
			<input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-light">
			<input type="submit" value="Φόρτωσε αρχείο" name="submit" class="btn btn-light">
		
		 </form>
     
		 <form action="deleteDb.php" method="post" enctype="multipart/form-data">
			Διέγραψε την υπάρχουσα βάση:
			<input type="submit" value="Διαγραφή βάσης" name="submit" class="btn btn-light">
		 </form>	
		</div>
 

  


    


</body>
</html>