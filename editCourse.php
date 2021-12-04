<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Courses</title>
</head>

<body>
	<form method="POST" action="applyEditCourse.php">
	<?php	
		$conn = new mysqli("localhost","root","","is3 online tutoring");
        if($conn->connect_error)
            die("Fatal Error - cannot connect to the Database");
		
		$query = "SELECT * FROM courses WHERE ID =" .$_GET["id"];
        $results = $conn-> query($query);
		
		if(!$results)
        die("Fatal error in executing the edit");
		
		 while($row = $results->fetch_array(MYSQLI_ASSOC)) {
			$ID=$row["ID"]; 
			$code=$row["Code"];
			$Title=$row["Title"];
			$Description=$row["Description"];
			$Hours=$row["Hours"];
			$Level=$row["Level"];
			$Price=$row["Price"];
			$Approved=$row["Approved"];
			$CreatedBy=$row["CreatedBy"];

           echo "<input type = hidden name=id value = $ID><br>";
           echo "Code:<br> <input type = text name=code value = $code><br>";
           echo "Title:<br> <input type = text name=title value = $Title><br>";
		   echo "Description:<br> <input type = text name=description value = $Description><br>";
		   echo "Hours:<br> <input type = text name=hours value = $Hours><br>";
		   echo "Level:<br> <input type = text name=level value = $Level><br>";
		   echo "Price:<br> <input type = text name=price value = $Price><br>";
		   echo "Approved:<br> <input type = checkbox name=approved value = $Approved><br>";
		   echo "Created By:<br> <input type = text name=createdby value = $CreatedBy readonly> <br><br>"; 
         }
	?>	
		<a href="applyEditCourse.php">
        <button>Submit</button>
    </a>
	</form>
	
</body>
</html>