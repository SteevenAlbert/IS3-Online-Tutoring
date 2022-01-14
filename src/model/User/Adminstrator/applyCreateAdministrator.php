<!DOCTYPE html>
<html>
<head>
	<title> Create Administrator </title>
</head>
<body>
	<?php
		include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
		include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
		establishConnection();
		
		//--------------------------------- Insert Administrator ---------------------------------
		// Filter email first
		if(filterEmail($_POST["email"])){
			$_POST["email"]= filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
			$query = "INSERT INTO users(username, password, firstname, lastname, email, phonenumber, country, birthdate, userType) VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["firstName"]."','".$_POST["lastName"]."','".$_POST["email"]."','".$_POST["phoneNumber"]."','".$_POST["country"]."','".$_POST["birthdate"]."', 'Administrator')";
		}
		
		$result = $conn->query($query);
		try{
			if (!$result)
			  throw new Exception("Error Occured"); 
		}
		catch(Exception $e){  
	       echo"Message:", $e->getMessage();  
	    }
		echo "Successfully created.....<br>";
		   header("Location: /IS3-Online-Tutoring/src/public/home.php");
		
	?>

</body>
</html>