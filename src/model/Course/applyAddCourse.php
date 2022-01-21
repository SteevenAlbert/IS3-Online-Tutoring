<!doctype html>
<html>
<head>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">


<meta charset="utf-8">
<title> Apply Add Course</title>
</head>

<body>
<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
session_start();

	class applyAdd{
		public $code;
		public $title;
		public $description;
		public $hours;
		public $level;
		public $price;
		public $approved;
		public $createdBy;
		public $categories;
		
		function insert(){
			//------------------------ Add Course ------------------------
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
			
			$category = $_POST['category'];
			filterString($category);
			
			
			
			$conn = new mysqli("localhost","root","","is3 online tutoring");
			if($conn->connect_error)
				throw new Exception("Cannot connect to database");
			
			$sql = "INSERT INTO courses ( code, title, description,hours, level, price, approved,createdBy,categories) VALUES (
					'".$code."',
					'".$title."',
					'".$description."',
					'".$hours."',
					'".$level."',
					'".$price."',
					0,
					'".$_SESSION['UserID']."',
					'".$category."')";
			
			if(!$conn->query($sql)){
				throw new Exception($sql);
			}
			$conn->close();
		}
	}

	//--------------------------------- Create Object ---------------------------------

	$applyAdd=new applyAdd();
	$applyAdd->insert();
	header("Location:/IS3-Online-Tutoring/src/public/home.php");
?>	
</body>
</html>