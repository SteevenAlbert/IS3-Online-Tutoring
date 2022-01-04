<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create administrator</title>
</head>
<body>

	<h2> Create a new administrator </h2>


	<!------------------------------------------ Administrator registration form ---------------------------------------->
	<form method = "post" action = "/IS3-Online-Tutoring/src/model/User/Adminstrator/applyCreateAdministrator.php" onsubmit="return validatePasswords(this);">

		Username: <br> <input type = text name = "username" id = "username" placeholder = "John97" required><br> <br>
		Password:<br><input type = password name = "password" id = "password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
        Confirm Password:<br><input type = password name = "password2" id = "password2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  required><br>
        <span id = "passwordText"></span> 
		 <br> <br> <br>


		First Name:<br> <input type = text name = "firstName" placeholder = "John" required> <br><br>
		Last Name:<br> <input type = text name = "lastName" placeholder = "Smith" required><br><br>
		Email:<br> <input type = email name = "email"placeholder = "johnsmith@gmail.com" required><br><br>
		Phone number:<br> <input type = tel name = "phoneNumber"  placeholder = "+201009876523" required><br><br>
		Country:<br> 
		<?php countriesList(); ?>
		<br><br>
		Birthdate:<br> <input type = date name = "birthdate" required><br><br> <br><br>

		<input type = "submit" name = "submit"> <input type = "reset">


	</form>	
	

</body>
</html>