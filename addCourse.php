<?php 
session_start();
include_once "Menu.php";
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Course</title>
</head>

<h1>Tutor</h1>
<h3>Add Courses</h3>
	<form  method ="POST" action="applyAddCourse.php">

	<?php	
			include_once "is3library.php";
			establishConnection();
			$query = "SELECT Username FROM users WHERE UserType ='tutor'";
        	$results = $conn-> query($query);
	?>		

<!-- ID:<br> <input type='text' name='id'><br> -->
Code:<br> <input type='text' name='code'><br>
Title:<br> <input type='text' name='title'><br>
Description:<br> <textarea rows=4 cols=20  name=description></textarea><br>
Hours:<br> <input type='text' name='hours'><br>
Level:<br>
	<select name='level'>
	<?php
	$levels=array("Beginner","Intermediate","Hard");
	for($i=0;$i<count($levels);$i++){
	    echo "<option>$levels[$i]</option>";
	    }
	?>
	</select><br>
Price:<br> <input type='text' name='price'><br>
Approved:<br> 
	<input type="checkbox" name="approved"><br>
<!-- Yes:<input type='radio' name='approved[]'><br>
No: <input type='radio' name='approved[]'><br> -->


Created By:
<!-- <input type='text' name='createdBy'><br><br> -->
<select name='createdBy' >
		<?php
			while($row = $results->fetch_array(MYSQLI_ASSOC)) {
				echo "<option>".$row["Username"]."</option>";
			}
			?>
</select><br><br>


	<a href="editCourse.php">
	  <button>Save Course</button>
	</a>
		
	</form>
</body>
</html>