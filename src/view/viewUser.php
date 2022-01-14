<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

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
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../CSS/view.css">

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form>

		<?php
		establishConnection();
		isAdmin();

		//------------------------------ Get user info ---------------------------------------

		//query for learners(profile picture)
		$query = "SELECT u.*, l.profile_picture from users u, learners l where u.UserID = '".$_GET["id"]."' AND u.UserID=l.UserID";
		$result = $conn->query($query);
		try{
			if (!$result){
				throw new Exception("Error Occured"); 
			}
						
		}catch(Exception $e){  
		   echo"Message:", $e->getMessage();  
		}

		//query for admins
		$query_admin = "SELECT * from users where UserID = '".$_GET["id"]."'";
		$result_admin = $conn->query($query_admin);

		try{
			if (!$result_admin){
				throw new Exception("Error Occured"); 
			}
						
		}catch(Exception $e){  
		   echo"Message:", $e->getMessage();  
		}

		//------------------------------ Display user info ---------------------------------------
		// while ($row = $result->fetch_array(MYSQLI_ASSOC))
		// {
		// 	if ($row['UserType'] == "Learner"){
        //       echo "<img src =.\\images\\". $row["profile_picture"]. " width = 100><br> <br>";
		// 	  echo "Username:<br> <input type=text name=username value =".$row["Username"]." readonly><br> <br>";
		// 	  echo "First Name:<br> <input type=text name=firstName value =".$row["FirstName"]." readonly><br><br>";
		// 	  echo "Last Name:<br> <input type=text name=lastName value =".$row["LastName"]." readonly><br><br>";
		// 	  echo "Email:<br> <input type=text name=email value =".$row["Email"]." readonly><br><br>";
		// 	  echo "Phone number:<br> <input type=text name=phoneNumber value =".$row["PhoneNumber"]." readonly><br><br>";
		// 	  echo "Country:<br> <input type=text name=country value =".$row["Country"]." readonly><br><br>";
		// 	  echo "Birthdate:<br> <input type=text name=birthdate value =".$row["BirthDate"]." readonly><br><br>";
		// 	}
		// }


		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			if ($row['UserType'] == "Learner"){
				?>
				<div class="BannerText">
					<h1>Learner</h1>
				</div>
				<img id="viewLearnerImage" src="../../uploads/backgroundImages/viewLearnerImage.png" alt="viewLearnerImage" width="600" height="600">
				<div id="centerViewForm">
					<form class="form-group text-left" method ="post" action = "/<?php echo $root ?>/src/model/User/Register.php" enctype="multipart/form-data">
					

					<div class="row">
						<div class="col-lg-12">
							<label>Profile Picture</label>
							<?php "<img src =.\\images\\". $row["profile_picture"]. " width = 100>"; ?>
						</div>
					<div>	

					 <!-- User Details -->
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
							 <td> <a href =/IS3-Online-Tutoring/src/model/User/deleteUser.php?id=<?php echo $row["UserID"] ?> class="btn btn-danger" > Delete </a> </td>
						 </div>
					</div>	 
					
				 </div>
					<?php
					}
				}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		while ($row = $result_admin->fetch_array(MYSQLI_ASSOC))
		{
			if ($row['UserType'] != "Learner"){
			?>
			<div class="BannerText">
					<h1>Admin</h1>
				</div>
			<img id="viewAdminImage" src="../../uploads/backgroundImages/viewAdminData.jpg" alt="viewAdminImage" width="600" height="600">
        	<div id="centerViewForm">
			<form class="form-group text-left" method ="post" action = "/<?php echo $root ?>/src/model/User/Register.php" enctype="multipart/form-data">
             
			 <!-- User Details -->
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
				 	<td> <a href =/IS3-Online-Tutoring/src/model/User/deleteUser.php?id=<?php echo $row["UserID"] ?> class="btn btn-danger" > Delete </a> </td>
				 </div>
			</div>	 
			
		 </div>
			<?php
			}
		}

		?>

	</form>

</body>
</html>