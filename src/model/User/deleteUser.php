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
            try{
                if(!$results){     
                    throw new Exception("Error Occured");   
                }
                
            }catch(Exception $e){  
               echo"Message:", $e->getMessage();  
            }

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

`        <!-- Get deletion confirmation -->
         <button type="delete"
                onclick= "if (!confirm('Are you sure you want to delete this administrator?')) 
                { return false }">
                <? header("Location:approveCourse.php");?>
            
        Delete </button>

        
	</form>
</body>
</html>