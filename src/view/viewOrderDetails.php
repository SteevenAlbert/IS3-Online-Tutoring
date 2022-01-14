<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$get_id=$_GET['id'];

$query = "SELECT * FROM ORDERS WHERE OrderID = ".$get_id;
$order =$conn->query($query);


while ($row = $order->fetch_array(MYSQLI_ASSOC))
{
  // Get order info
  echo "<b> Order Reference number: ".$row["orderID"]."</b><br>";
  echo getUsername($row["UserID"])."<br>";
  echo "Amount: ".$row["Amount"]."<br>";
  echo "Total: ".$row["Total"]."<br>";
  echo $row["OrderTime"]."<br>";

  // Get order courses
  $getOrderQuery = "SELECT * FROM orderCourses as o, courses as c 
  WHERE o.CourseID = c.CourseID AND o.orderID =".$row["orderID"];
  $orderResult =$GLOBALS['conn']->query($getOrderQuery);

  try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

  echo "<table border = 1>";
  echo "<tr> <th> Code </th>  <th> Title </th>  <th> Category </th>   
  <th> Created By </th> <th> Description </th> <th> Hours </th> <th> Level </th> <th> Price </th>  </tr>";
  while ($orderCourses = $orderResult->fetch_array(MYSQLI_ASSOC))
  {
    echo "<tr>";
    echo "<td>". $orderCourses['Code'] ."</td>";
    echo "<td>". $orderCourses['Title'] ."</td>";
    echo "<td>". $orderCourses['Categories'] ."</td>";
    echo "<td>". getUsername($orderCourses['CreatedBy']) ."</td>";
    echo "<td>". $orderCourses['Description'] ."</td>";
    echo "<td>". $orderCourses['Hours'] ."</td>";
    echo "<td>". $orderCourses['Level'] ."</td>";
    echo "<td>". $orderCourses['Price'] ."</td>";
    echo "</tr>";
  }
  echo "</table>";
}

echo "<br>";

?>