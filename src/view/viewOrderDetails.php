<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../CSS/orderDetails.css">


<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isAdmin();

$get_id=$_GET['id'];

$query = "SELECT * FROM ORDERS WHERE OrderID = ".$get_id;
$order =$conn->query($query);


while ($row = $order->fetch_array(MYSQLI_ASSOC))
{
  // Get order info
  ?>
  <div class="details-title"><h2>Order Details</h2></div>
    <div class="block">
        <h3> Order Reference number:<?php echo $row["orderID"]?></h3>
        <h4><?php echo getUsername($row["UserID"])?></h4>
        <h4> Amount:<?php echo $row["Amount"]?></h4>
        <h4>Total:<?php echo $row["Total"]?></h4>
</div>

  <?php

  // Get order courses
  $getOrderQuery = "SELECT * FROM orderCourses as o, courses as c 
  WHERE o.CourseID = c.CourseID AND o.orderID =".$row["orderID"];
  $orderResult =$GLOBALS['conn']->query($getOrderQuery);

  try{
    if (!$orderResult){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
?>
<div class="table1"></div>
  <table class="table table-hover  table-striped">
  <tr> <th> Code </th>  <th> Title </th>  <th> Category </th>   
  <th> Created By </th> <th> Description </th> <th> Hours </th> <th> Level </th> <th> Price </th>  </tr>
<?php
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
  
  ?>
   </table>
  </div>
  <?php
}

echo "<br>";

?>