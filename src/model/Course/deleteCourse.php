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


<?php 
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
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
        establishConnection();

        isAdminOrTutor();

        //----------------------------- Display course to delete details -----------------------------
        $query = "SELECT * FROM courses WHERE CourseID = " .$_GET["id"];
        $results = $conn-> query($query);

        if(!$results)
            throw new Exception($query);


        while($row = $results->fetch_array(MYSQLI_ASSOC)) {

            echo "<input type = hidden name = id value=".$row["CourseID"]." readonly><br>";
            echo "Code:<br> <input type = text name = code value=\"".$row["Code"]."\" readonly><br>";
            echo "Title:<br> <input type = text name = title value=".$row["Title"]." readonly><br>";
            echo "Description:<br> <input type = text name = description value=".$row["Description"]." readonly></textarea><br>";
            echo "Hours:<br> <input type = text name = hours value=\"".$row["Hours"]."\" readonly><br>";
            echo "Level:<br> <input type = text name = level value=".$row["Level"]." readonly><br>";
            echo "Price:<br> <input type = text name = price value=".$row["Price"]." readonly><br>";
            echo "Created By:<br> <input type = text name = createdby value=".$row["CreatedBy"]." readonly><br><br>";
        }
    ?>

    <!-- Get deletion confirmation -->
        <button type="delete"
            onclick="if (!confirm('Are you sure you want to delete this Course?')) 
            { return false }">
            <? header("Location:pendingCourses.php");?>
        
    Delete </button>
	</form>
</body>
</html>