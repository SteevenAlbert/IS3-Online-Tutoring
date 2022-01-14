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
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			if ($row['UserType'] == "Learner"){
              echo "<img src =.\\images\\". $row["profile_picture"]. " width = 100><br> <br>";

			echo "Username:<br> <input type=text name=username value =".$row["Username"]." readonly><br> <br>";
			echo "First Name:<br> <input type=text name=firstName value =".$row["FirstName"]." readonly><br><br>";
			echo "Last Name:<br> <input type=text name=lastName value =".$row["LastName"]." readonly><br><br>";
			echo "Email:<br> <input type=text name=email value =".$row["Email"]." readonly><br><br>";
			echo "Phone number:<br> <input type=text name=phoneNumber value =".$row["PhoneNumber"]." readonly><br><br>";
			echo "Country:<br> <input type=text name=country value =".$row["Country"]." readonly><br><br>";
			echo "Birthdate:<br> <input type=text name=birthdate value =".$row["BirthDate"]." readonly><br><br>";
			}
		}

		while ($row = $result_admin->fetch_array(MYSQLI_ASSOC))
		{
			if ($row['UserType'] != "Learner"){
				echo "Username:<br> <input type=text name=username value =".$row["Username"]." readonly><br> <br>";
			echo "First Name:<br> <input type=text name=firstName value =".$row["FirstName"]." readonly><br><br>";
			echo "Last Name:<br> <input type=text name=lastName value =".$row["LastName"]." readonly><br><br>";
			echo "Email:<br> <input type=text name=email value =".$row["Email"]." readonly><br><br>";
			echo "Phone number:<br> <input type=text name=phoneNumber value =".$row["PhoneNumber"]." readonly><br><br>";
			echo "Country:<br> <input type=text name=country value =".$row["Country"]." readonly><br><br>";
			echo "Birthdate:<br> <input type=text name=birthdate value =".$row["BirthDate"]." readonly><br><br>";
			}
		}

		?>

	</form>

</body>
</html>