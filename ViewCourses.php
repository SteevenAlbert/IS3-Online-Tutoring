<?php
$conn = new mysqli("localhost","root","","is3 online tutoring");
if($conn->connect_error)
    die("Fatal Error - cannot connect to the Database");

$getUserQuery = "SELECT * FROM courses";
if(!$conn->query($getUserQuery))
    echo mysqli_errno($conn).": " .mysqli_error($conn);

$result = $conn->query($getUserQuery);
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
     <td><a href=ViewCourses.php?id=<?php echo $row['ID']?>>Add To Cart</a> </td>
     </tr>
  <?php
}
?>
  </table>
