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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../CSS/view.css">
<link rel="stylesheet" href="../../CSS/home.css">

<!DOCTYPE html>
<html>
<head>
	<title>View Administrators</title>
</head>
<body>
	<div class="BannerText">
		<h1 style="padding-left:300px;">View Administrators</h1>
	</div>

	<table class="table table-hover">
		<thead style="background-color:#89CFF0">
			<tr>
				<th> Username </th>
				<th> First Name </th>
				<th> Last Name</th>
				<th> View </th>
				<th> Delete </th>
			</tr>	
		<thead>

	<?php
	
	establishConnection();
	isAdmin();

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
	<tbody >
		<tr>
			<td> <?php echo $row["Username"] ?> </td>
			<td> <?php echo $row["FirstName"] ?> </td>
			<td> <?php echo $row["LastName"] ?> </td>
			<td> <a href =/IS3-Online-Tutoring/src/view/viewUser.php?id=<?php echo $row["UserID"] ?> class="btn btn-primary" style="background-color:green"> View </a> </td>
			<td> <a href =/IS3-Online-Tutoring/src/model/User/deleteUser.php?id=<?php echo $row["UserID"] ?> class="btn btn-danger" > Delete </a> </td>
		</tr>
	</tbody>

	<?php
	}
	?>

	</table>

</body>
</html>