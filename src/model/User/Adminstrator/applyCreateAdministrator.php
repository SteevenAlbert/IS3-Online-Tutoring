<!DOCTYPE html>
<html>
<head>
	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
	<title> Create Administrator </title>
</head>
<body>
	<?php
		include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
		include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
		establishConnection();
		isAdmin();
		
		//--------------------------------- Insert Administrator ---------------------------------
		// Filter email first
		$hashedPassword =  password_hash($_POST["password1"], PASSWORD_DEFAULT);
		$query = "INSERT INTO users(username, password, firstname, lastname, email, phonenumber, country, birthdate, userType) VALUES ('".$_POST["UserName"]."', '$hashedPassword' ,'".$_POST["Fname"]."','".$_POST["Lname"]."','".$_POST["Email"]."','".$_POST["PhoneNo"]."','".$_POST["Country"]."','".$_POST["BOD"]."', 'Administrator')";
	
		$result = $conn->query($query);
		if (!$result)
			throw new Exception($query); 
		
		header("Location: /IS3-Online-Tutoring/src/public/home.php");
		
	?>

</body>
</html>