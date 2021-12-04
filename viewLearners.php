<?php
 session_start();
include_once "Menu.php";
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
	</tr>

	<?php
	include_once "is3library.php";

	establishConnection();

	$query = "select * from users where userType = 'learner'";
	$results = $conn->query($query);

	while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
	?>

	<tr>
		<td> <?php echo $row["Username"] ?> </td>
		<td> <?php echo $row["FirstName"] ?> </td>
		<td> <?php echo $row["LastName"] ?> </td>
		<td> <a href = viewUser.php?id=<?php echo $row["Username"] ?> > View </a> </td>
	</tr>


	<?php
	}
	?>

	</table>

</body>
</html>