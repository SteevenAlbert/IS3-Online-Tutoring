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

$id = $_GET['id'];
$chapter = $_GET['ch'];

/*---------------------------VIEW ADDED CONTENT--------------------------------*/
$query = "SELECT * FROM chaptermaterials WHERE CourseID=$id AND chapter=$chapter";
if(!$conn->query($query))
    echo mysqli_errno($conn).": " .mysqli_error($conn);

?>
<table border=1>
    <tr>
        <th> Title </th>
        <th> Description </th>
        <th> courseID </th>
        <th> Chapter </th>
        <th> resourceID </th>
        <th> url </th>
        <th> Edit </th>
        <th> Delete </th>
    </tr>
<?php
$result = $conn->query($query);
while($row= $result->fetch_array(MYSQLI_ASSOC)){
?>
    <tr>
        <td><?php echo $row['Title'] ?> </td>
        <td><?php echo $row['Description'] ?> </td>
        <td><?php echo $row['CourseID'] ?> </td>
        <td><?php echo $row['chapter'] ?> </td>
        <td><?php echo $row['resourceID'] ?> </td>
        <td><?php echo $row['url'] ?> </td>
        <td> <a href=/IS3-Online-Tutoring/src/model/Course/editResource.php?id=<?php echo $row['resourceID']?>>Edit</td> 
        <td> <a href=/IS3-Online-Tutoring/src/model/Course/deleteResource.php?id=<?php echo $row['resourceID']?>>Delete</td> 
    </tr>         
<?php
}
?>
</table>


<!---------------------------ADD NEW CONTENT---------------------------->
<form method ="post" action = "" enctype="multipart/form-data">
<h2>Add Lesson</h2>
Title:<br> <input type="text" name="videoTitle" id="videoTitle"> <br>
Description:<br> <textarea rows=4 cols=20  name=description></textarea><br><br>
<input type="file" name="Lesson" id="Lesson"> <br> <br>
<input type="submit" name="addLesson" value="Upload">
</form>


<?php
//Add a Video Lesson to a chapter 
if(isset($_POST['addLesson'])){
    $title= $_POST['videoTitle'];
    $description =$_POST['description'];
    if($_FILES["Lesson"]["size"]!=0){
        $fileName = time().'_'.$_FILES['Lesson']['name'];
        $TempName = $_FILES['Lesson']['tmp_name'];
        $target='/xampp/htdocs/IS3-Online-Tutoring/resources/CoursesContent/Videos/'. $fileName;
        $query = "INSERT INTO chaptermaterials(Title, Description, courseID, chapter, url, type)
        VALUES('$title','$description','$id','$chapter','$fileName','Video' )";
        if(!$conn->query($query))
         echo mysqli_errno($conn).": " .mysqli_error($conn);
        else{
        move_uploaded_file($TempName, $target);
        header('Location: addChapterContent.php?id='.$id.'&ch='.$chapter);
        }
    }
}
?>


<form method="post">
<h2>Add Document</h2>
Title:<br> <input type="text" name="videoTitle" id="videoTitle"> <br>
Description:<br> <textarea rows=4 cols=20  name=description></textarea><br><br>
<input type="file" name="CourseOverview" id="CourseOverview"> <br> <br>
<input type="submit" name="addDocument" value="Upload">
<br>
</form>