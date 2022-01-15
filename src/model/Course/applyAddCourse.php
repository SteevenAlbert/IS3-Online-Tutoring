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

		function __construct($code, $title, $description,$hours, $level, $price, $approved,$createdBy,$categories){
			$this->code=$code;
			$this->title=$title;
			$this->description=$description;
			$this->hours=$hours;
			$this->level=$level;
			$this->price=$price;
			$this->approved=$approved;
			$this->createdBy=$createdBy;
			$this->categories=$categories;
		}

		
		function insert(){
			//------------------------ Add Course ------------------------
			$conn = new mysqli("localhost","root","","is3 online tutoring");
			if($conn->connect_error)
			die("Fatal Error - cannot connect to the Database");
			
			$sql = "INSERT INTO courses ( code, title, description,hours, level, price, approved,createdBy,categories) VALUES (
					'".$_POST['code']."',
					'".$_POST['title']."',
					'".$_POST['description']."',
					'".$_POST['hours']."',
					'".$_POST['level']."',
					'".$_POST['price']."',
					'0',
					'".$_SESSION['UserID']."',
					'".$_POST['category']."')";
			
			if($conn->query($sql)===TRUE){
				echo "New course created successfully<br>";
			}	 
			else{
				echo "Error:".$sql."<br>".$conn->error;
			}
			$conn->close();
		}
	}

	//--------------------------------- Create Object ---------------------------------
	$code=$_POST['code'];
	$title=$_POST['title'];
	$description=$_POST['description'];
	$hours=$_POST['hours'];
	$level=$_POST['level'];
	$price=$_POST['price'];
	$createdBy=$_SESSION['UserID'];
	$categories=$_POST['category'];

	$applyAdd=new applyAdd($code, $title, $description,$hours, $level, $price, 0,$createdBy,$categories);
	$applyAdd->insert();
	header("Location:/IS3-Online-Tutoring/src/view/viewTutorCourses.php");
?>	
</body>
</html>