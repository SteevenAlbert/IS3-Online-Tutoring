<?php 
session_start();
include_once "Menu.php";
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Course</title>
</head>
	
<body>
	<form method = "post" action="applydeleteCourse.php">
	 <?php 
		$conn = new mysqli("localhost","root","","is3 online tutoring");
        if($conn->connect_error)
            die("Fatal Error - cannot connect to the Database");

            $query = "SELECT * FROM courses WHERE id = " .$_GET["id"];


            $results = $conn-> query($query);

            if(!$results)
                die("Fatal error in executing the delete");


            while($row = $results->fetch_array(MYSQLI_ASSOC)) {

                echo "<input type = hidden name = id value=".$row["ID"]." readonly><br>";
                echo "Code:<br> <input type = text name = code value=\"".$row["Code"]."\" readonly><br>";
                echo "Title:<br> <input type = text name = title value=".$row["Title"]." readonly><br>";
				echo "Description:<br> <input type = text name = description value=".$row["Description"]." readonly></textarea><br>";
                echo "Hours:<br> <input type = text name = hours value=\"".$row["Hours"]."\" readonly><br>";
                echo "Level:<br> <input type = text name = level value=".$row["Level"]." readonly><br>";
				echo "Price:<br> <input type = text name = price value=".$row["Price"]." readonly><br>";
                echo "Approved:<br> <input type = checkbox name = approved value=\"".$row["Approved"]."\" readonly><br>";
                echo "Created By:<br> <input type = text name = createdby value=".$row["CreatedBy"]." readonly><br><br>";
            }
         ?>
         <!-- <input type="submit" name="Delete"> -->
         <button type="delete"
                onclick="if (!confirm('Are you sure you want to delete this Course?')) 
                { return false }">
                <? header("Location:ViewCourses.php");?>
           
        Delete </button>
	</form>
</body>
</html>