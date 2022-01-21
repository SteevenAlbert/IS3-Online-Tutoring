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
	include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
	establishConnection();
	
		
	//-------------------------------- Update current course --------------------------------
	$code = $_POST["code"];
	filterString($code);

	$title = $_POST["title"];
	filterString($title);

	$description = $_POST["description"];
	filterString($description);

	$hours = $_POST["hours"];
	filterString($hours);

	$level = $_POST["level"];
	filterString($level);

	$price = $_POST["price"];
	filterString($price);

	$courseID = $_POST["CourseID"];
	filterString($courseID);

	$query="update courses set Code='".$code."',
	Title='".$title."',
	Description='".$description."',
	Hours='".$hours."',
	Level='".$level."',
	Price='".$price."' where
	CourseID=".$courseID;
	
	$results = $conn-> query($query);
	
	if(!$results)
		throw new Exception($query);
        	
    header("Location: /IS3-Online-Tutoring/src/view/viewCourseDetails.php?id=".$_POST["CourseID"]);
		?>

</body>
</html>