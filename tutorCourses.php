<?php
 session_start();
 include_once "Menu.php";
 include_once "is3library.php";
 
 establishConnection();

 $getPendingCourses = "SELECT * FROM courses where Approved='0' and CreatedBy='".$_SESSION["username"]."'";
 $result = $conn->query($getPendingCourses);
 
 $getApprovedCourses = "SELECT * FROM courses where Approved='1' and CreatedBy='".$_SESSION["username"]."'";
 $result2 = $conn->query($getApprovedCourses);

if (!$result){
 die ("Query error. $getUserQuery");
}
   else {
    echo "<br><br><br>";
    echo "<table border=3><th>Pending Courses</th></table>";
    echo "<table border=2 >
    <th>Code</th> 
    <th>Title</th> 
    <th>Description</th> 
    <th>Hours</th>  
    <th>Level</th>  
    <th>Price</th>  
    <th>Edit</th>
    <th>Delete</th> </tr>";
    while($row = $result->fetch_assoc()) {
        ?>
        <tr>
         <td><?php echo$row["Code"]?></td>
         <td><?php echo$row["Title"]?> </td>
         <td><?php echo$row["Description"]?> </td>
         <td><?php echo$row["Hours"]?> </td>
         <td><?php echo$row["Level"]?></td>
         <td><?php echo$row["Price"]?></td>
         <td> <a href=editCourse.php?id=<?php echo $row['ID'] ?> > Edit</a></td>
         <td> <a href=deleteCourse.php?id=<?php echo $row['ID'] ?> >Delete</a></td>
         <?php
        }
        echo "</table>";
    }
    
    if (!$result2){
        die ("Query error. $getUserQuery");
       }
          else {
           echo "<br><br><br>";
           echo "<table border=3><th>Approved Courses</th></table>";
           echo "<table border=2 >
           <th>Code</th> 
           <th>Title</th> 
           <th>Description</th> 
           <th>Hours</th>  
           <th>Level</th>  
           <th>Price</th>  
           <th>Edit</th>
           <th>Delete</th> </tr>";
           while($row2 = $result2->fetch_assoc()) {
               ?>
               <tr>
                <td><?php echo$row2["Code"]?></td>
                <td><?php echo$row2["Title"]?> </td>
                <td><?php echo$row2["Description"]?> </td>
                <td><?php echo$row2["Hours"]?> </td>
                <td><?php echo$row2["Level"]?></td>
                <td><?php echo$row2["Price"]?></td>
                <td> <a href=editCourse.php?id=<?php echo $row2['ID'] ?> > Edit</a></td>
                <td> <a href=deleteCourse.php?id=<?php echo $row2['ID'] ?> >Delete</a></td>
                <?php
               }
               echo "</table>";
           }    
?>
