<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();


$id = $_GET['id'];
$chapter = $_GET['ch'];

//------------------------------------ Display chapter materials ------------------------------------
$query = "SELECT * FROM chaptermaterials WHERE CourseID= '$id'";
if(!$conn->query($query))
    echo mysqli_errno($conn).": " .mysqli_error($conn);

?>

<!------------------------------------ Add lesson ------------------------------------>
<form method ="post" action = "" enctype="multipart/form-data">
    <h2>Add Lesson</h2>
    Title:<br> <input type="text" name="videoTitle" id="videoTitle"> <br>
    Description:<br> <textarea rows=4 cols=20  name=description></textarea><br><br>
    <input type="file" name="Lesson" id="Lesson"> <br> <br>
    <input type="submit" name="addLesson" value="Upload">
</form>


<?php
// Add a Video Lesson to a chapter 
if(isset($_POST['addLesson'])){
    $title= $_POST['videoTitle'];
    $description =$_POST['description'];
    
    if($_FILES["Lesson"]["size"]!=0){
        $fileName = time().'_'.$_FILES['Lesson']['name'];
        $TempName = $_FILES['Lesson']['tmp_name'];
        $target='CoursesContent/Videos/'. $fileName;
        $query = "INSERT INTO chaptermaterials(Title, Description, CourseID, chapter, url, type)
        VALUES('$title','$description','$id','$chapter','$fileName','Video' )";
        
        if(!$conn->query($query))
            echo mysqli_errno($conn).": " .mysqli_error($conn);
        else{
            move_uploaded_file($TempName, $target);
            header('Location: chapterContent.php?id='.$id.'&ch='.$chapter);
        }
    }
}
?>

<!------------------------------------ Add Document ------------------------------------>
<form method="post">
    <h2>Add Document</h2>
    Title:<br> <input type="text" name="videoTitle" id="videoTitle"> <br>
    Description:<br> <textarea rows=4 cols=20  name=description></textarea><br><br>
    <input type="file" name="CourseOverview" id="CourseOverview"> <br> <br>
    <input type="submit" name="addDocument" value="Upload">
    <br>
</form>