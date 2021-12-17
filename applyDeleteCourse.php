<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Apply Delete Course</title>
</head>

<body>
        <?php
            include_once "is3library.php";
            establishConnection();

            $query = "delete from courses where ID =".$_POST["id"];

            $results = $conn-> query($query);

            if(!$results)
                die("Fatal error in executing the delete $query");

            else
                echo "Successfully deleted.....".$query;
            	
          header("Location: pendingCourses.php");
        ?>
	
</body>
</html>