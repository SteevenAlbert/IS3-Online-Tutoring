<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Apply Edit Courses</title>
</head>

<body>
	
	<?php
    $conn = new mysqli("localhost","root","","is3 online tutoring");
    if($conn->connect_error)
        die("Fatal Error - cannot connect to the Database");
		
	$query="update courses set Code=\"".$_POST["code"]."\",
	Title=\"".$_POST["title"]."\",
	Description=\"".$_POST["description"]."\",
	Hours=\"".$_POST["hours"]."\",
	Level=\"".$_POST["level"]."\",
	Price=\"".$_POST["price"]."\", 
	Approved=\"".$_POST["approved"]."\", 
	CreatedBy=\"".$_POST["createdby"]."\" where
	ID=".$_POST["id"];
	
	 $results = $conn-> query($query);
	
	 if(!$results)
       die("Fatal error in executing the update statements  $query");	
		
	else 
		echo "Successfully edited and updated...".$query;
        	
    header("Location: viewCourses.php");
		?>

</body>
</html>