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

			function __construct($code, $title, $description,$hours, $level, $price, $approved,$createdBy){
				$this->code=$code;
				$this->title=$title;
				$this->description=$description;
				$this->hours=$hours;
				$this->level=$level;
				$this->price=$price;
				$this->approved=$approved;
				$this->createdBy=$createdBy;
			}
			function insert(){
			$conn = new mysqli("localhost","root","","is3 online tutoring");
                if($conn->connect_error)
                die("Fatal Error - cannot connect to the Database");
				
				$sql = "INSERT INTO courses ( code, title, description,hours, level, price, approved,createdBy) VALUES (
						'".$_POST['code']."',
						'".$_POST['title']."',
						'".$_POST['description']."',
						'".$_POST['hours']."',
						'".$_POST['level']."',
						'".$_POST['price']."',
						'".$_POST['approved']."',
						'".$_POST['createdBy']."')";
				
				if($conn->query($sql)===TRUE){
					echo "New course created successfully<br>";
				}	 
				else{
					echo "Error:".$sql."<br>".$conn->error;
				}
				$conn->close();
			}
		}
		$code=$_POST['code'];
    	$title=$_POST['title'];
    	$description=$_POST['description'];
    	$hours=$_POST['hours'];
		$level=$_POST['level'];
    	$price=$_POST['price'];
    	$approved=$_POST['approved'];
		$createdBy=$_POST['createdBy'];

		$applyAdd=new applyAdd($code, $title, $description,$hours, $level, $price, $approved,$createdBy);
		$applyAdd->insert();
		header("Location:ViewCourses.php");
           
        
        
	?>	
</body>
</html>