<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();

$user = $_SESSION['UserID'];

//------------------------------ Get all orders ------------------------------ 
$query1="SELECT  o1.orderID,  
o1.UserID,c.title 
FROM courses c
JOIN ordercourses o2 ON o2.CourseID =c.CourseID
JOIN orders o1 ON o1.orderID=o2.orderID;";

$result_1=$conn->query($query1);

echo "<table border=1>
    
<th>Order ID</th> 
<th>User</th> 
<th>Title</th>";
while($row1 = $result_1->fetch_array(MYSQLI_ASSOC)) {
  ?>
    <tr>
    <td><?php echo$row1["orderID"]?></td>
    <td><?php echo getUsername($row1["UserID"])?> </td>
    <td><?php echo$row1["title"]?></td>
    </tr>
  <?php
}
?>
