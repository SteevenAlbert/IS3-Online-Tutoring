<?php
 session_start();
include_once "Menu.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form>

		<?php
		include_once "is3library.php";
		establishConnection();

		//------------------------------ Get user info ---------------------------------------

		//query for learners(profile picture)
		$query = "SELECT u.*, l.profile_picture from users u, learners l where u.UserID = '".$_GET["id"]."' AND u.UserID=l.UserID";
		$result = $conn->query($query);

		//query for admins
		$query_admin = "SELECT * from users where UserID = '".$_GET["id"]."'";
		$result_admin = $conn->query($query_admin);

		if (!$result) die ("Fatal error in executing query $query");

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