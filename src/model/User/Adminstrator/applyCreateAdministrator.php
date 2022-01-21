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
		
		//--------------------------------- Insert Administrator ---------------------------------
		$UserName = $_POST["UserName"];
		$Fname = $_POST["Fname"];
		$Lname = $_POST["Lname"];
		$Email = $_POST["Email"];
		$PhoneNo= $_POST["PhoneNo"];
		$Country = $_POST["Country"];
		$Birthdate = $_POST["BOD"];
		
		filterString($UserName); 
        filterEmail($Email);
        filterString($Fname); 
        filterString($Lname);
        filterString($PhoneNo);
        filterString($Country);
        filterString($Birthdate);

		$hashedPassword =  password_hash($_POST["password1"], PASSWORD_DEFAULT);
		$query = "INSERT INTO users(username, password, firstname, lastname, email, phonenumber, country, birthdate, userType) 
		VALUES ('".$UserName."', '$hashedPassword' ,'".$Fname."','".$Lname."','".$Email."','".$PhoneNo."','".$Country."','".$Birthdate."', 'Administrator')";
	
		$result = $conn->query($query);
		if (!$result)
			throw new Exception($query); 
		
		header("Location: /IS3-Online-Tutoring/src/public/home.php");
		
	?>

</body>
</html>