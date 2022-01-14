<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>View administrators</title>
</head>
<body>

	<table border = 1>
	<tr>
		<th> Username </th>
		<th> First Name </th>
		<th> Last Name</th>
		<th> View </th>
		<th> Delete </th>
	</tr>

	<?php
	
	establishConnection();

	//------------------------------ Get all administrators ---------------------------------------
	$query = "select * from users where userType = 'administrator'";
	$results = $conn->query($query);
	try{
		if (!$results){
			throw new Exception("Error Occured"); 
		}
					
	}catch(Exception $e){  
	   echo"Message:", $e->getMessage();  
	}

	while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
	?>

	<tr>
		<td> <?php echo $row["Username"] ?> </td>
		<td> <?php echo $row["FirstName"] ?> </td>
		<td> <?php echo $row["LastName"] ?> </td>
		<td> <a href =/IS3-Online-Tutoring/src/view/viewUser.php?id=<?php echo $row["UserID"] ?> > View </a> </td>
		<td> <a href =/IS3-Online-Tutoring/src/model/User/deleteUser.php?id=<?php echo $row["UserID"] ?> > Delete </a> </td>
	</tr>


	<?php
	}
	?>

	</table>

</body>
</html>