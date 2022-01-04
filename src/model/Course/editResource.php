<?php 
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();
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
        die("Fatal error in executing the edit");
		
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
        $description = $_POST['description'];
        $query = "UPDATE chaptermaterials SET Title='$Title', Description = '$description' WHERE resourceID =".$_GET['id'];
        if(!$conn->query($query))
            echo mysqli_errno($conn).": " .mysqli_error($conn);
        
         //Update Course Material
        if($_FILES["Lesson"]["size"]!=0){
            //Check if it already exists and update it if it does exist
            $fileName = time() .'_'.$_FILES['Lesson']['name'];
            $TempImageName = $_FILES['Lesson']['tmp_name'];
            $target='CoursesContent/Videos/'. $fileName;
            $id = $_GET["id"];
            $query = "SELECT * FROM chaptermaterials WHERE resourceID =".$_GET['id'];
            if(!$conn->query($query))
                echo mysqli_errno($conn).": " .mysqli_error($conn);
            $result = $conn->query($query);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row['url']!=null){
                $deleteTarget='CoursesContent/Videos/'.$row['url'];
                $query = "UPDATE chaptermaterials SET url='$fileName' WHERE resourceID =".$_GET['id'];
                if(!$conn->query($query))
                echo mysqli_errno($conn).": " .mysqli_error($conn);
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
                echo mysqli_errno($conn).": " .mysqli_error($conn);
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