<?php 
include"login.php"
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <title>Σύστημα Προσομοίωσης Παρόδιας Στάθμευσης</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  </style>
</head>
<body>

<!--div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Σύστημα Προσομοίωσης Παρόδιας Στάθμευσης</h1>
</div-->

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top scrolling-navbar">  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Αρχική σελίδα</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="city_elements.php">Απεικόνιση στοιχείων πόλης</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="parking_search.php">Αναζήτηση προτάσεων περιοχής στάθμευσης</a>
      </li>    
    </ul>
	<div class="navbar-nav ml-auto">
		<li>
			<button type="button" class="btn  btn-light" data-toggle="modal" data-target="#loginModal" > Σύνδεση</button>
		</li>
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
            <h1 class="display-4 font-weight-bold white-text pt-5 mb-2">Σύστημα προσωμοίωσης παρόδιας στάθμευσης</h1>
            <hr class="hr-dark">
            <h6 class="mb-4">Καλωσήρθατε στο σύστημα προσομομοίωσης παρόδιας στάθμευσης. Στο σύστημα αυτό μπορείτε ως χρήστες να...</h6>
                    
        </div>
     <!--Grid column-->   
    </div>
</div>      

		  
		  
<!-- The Modal -->
<div class="modal fade" id="loginModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		<h6 class=modal-title>Σύνδεθείτε στο σύστημα ως διαχειριστής</h6>
		<button type="button" class="close" data-dismiss="modal"> &times;</button>
			
		</div>
		<div class="modal-body">
			<form action="" method="post">
				<input type="text" name="Username" placeholder="Όνομα χρήστη" required>
				<input type="password" name="Password" placeholder="Κωδικός Πρόσβασης" required>
				<input type="submit" name="Submit" value="Σύνδεση">
			</form>
		
        </form>
      </div>

  </div>
</div>



</body>
</html>
