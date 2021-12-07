 <?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

$getCoursesQuery = "SELECT * FROM courses";

$result = $conn->query($getCoursesQuery);


if (!$result)
 die ("Query error. $getUserQuery");

if($_SESSION["UserType"]=="Learner"){
echo "<table border=1 >
      
        <th>Code</th> 
        <th>Title</th> 
        <th>Description</th> 
        <th>Hours</th>  
        <th>Level</th>  
        <th>Price</th>  
        <th>Instructor</th>
        <th>Add</th> </tr>";
        
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    ?>
     <tr>
     <td><?php echo$row["Code"]?></td>
     <td><?php echo$row["Title"]?> </td>
     <td><?php echo$row["Description"]?> </td>
     <td><?php echo$row["Hours"]?> </td>
     <td><?php echo$row["Level"]?></td>
     <td><?php echo$row["Price"]?></td>
     <td><?php echo$row["CreatedBy"]?></td>
     <td><a href=ViewCourses.php?id=<?php echo $row['ID']?>>Add To Cart</a> </td>
     </tr>
  <?php
}
echo "</table>";
}else if($_SESSION["UserType"]=="Tutor"){
    echo "<table border=1 >
        <th>Code</th> 
        <th>Title</th> 
        <th>Description</th> 
        <th>Hours</th>  
        <th>Level</th>  
        <th>Price</th>  
        <th>Instructor</th> </tr>";
        while($row = $result->fetch_assoc()) {
            ?>
            
             <tr>
             <td><?php echo$row["Code"]?></td>
             <td><?php echo$row["Title"]?> </td>
             <td><?php echo$row["Description"]?> </td>
             <td><?php echo$row["Hours"]?> </td>
             <td><?php echo$row["Level"]?></td>
             <td><?php echo$row["Price"]?></td>
             <td><?php echo$row["CreatedBy"]?></td>
             <td> <a href=editCourse.php?id=<?php echo $row['ID'] ?> > Edit</a></td>
            <td> <a href=deleteCourse.php?id=<?php echo $row['ID'] ?> >Delete</a></td>
             </tr>
<?php
}
echo "</table>";
}else if($_SESSION["UserType"]=="administrator"){
    echo "<table border=1 >
        <th>Code</th> 
        <th>Title</th> 
        <th>Description</th> 
        <th>Hours</th>  
        <th>Level</th>  
        <th>Price</th>  
        <th>Instructor</th> 
        <th>Edit</th>
        <th>Delete</th>
        <th>Approve</th></tr>";
    echo "<form method = 'post' action = 'approveCourse.php'>";
        
        while($row = $result->fetch_assoc()) {
            ?>
            
             <tr>
             <td><?php echo$row["Code"]?></td>
             <td><?php echo$row["Title"]?> </td>
             <td><?php echo$row["Description"]?> </td>
             <td><?php echo$row["Hours"]?> </td>
             <td><?php echo$row["Level"]?></td>
             <td><?php echo$row["Price"]?></td>
             <td><?php echo$row["CreatedBy"]?></td>
             <td> <a href=editCourse.php?id=<?php echo $row['ID'] ?> > Edit</a></td>
            <td> <a href=deleteCourse.php?id=<?php echo $row['ID'] ?> >Delete</a></td>
            <td> <input type = "checkbox" value = <?php echo$row["Code"]?> name = "courses[]"></td>
             </tr>
<?php
}
echo " <button> Approve </button> </form>";
echo "</table>";
}

function myFunction($conn) {
    $x = $_GET["id"];
    $user = $_SESSION['username'];
    $query1= "insert into cart (UserName) values ('$user')";
    $query2= "insert into cartcourses (UserName, ID ) values ('$user','$x')";

    $result1 = mysqli_query($conn,$query1);
    $result2 = mysqli_query($conn,$query2);
    if(!$result1 && !$result2){
        echo"cannot execute query";
    }
}
if (isset($_GET['id'])) {
    myFunction($conn);
}

?>

  <!-- <script>
      function loadmessage() {
          alert('Course is added succesfully')
        } 
  </script>   -->
