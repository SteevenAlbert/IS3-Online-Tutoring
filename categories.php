<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

$getCoursesQuery = "SELECT * FROM courses GROUP BY Categories";


$result = $conn->query($getCoursesQuery);
while($row = $result->fetch_assoc()) {
    $getCoursesbyCategory = "SELECT * FROM courses where Categories='".$row["Categories"]."'";


$result2 = $conn->query($getCoursesbyCategory);

if (!$result2)
 die ("Query error. $getCoursesbyCategory");

 else{
        echo "<br><br><br>";
        echo "<table border=3 ><th>".$row["Categories"]."</th></table>";
        echo "<table border=2 >
        <th>Code</th> 
        <th>Title</th> 
        <th>Description</th> 
        <th>Hours</th>  
        <th>Level</th>  
        <th>Price</th>  
        <th>Instructor</th></tr>";
    while($row = $result2->fetch_assoc()) {
            
            ?>
            <tr>
            <td> <a href=courseDetails.php?id=<?php echo $row['ID'] ?> > <?php echo$row["Code"]?></a> </td>
             <td><?php echo$row["Title"]?> </td>
             <td><?php echo$row["Description"]?> </td>
             <td><?php echo$row["Hours"]?> </td>
             <td><?php echo$row["Level"]?></td>
             <td><?php echo$row["Price"]?></td>
             <td><?php echo$row["CreatedBy"]?></td>
                    <?php
          
    }
    echo "</table>";
}

    

 }

?>