<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();
?>

<form method ="post" action = "" enctype="multipart/form-data">
<h2>Course Overview</h2>
<input type="file" name="CourseOverview" id="CourseOverview"> <br> <br>
<h2>Course Thumbnail</h2>
<input type="file" name="Thumbnail" id="Thumbnail"> <br> <br>
<input type="submit" name="submit">
</form>
<br>
<form method="post">
<h2>Chapters Contents</h2>
<input type="text" name="chapterTitle">
<input type="submit" name = "addChapter" value="Add Chapter">
</form>

<?php
//VIEW CHAPTERS
    $id = $_GET["id"];
    $query = "SELECT * FROM coursechapters WHERE courseID= '$id'";
    if(!$conn->query($query))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
    $result = $conn->query($query);
    $chaptersCount=0;
    while($row =$result->fetch_array(MYSQLI_ASSOC)){
        $chaptersCount+=1;
        $title=  $row['Title'];
        echo "<a href=chapterContent.php?id=$id&ch=$chaptersCount>Chapter $chaptersCount: $title </a>"; 
        echo "<br>";
}

//Add Chapter
if(isset($_POST["addChapter"])){
    $chaptersCount+=1;
    $title = $_POST['chapterTitle'];
    $query = "INSERT INTO coursechapters(courseID, chapter, Title)
                VALUES ('$id', '$chaptersCount+1', '$title' )";
    if(!$conn->query($query))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
    header('Location: addCourseContent.php?id='.$id);
}



if(isset($_POST["submit"])){
    //Upload Course Overview
    if($_FILES["CourseOverview"]["size"]!=0){
        //Check if it already exists and update it if it does exist
        $fileName = time() .'_'.$_FILES['CourseOverview']['name'];
        $TempImageName = $_FILES['CourseOverview']['tmp_name'];
        $target='CoursesContent/Videos/'. $fileName;
        $id = $_GET["id"];
        $query = "SELECT Overview FROM courses WHERE ID =".$_GET['id'];
        if(!$conn->query($query))
            echo mysqli_errno($conn).": " .mysqli_error($conn);
        $result = $conn->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if($row['Overview']!=null){
            $deleteTarget='CoursesContent/Videos/'.$row['Overview'];
            $query = "UPDATE courses SET Overview='$fileName' WHERE ID =".$_GET['id'];
            if(!$conn->query($query))
            echo mysqli_errno($conn).": " .mysqli_error($conn);
            else{
                echo "Course Overview Updated\n"; 
                echo "<br>";
                echo "<a href=home.php>CONTINUE</a>";
                unlink($deleteTarget);
                move_uploaded_file($TempImageName, $target);
            }
        }else{
            $query = "UPDATE courses SET Overview='$fileName' WHERE ID =".$_GET['id'];
            if(!$conn->query($query))
            echo mysqli_errno($conn).": " .mysqli_error($conn);
            else{
                echo "Course Overview uploaded\n"; 
                echo "<br>";
                echo "<a href=home.php>CONTINUE</a>";
                move_uploaded_file($TempImageName, $target);
            }
}
    }

    if($_FILES["Thumbnail"]["size"]!=0){
        $fileName = time() .'_'.$_FILES['Thumbnail']['name'];
        $TempImageName = $_FILES['Thumbnail']['tmp_name'];
        $target='CoursesContent/Thumbnails/'. $fileName;
        $result = move_uploaded_file($TempImageName, $target);
        $id = $_GET["id"];

      

        $query = "INSERT INTO coursematerials (courseID, type, url)
                VALUES ('$id', 'Thumbnail', '$fileName')";
       if(!$conn->query($query))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
        else{
            echo "Course Overview uploaded\n"; 
            echo "<br>";
        }
    }

}
?>