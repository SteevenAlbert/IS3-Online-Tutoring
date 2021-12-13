<?php 
session_start();
include_once "Menu.php";
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Course</title>
</head>
	
<body>

	<form method = "post" action="applyDeleteAdministrator.php">
	 <?php 
		include_once "is3library.php";
        establishConnection();

            $query = "SELECT * FROM users WHERE username = '" .$_GET["id"]."'";

            $results = $conn-> query($query);

            if(!$results)
                die("Fatal error in executing".$query);


            while($row = $results->fetch_array(MYSQLI_ASSOC)) {

                echo "Username:<br> <input type=text name=username value =".$row["Username"]." readonly><br> <br>";
                echo "First Name:<br> <input type=text name=firstName value =".$row["FirstName"]." readonly><br><br>";
                echo "Last Name:<br> <input type=text name=lastName value =".$row["LastName"]." readonly><br><br>";
                echo "Email:<br> <input type=text name=email value =".$row["Email"]." readonly><br><br>";
                echo "Phone number:<br> <input type=text name=phoneNumber value =".$row["PhoneNumber"]." readonly><br><br>";
                echo "Country:<br> <input type=text name=country value =".$row["Country"]." readonly><br><br>";
                echo "Birthdate:<br> <input type=text name=birthdate value =".$row["BirthDate"]." readonly><br><br>";
            }
         ?>

         <button type="delete"
                onclick= "if (!confirm('Are you sure you want to delete this administrator?')) 
                { return false }">
                <? header("Location:ViewCourses.php");?>
           
        Delete </button>

        
	</form>
</body>
</html>