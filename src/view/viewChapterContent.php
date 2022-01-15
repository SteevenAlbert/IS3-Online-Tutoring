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


echo "<h1>Chapter ".$_GET['ch']."</h1>";
$query = "SELECT * FROM chaptermaterials WHERE courseID=".$_GET['id']." AND chapter=".$_GET['ch'];
    echo "<h2>Videos</h2>";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo "<h3>".$row['Title']."</h3>";
    echo $row['Description']."<br>";
    ?>
    <video width = "480" src="/IS3-Online-Tutoring/resources/CoursesContent/Videos/<?php echo $row['url']?>" controls> </video>
<?php
}
?>
