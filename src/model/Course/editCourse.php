<?php 
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Courses</title>
</head>

<body>
	<form method="POST" action="applyEditCourse.php">
	<?php	
		establishConnection();
		
		//-------------------------------- Display course details in a form --------------------------------
		$query = "SELECT * FROM courses WHERE CourseID =" .$_GET["id"];
        $results = $conn-> query($query);
		
		if(!$results)
        die("Fatal error in executing the edit");
		
		 while($row = $results->fetch_array(MYSQLI_ASSOC)) {
			$ID=$row["CourseID"]; 
			$code=$row["Code"];
			$Title=$row["Title"];
			$Description=$row["Description"];
			$Hours=$row["Hours"];
			$Level=$row["Level"];
			$Price=$row["Price"];
			$CreatedBy=$row["CreatedBy"];

           echo "<input type = hidden name=id value = $ID><br>";
           echo "Code:<br> <input type = text name=code value = $code><br>";
           echo "Title:<br> <input type = text name=title value = $Title><br>";
		   echo "Description:<br> <input type = text name=description value = $Description><br>";
		   echo "Hours:<br> <input type = text name=hours value = $Hours><br>";
		   echo "Level:<br> <input type = text name=level value = $Level><br>";
		   echo "Price:<br> <input type = text name=price value = $Price><br>";
		   echo "Created By:<br> <input type = text name=createdby value = $CreatedBy readonly> <br><br>"; 
        }
	?>	
        <button>Submit</button>
	</form>
	
</body>
</html>