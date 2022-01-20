<!doctype html>
<html>
<head>
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

<meta charset="utf-8">
<title>Apply Edit Courses</title>
</head>

<body>
	
	<?php
	session_start();
	include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
	establishConnection();
	
		
	//-------------------------------- Update current course --------------------------------
	$query="update courses set Code='".$_POST["code"]."',
	Title='".$_POST["title"]."',
	Description='".$_POST["description"]."',
	Hours='".$_POST["hours"]."',
	Level='".$_POST["level"]."',
	Price='".$_POST["price"]."' where
	CourseID=".$_POST["CourseID"];
	
	$results = $conn-> query($query);
	
	if(!$results)
       die("Fatal error in executing the update statements  $query");		
	else 
		echo "Successfully edited and updated...".$query;
        	
    header("Location: /IS3-Online-Tutoring/src/view/viewCourseDetails.php?id=".$_POST["CourseID"]);
		?>

</body>
</html>