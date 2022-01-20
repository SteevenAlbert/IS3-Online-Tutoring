<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

<?php 
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

isAdmin();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../../CSS/view.css">

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Course</title>
</head>
	
<body>

	<form method = "post" action="/IS3-Online-Tutoring/src/model/User/Adminstrator/applyDeleteAdministrator.php">
	 <?php 
        establishConnection();

            //----------------------------- Display user to delete details -----------------------------
            $query = "SELECT * FROM users WHERE UserID = '" .$_GET["id"]."'";
            $results = $conn-> query($query);
			if(!$results){     
				throw new Exception($query);   
			}
                

            while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                ?>
            <img id="deleteAdmin" src="../../../uploads/backgroundImages/deleteAdmin.jpg" alt="deleteAdmin" width="600" height="600">
            <div id="centerViewForm">

                <div class="row">
					<div class="col-lg-6">
						 <label>Firstname</label>
							 <div id="viewAdminData">
								 <?php echo "".$row["FirstName"].""; ?>
							 </div>
					</div>
					<div class="col-lg-6" style="margin-bottom:5%">
						 <label>Lastname</label>
							 <div id="viewAdminData">
								 <?php echo "".$row["LastName"].""; ?>
							 </div>
					</div>
				</div>

                <div class="row">
					<div class="col-lg-6" style="margin-bottom:3%">
						 <label>Username</label>
							<div id="viewAdminData">
							    <?php echo "".$row["Username"].""; ?>
							</div>
					</div>
					<div class="col-lg-6" style="margin-bottom:3%">
						<label>Email</label>
							<div id="viewAdminData">
							 <?php echo "".$row["Email"].""; ?>
							</div>
					</div>
				</div>

                <div class="row">
					<div class="col-lg-6">
						<label>Number</label>
							<div id="viewAdminData">
								 <?php echo "".$row["PhoneNumber"].""; ?>
							</div>
					</div>
					<div class="col-lg-6" style="margin-bottom:3%">
						<label>Country</label>
							<div id="viewAdminData">
								 <?php echo "".$row["Country"].""; ?>
							</div>
					</div>
				</div>

                <div class="row">
						 <div class="col-lg-6" style="margin-bottom:3%">
							 <label>Birth Date</label>
								 <div id="viewAdminData">
									 <?php echo "".$row["BirthDate"].""; ?>
								</div>
						</div>
				</div><br>

                <div class="row">
						<div class="col-lg-12">
                            <button class="btn btn-danger" type="delete" onclick= "if (!confirm('Are you sure you want to delete this administrator?')) { return false }"><? header("Location:approveCourse.php");?><i class="fa fa-trash fa-2x"></i></button>
					    </div>
				</div>  

            </div>
            <?php
            }
         ?>
        
	</form>
</body>
</html>