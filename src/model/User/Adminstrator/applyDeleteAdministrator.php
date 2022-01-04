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
        
        //---------------------- Delete current Administrator ----------------------
        $query = "delete from users where UserID= '".$_POST["UserID"]."'";
        $results = $conn-> query($query);

        if(!$results)
            die("Fatal error in executing the delete $query");
        else
            echo "Successfully deleted.....".$query;
            
        header("Location: viewAdministrators.php");
    ?>
	
</body>
</html>