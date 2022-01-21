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
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
establishConnection();

isAdminOrTutor();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Resource</title>
</head>

<body>
	<form method="POST" action="" enctype="multipart/form-data">
	<?php			
		$query = "SELECT * FROM chaptermaterials WHERE resourceID =" .$_GET["id"];
        $results = $conn-> query($query);
		
		if(!$results)
            throw new Exception($query);
		
		    $row = $results->fetch_array(MYSQLI_ASSOC);
            ?><video width = "480" src="/IS3-Online-Tutoring/resources/CoursesContent/Videos/<?php echo $row['url']?>" controls> </video>
            <?php
			$resourceID=$_GET["id"]; 
			$Title=$row["Title"];
			$Description=$row["Description"];
			$fileName = $row['url'];

           echo "<input type = hidden name=id value = $resourceID readonly><br>";
           echo "Title:<br> <input type = text name=titles value = $Title><br>";
		   echo "Description:<br> <input type = text name=description value = '$Description'><br>";
           echo "filename:<br> <input type = text name=fileaname value =$fileName readonly><br><br>";
           echo "<input type=file name=Lesson> <br> <br>";
           echo "<input type=submit name = submit value=Update>";
	?>			
	</form>
    <?php
    if(isset($_POST["submit"])){
  
        $Title = $_POST['titles'];
        filterString($Title);

        $description = $_POST['description'];
        filterString($description);

        $query = "UPDATE chaptermaterials SET Title='$Title', Description = '$description' WHERE resourceID =".$_GET['id'];
        if(!$conn->query($query))
            throw new Exception($query);
        
         //Update Course Material
        if($_FILES["Lesson"]["size"]!=0){
            //Check if it already exists and update it if it does exist
            $fileName = time() .'_'.$_FILES['Lesson']['name'];
            $TempImageName = $_FILES['Lesson']['tmp_name'];
            $target='CoursesContent/Videos/'. $fileName;
            $id = $_GET["id"];
            
            $query = "SELECT * FROM chaptermaterials WHERE resourceID =".$_GET['id'];
            $result = $conn->query($query);
            if(!$result)
                throw new Exception($query);
            
            
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row['url']!=null){
                $deleteTarget='CoursesContent/Videos/'.$row['url'];
                $query = "UPDATE chaptermaterials SET url='$fileName' WHERE resourceID =".$_GET['id'];
                if(!$conn->query($query))
                    throw new Exception($query);
                else{
                    echo "Material Updated\n"; 
                    echo "<br>";
                    echo "<a href=home.php>CONTINUE</a>";
                    unlink($deleteTarget);
                    move_uploaded_file($TempImageName, $target);
                }
            }else{
                $query = "UPDATE chaptermaterials SET url='$fileName' WHERE ID =".$_GET['id'];
                if(!$conn->query($query))
                    throw new Exception($query);
                else{
                    echo "Material uploaded\n"; 
                    echo "<br>";
                    echo "<a href=home.php>CONTINUE</a>";
                    move_uploaded_file($TempImageName, $target);
                    }
                }
            }
            header('Location: editResource.php?id='.$_GET['id']);
    }
    ?>
</body>
</html>