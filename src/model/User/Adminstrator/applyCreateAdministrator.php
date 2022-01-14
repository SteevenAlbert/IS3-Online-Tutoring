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
		$hashedPassword =  password_hash($_POST["password1"], PASSWORD_DEFAULT);
		$query = "INSERT INTO users(username, password, firstname, lastname, email, phonenumber, country, birthdate, userType) VALUES ('".$_POST["UserName"]."', '$hashedPassword' ,'".$_POST["Fname"]."','".$_POST["Lname"]."','".$_POST["Email"]."','".$_POST["PhoneNo"]."','".$_POST["Country"]."','".$_POST["BOD"]."', 'Administrator')";
	
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