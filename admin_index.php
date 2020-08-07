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
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light  bg-white nav-pills fixed-top scrolling-navbar">
  	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="admin_index.php">Αρχική σελίδα διαχειριστή</a>
			</li>
			<li class="nav-item">
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
  </div>
</nav>

<!--Page Intro -->
<div class="bg">
</div>

<!--Page End -->
		  
<div class="container">
    <!--Grid row-->
	<div class="row">
        <!--Grid column-->
         <div class="col white-text text-center text-md-cednter mt-xl-5 mb-5" >
            <h1 class="display-4 font-weight-bold white-text pt-5 mb-2">Σελίδα διαχειριστή</h1>
            <hr class="hr-light">
            <h6 class="mb-4">Καλωσήρθατε στη σελίδα διαχείρισης....<h6>
        </div>
     <!--Grid column-->   
    </div>
</div>      



</body>
</html>