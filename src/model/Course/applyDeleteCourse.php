<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Apply Delete Course</title>
</head>

<body>
    <?php
       include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
        establishConnection();

        //---------------------- Delete current Administrator ----------------------
        $query = "delete from courses where CourseID =".$_POST["id"];
        $results = $conn-> query($query);

        if(!$results)
            die("Fatal error in executing the delete $query");
        else
            echo "Successfully deleted.....".$query;
            
        header("Location: /IS3-Online-Tutoring/src/view/viewTutorCourses.php");
    ?>
	
</body>
</html>