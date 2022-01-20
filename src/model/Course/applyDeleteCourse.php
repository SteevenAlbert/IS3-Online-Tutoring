<!doctype html>
<html>
<head>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

<meta charset="utf-8">
<title>Apply Delete Course</title>
</head>

<body>
    <?php
       include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
        establishConnection();

      

        //---------------------- Delete current Administrator ----------------------
        $query = "delete from courses where CourseID =".$_GET["id"];
        $results = $conn-> query($query);

        if(!$results)
            die("Fatal error in executing the delete $query");
        else
            echo "Successfully deleted.....".$query;
            
        header("Location: /IS3-Online-Tutoring/src/view/viewApprovedCourses.php");
    ?>
	
</body>
</html>