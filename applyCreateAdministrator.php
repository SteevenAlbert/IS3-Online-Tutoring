<!DOCTYPE html>
<html>
<head>
	<title> Create Administrator </title>
</head>
<body>
	<?php
		include_once "is3library.php";

		establishConnection();
		  	  
		
		$query = "INSERT INTO users(username, password, firstname, lastname, email, phonenumber, country, birthdate, userType) VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["firstName"]."','".$_POST["lastName"]."','".$_POST["email"]."','".$_POST["phoneNumber"]."','".$_POST["country"]."','".$_POST["birthdate"]."', 'administrator')";

		$result = $conn->query($query);

		if (!$result)
			die ("Fatal error in executing  $query");


		$query = "INSERT INTO administrators(username) VALUES ('".$_POST["username"]."')";

		$result = $conn->query($query);

		if (!$result)
			die ("Fatal error in executing $query");
		else
			header("Location:home.php");

		
	?>

</body>
</html>