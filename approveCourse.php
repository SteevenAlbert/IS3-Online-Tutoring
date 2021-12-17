<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

$getCoursesQuery = "SELECT * FROM courses where Approved='1'";

$result = $conn->query($getCoursesQuery);

if (!$result)
 die ("Query error. $getUserQuery");

 else{
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
        <th>Delete</th></tr>";

            while($row = $result->fetch_assoc()) {
                ?>
                <?php
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
                 </tr>
            <?php
            }
        
      }
        
    

?>