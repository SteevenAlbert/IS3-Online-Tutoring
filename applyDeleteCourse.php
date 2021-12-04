<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Apply Delete Course</title>
</head>

<body>
        <?php
		$conn = new mysqli("localhost","root","","is3 online tutoring");
        if($conn->connect_error)
            die("Fatal Error - cannot connect to the Database");

            $query = "delete from courses where ID =".$_POST["id"];

            $results = $conn-> query($query);

            if(!$results)
                die("Fatal error in executing the delete $query");

            else
                echo "Successfully deleted.....".$query;
            	
          header("Location: viewCourses.php");
        ?>
	
</body>
</html>