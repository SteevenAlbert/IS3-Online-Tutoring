<!DOCTYPE html>
<html>
<head>
	<title> Create Administrator </title>
</head>
<body>
	<?php
		include_once "filters.php";
		include_once "is3library.php";

		establishConnection();
		
		//--------------------------------- Insert Administrator ---------------------------------
		// Filter email first
		if(filterEmail($_POST["email"])){
			$_POST["email"]= filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
			$query = "INSERT INTO users(username, password, firstname, lastname, email, phonenumber, country, birthdate, userType) VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["firstName"]."','".$_POST["lastName"]."','".$_POST["email"]."','".$_POST["phoneNumber"]."','".$_POST["country"]."','".$_POST["birthdate"]."', 'Administrator')";
		}
		
		$result = $conn->query($query);

		if (!$result)
			die ("Fatal error in executing  $query");
		else
			header("Location:home.php");

		
	?>

</body>
</html>