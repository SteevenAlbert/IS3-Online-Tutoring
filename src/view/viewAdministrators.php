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


<link rel="stylesheet" href="../../CSS/view.css">

<!DOCTYPE html>
<html>
<head>
	<title>View Administrators</title>
</head>
<body>
	<div class="page-title">
		<h1>View Administrators</h1>
	</div>

	<table class="table table-hover">
		<thead>
			<tr>
				<th> Username </th>
				<th> First Name </th>
				<th> Last Name</th>
				<th> View/Delete </th>
			</tr>	
		<thead>

	<?php
	
	establishConnection();
	isAdmin();

	//------------------------------ Get all administrators ---------------------------------------
	$query = "select * from users where userType = 'administrator'";
	$results = $conn->query($query);
	if (!$results){
		throw new Exception($query); 
	}

	while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
	?>
	<tbody >
		<tr>
			<td> <?php echo $row["Username"] ?> </td>
			<td> <?php echo $row["FirstName"] ?> </td>
			<td> <?php echo $row["LastName"] ?> </td>
			<td> <a href =viewAdministrator.php?id=<?php echo $row["UserID"] ?> class="btn btn-primary" style="background-color:green"> View/Delete </a> </td>
		</tr>
	</tbody>

	<?php
	}
	?>

	</table>

</body>
</html>