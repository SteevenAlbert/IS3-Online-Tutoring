 <?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

$getCoursesQuery = "SELECT * FROM courses where Approved='0'";
$getCourses = "SELECT * FROM courses";

$result = $conn->query($getCoursesQuery);
$result3 = $conn->query($getCourses);

if (!$result)
 die ("Query error. $getUserQuery");

else if($_SESSION["UserType"]=="Administrator"){
    echo "<table border=1 >
        <th>Code</th> 
        <th>Title</th> 
        <th>Description</th> 
        <th>Hours</th>  
        <th>Level</th>  
        <th>Price</th>  
        <th>Instructor</th> 
        <th>Categorie</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Approve</th></tr>";
    echo "<form method = 'post' action = ''>";
            

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
             <td><?php echo$row["Categories"]?></td>
             <td> <a href=editCourse.php?id=<?php echo $row['ID'] ?> > Edit</a></td>
             <td> <a href=deleteCourse.php?id=<?php echo $row['ID'] ?> >Delete</a></td>
             <td> <input type = "checkbox" value = <?php echo$row["Code"]?> name = "courses[]"></td>
             </tr>
<?php
        }
}

 echo " <button name='Approve' > Approve </button> </form>";
echo "</table>";




?>
 <?php
    establishConnection();

    if(isset($_POST['Approve'])){
        $_SESSION['courses']=$_POST['courses'];
    while($row = $result3->fetch_assoc()){
       // echo "test";
        for($i=0;$i<count($_SESSION["courses"]);$i++){
            if($_SESSION["courses"][$i]===$row["Code"]){   
            $updatePending="update courses set Approved='1' where Code='".$row["Code"]."'";
            
            $result4=mysqli_query($conn,$updatePending);
            if(!$result4){
                echo $conn->error;
                die("Unable to execute query");
                }
            }
        }
    }
       header("Location:approveCourse.php");
    }
 ?>
  <!-- <script>
      function loadmessage() {
          alert('Course is added succesfully')
        } 
  </script>   -->