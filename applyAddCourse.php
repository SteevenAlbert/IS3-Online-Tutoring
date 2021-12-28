<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Apply Add Course</title>
</head>

<body>
<?php

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
					'".$_POST['createdBy']."',
					'".$_POST['categorie']."')";
			
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
	$createdBy=$_POST['createdBy'];
	$categories=$_POST['categorie'];

	$applyAdd=new applyAdd($code, $title, $description,$hours, $level, $price, 0,$createdBy,$categories);
	$applyAdd->insert();
	header("Location:tutorCourses.php");

?>	
</body>
</html>