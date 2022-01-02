<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();

$user = $_SESSION['UserID'];

echo"<form action='OrderSearch.php' method='post'> 
  <input type='text' placeholder='Search Order' name='searchOrder' required> 
  <input type='submit' value='Search'>  </form>";

//------------------------------ Get all orders ------------------------------ 
$query1="SELECT Distinct o1.orderID
FROM courses c
JOIN ordercourses o2 ON o2.CourseID =c.CourseID
JOIN orders o1 ON o1.orderID=o2.orderID;";

$result_1=$conn->query($query1);

if(!$result_1){
  die ("Error. $query1");
}

echo "<table border=1>
    
<th>Order ID</th>";
// <th>User</th> 
// <th>Title</th>";
while($rows = $result_1->fetch_array(MYSQLI_ASSOC)) {
  foreach($rows as $row)
  ?>
    <tr>
    <td> <a href=orderDetails.php?id=<?php echo $row ?> > <?php echo $row ?></a></td>
    </tr>
  <?php
}
?>
