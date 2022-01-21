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
        $query = "delete from users where UserID= '".$_POST["UserID"]."'";
        $results = $conn-> query($query);

        
        if (!$results)
            throw new Exception($query); 
		
        header("Location: /IS3-Online-Tutoring/src/public/home.php");
    ?>
	
</body>
</html>