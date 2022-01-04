<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();
echo "<h1>Chapter ".$_GET['ch']."</h1>";
$query = "SELECT * FROM chaptermaterials WHERE courseID=".$_GET['id']." AND chapter=".$_GET['ch'];
if(!$conn->query($query))
    echo mysqli_errno($conn).": " .mysqli_error($conn);
    echo "<h2>Videos</h2>";
$result = $conn->query($query);
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo "<h3>".$row['Title']."</h3>";
    echo $row['Description']."<br>";
    ?>
    <video width = "480" src="/IS3-Online-Tutoring/resources/CoursesContent/Videos/<?php echo $row['url']?>" controls> </video>
<?php
}
?>
