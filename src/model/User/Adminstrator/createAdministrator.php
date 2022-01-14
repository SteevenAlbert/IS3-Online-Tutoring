<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../../../CSS/registerForm.css">

<!DOCTYPE html>
<html>
<head>
	<title>Create administrator</title>
</head>
<body>

<img id="adminImage" src="../../../../uploads/backgroundImages/adminImage.jpg" alt="adminImage" width="500" height="500">
<div class="container">
	<div id="centerForm">
	<h1 class="text-center" style="color:black;">Create a new administrator </h1>


	<!------------------------------------------ Administrator registration form ---------------------------------------->
	<form class="form-group text-left" method = "post" action = "/IS3-Online-Tutoring/src/model/User/Adminstrator/applyCreateAdministrator.php" onsubmit="return validatePasswords(this);">
													   
    	<div class="row">
			<!-- <div class="form-group text-left"> -->
			<div class="col-lg-6">
				<label style="color:black;">Name:</label>
				<input type = text name = "firstName" placeholder = "First Name" class="form-control" required><i class="fas fa-user icon-color"></i>
			</div>
			<div class="col-lg-6" style="margin-bottom:3%">
				<label><br></label>
				<input type = text name = "lastName" placeholder = "Last Name" class="form-control" required></i>
			</div>
		<!-- </div> -->
   		</div>

		<div class="row">
			<!-- <div class="form-group text-left"> -->
				<div class="col-lg-12" style="margin-bottom:3%">
					<label style="color:black;">Email:</label>
					<input type = email name = "email"placeholder = "johnsmith@gmail.com" class="form-control" required><i class="fas fa-envelope emailIcon-color"></i>
				</div>
		<!-- </div> -->
   		</div>
		
		<div class="row">
			<!-- <div class="form-group text-left"> -->
				<div class="col-lg-12" style="margin-bottom:3%">
					<label style="color:black;">Username:</label>
					<input type = text name = "username" id = "username" placeholder = "John97" class="form-control" required><i class="fas fa-user emailIcon-color"></i>
				</div>
			<!-- </div> -->
   		</div>

		<div class="row">
			<!-- <div class="form-group text-left"> -->
				<div class="col-lg-6">
					<label style="color:black;">Password:</label>
					<input type = password name = "password" id = "password1" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        				   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required><i class="fas fa-lock icon-color"></i> 
				</div>
				<div class="col-lg-6" style="margin-bottom:3%">
					<label><br></label>
					<input type = password name = "password2" id = "password2" placeholder="Re-Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        				   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required>
        				   <span id = "passwordText"></span>
				</div>
			<!-- </div> -->
   		</div>

		<div class="row">
			<!-- <div class="form-group text-left"> -->
				<div class="col-lg-6" style="margin-bottom:3%">
					<label style="color:black;">Phone Number:</label>
					<input type = tel name = "phoneNumber"  placeholder = "+201009876523" class="form-control" required><i class="fas fa-mobile-alt icon-color"></i>
				</div>
				<div class="col-lg-6">
					<label>Country:</label>
					<?php countriesList(); ?>
				</div>
			<!-- </div> -->
   		</div>

		<div class="row">
			<!-- <div class="form-group text-left"> -->
				<div class="col-lg-6" style="margin-bottom:3%">
					<label style="color:black;">Birth Date:</label>
					<input type = date name = "birthdate" class="form-control" required>
				</div>
			<!-- </div> -->
   		</div>
		   
		<div class="row">
			<!-- <div class="form-group text-left"> -->
				<input type = "submit" name = "submit" class="form-control btn btn-primary btn-block btn-lg" style="margin-bottom:2%"> 
				<input type = "reset"  class="form-control">
			<!-- </div> -->
   		</div>

	</div>
	</div>

	</form>	
	
</body>
</html>