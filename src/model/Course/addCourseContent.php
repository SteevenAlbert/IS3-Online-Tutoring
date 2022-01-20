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
establishConnection();

isAdminOrTutor();

?>

<div class = "col-lg-6">
<img src="/IS3-Online-Tutoring/resources/images/books.png"  width="550" height="550">

</div>

<div class = "col-lg-4">

<!-------------------------------------- Course Overview -------------------------------------->
<form method ="post" action = "" enctype="multipart/form-data">
    <h2>Course Overview</h2>
    <input type="file" name="CourseOverview" id="CourseOverview"> <br> <br>
    <h2>Course Thumbnail</h2>
    <input type="file" name="Thumbnail" id="Thumbnail"> <br> <br>
    <input class="btn btn-primary" type="submit" name="submit" value = "Update">
</form>
<br>

<!-------------------------------------- Course Thumbnail -------------------------------------->
<form method="post">
    <h2>Chapters Contents</h2>
    <input class="form-control" type="text" name="chapterTitle">
    <input class="btn btn-primary" type="submit" name = "addChapter" value="Add Chapter">
</form>

<!-------------------------------------- Display Chapters -------------------------------------->
<?php
    $id = $_GET["id"];
    $query = "SELECT * FROM coursechapters WHERE CourseID= '$id'";
    $result = $conn->query($query);
    if(!$result)
        throw new Exception($query);

   
    $chaptersCount=0;
    while($row =$result->fetch_array(MYSQLI_ASSOC)){
        $chaptersCount+=1;
        $title=  $row['Title'];
        echo "<a  href=/IS3-Online-Tutoring/src/model/Course/Chapter/addChapterContent.php?id=$id&ch=$chaptersCount>Chapter $chaptersCount: $title </a>"; 
        echo "<br>";
    }

    //-------------------------------------- Add Chapter --------------------------------------
    if(isset($_POST["addChapter"])){
        $chaptersCount+=1;
        $title = $_POST['chapterTitle'];
        $query = "INSERT INTO coursechapters(CourseID, chapter, Title)
                    VALUES ('$id', '$chaptersCount+1', '$title' )";
        if(!$conn->query($query))
            throw new Exception($query);
            
       
    }

    //-------------------------------------- Upload --------------------------------------
    if(isset($_POST["submit"])){
        
        // Upload Course Overview
        if($_FILES["CourseOverview"]["size"]!=0){
            
            // Check if it already exists and update it if it does exist
            $fileName = time() .'_'.$_FILES['CourseOverview']['name'];
            $TempImageName = $_FILES['CourseOverview']['tmp_name'];
            $target='/xampp/htdocs/IS3-Online-Tutoring/resources/CoursesContent/Videos/'. $fileName;
            $id = $_GET["id"];

            $query = "SELECT Overview FROM courses WHERE CourseID =".$_GET['id'];
            $result = $conn->query($query);
            if(!$result)
                throw new Exception($query);
            
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row['Overview']!=null){
                $deleteTarget='CoursesContent/Videos/'.$row['Overview'];
                $query = "UPDATE courses SET Overview='$fileName' WHERE CourseID =".$_GET['id'];
                if(!$conn->query($query))
                    throw new Exception($query);
                else{
                    echo "Course Overview Updated\n"; 
                    echo "<br>";
                    echo "<a class='btn btn-primary' href=/IS3-Online-Tutoring/src/public/home.php>CONTINUE</a>";
                    unlink($deleteTarget);
                    move_uploaded_file($TempImageName, $target);
                }
            }
            else{
                $query = "UPDATE courses SET Overview='$fileName' WHERE CourseID =".$_GET['id'];
                if(!$conn->query($query))
                    throw new Exception($query);
                else{
                    echo "Course Overview uploaded\n"; 
                    echo "<br>";
                    echo "<a class='btn btn-primary' href=home.php>CONTINUE</a>";
                    move_uploaded_file($TempImageName, $target);
                }
            }
        }


    if($_FILES["Thumbnail"]["size"]!=0){
        $fileName = time() .'_'.$_FILES['Thumbnail']['name'];
        $TempImageName = $_FILES['Thumbnail']['tmp_name'];
        $target='/xampp/htdocs/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/'. $fileName;
        $result = move_uploaded_file($TempImageName, $target);
        $id = $_GET["id"];
        
        $query = "SELECT Thumbnail FROM courses WHERE CourseID =".$_GET['id'];
        if(!$conn->query($query))
            throw new Exception($query);
        $result = $conn->query($query);
        
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if($row['Thumbnail']!=null){
            $deleteTarget='/xampp/htdocs/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/'.$row['Thumbnail'];
            $query = "UPDATE courses SET Thumbnail='$fileName' WHERE CourseID =".$_GET['id'];
            if(!$conn->query($query))
                throw new Exception($query);
            else{
                echo "Thumbnail Overview Updated\n"; 
                echo "<br>";
                echo "<a class='btn btn-primary' href=home.php>CONTINUE</a>";
                unlink($deleteTarget);
                move_uploaded_file($TempImageName, $target);
            }
        }
        else{
            $query = "UPDATE courses SET Thumbnail='$fileName' WHERE CourseID =".$_GET['id'];
            if(!$conn->query($query))
                throw new Exception($query);
            else{
                echo "Thumbnail uploaded\n"; 
                echo "<br>";
                echo "<a class='btn btn-primary' href=home.php>CONTINUE</a>";
                move_uploaded_file($TempImageName, $target);
            }
        }
    }
}
?>

</div>