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

$id = $_GET['id'];
$chapter = $_GET['ch'];

/*---------------------------VIEW ADDED CONTENT--------------------------------*/
$query = "SELECT * FROM chaptermaterials WHERE CourseID=$id AND chapter=$chapter";
$result = $conn->query($query);

if(!$result)
    throw new Exception($query);

?>
<table class="table table-hover table-bordered">
<thead>
    <tr>
        <th class="text-center"> Title </th>
        <th class="text-center"> Description </th>
        <th class="text-center"> courseID </th>
        <th class="text-center"> Chapter </th>
        <th class="text-center"> resourceID </th>
        <th class="text-center"> url </th>
        <th class="text-center"> Edit </th>
        <th class="text-center"> Delete </th>
    </tr>
</thead>
<?php

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

<div class = "col-lg-6">
<img src="/IS3-Online-Tutoring/resources/images/books.png"  width="550" height="550">

</div>

<div class = "col-lg-4">

<!---------------------------ADD NEW CONTENT---------------------------->
<form method ="post" action = "" enctype="multipart/form-data">
<h2>Add Lesson</h2>
Title:<br> <input class="form-control" type="text" name="videoTitle" id="videoTitle"> <br>
Description:<br> <textarea class="form-control" rows=4 cols=20  name=description></textarea><br><br>
<input type="file" name="Lesson" id="Lesson"> <br> <br>
<input class="btn btn-primary" type="submit" name="addLesson" value="Upload">
</form>


<?php
//Add a Video Lesson to a chapter 
if(isset($_POST['addLesson'])){
    $title= $_POST['videoTitle'];
    filterString($title);

    $description =$_POST['description'];
    filterString($description);

    if($_FILES["Lesson"]["size"]!=0){
        $fileName = time().'_'.$_FILES['Lesson']['name'];
        $TempName = $_FILES['Lesson']['tmp_name'];
        $target='/xampp/htdocs/IS3-Online-Tutoring/resources/CoursesContent/Videos/'. $fileName;
        
        $query = "INSERT INTO chaptermaterials(Title, Description, courseID, chapter, url, type)
        VALUES('$title','$description','$id','$chapter','$fileName','Video' )";
        
        if(!$conn->query($query))
            throw new Exception($query);
        else{
            move_uploaded_file($TempName, $target);
            header('Location: addChapterContent.php?id='.$id.'&ch='.$chapter);
        }
    }
}
?>


<form method="post">
<h2>Add Document</h2>
Title:<br> <input class="form-control" type="text" name="videoTitle" id="videoTitle"> <br>
Description:<br> <textarea class="form-control" rows=4 cols=20  name=description></textarea><br><br>
<input type="file" name="CourseOverview" id="CourseOverview"> <br> <br>
<input class="btn btn-primary" type="submit" name="addDocument" value="Upload">
<br>
</form>

</div>