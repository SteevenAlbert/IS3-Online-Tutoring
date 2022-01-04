<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$get_id=$_GET['id'];

$query1="SELECT c.title, u.Username ,o1.orderDate, o1.Amount
FROM courses c
JOIN ordercourses o2 ON o2.courseID =c.courseID
JOIN orders o1 ON o1.orderID=o2.orderID
AND o2.orderID='$get_id'
JOIN users u ON o1.UserID=u.UserID
ORDER BY o2.orderID";

$result_1=$conn->query($query1);

// select username
$query2="SELECT u.Username From users u, orders o WHERE o.orderID='".$_GET["id"]."' AND o.UserID=u.UserID";
$result_2=$conn->query($query2);

if(!$result_1){
    die ("Error. $query1");
  }


if(!$result_2){
    die ("Error. $query2");
  }

$row = $result_2->fetch_array(MYSQLI_ASSOC);
    
    echo "<table border=2 >
    <th> Order ".$_GET["id"]."</th>
    <th>".$row["Username"]."</th>
    </table>";
    echo "<table border=1>
    <th>Course Title</th>
    <th>Order Date</th>
    <th>Amount</th>";
    while($row1 = $result_1->fetch_array(MYSQLI_ASSOC)) {
      ?>
       <tr>
       <td><?php echo$row1["title"]?></td>
       <td><?php echo$row1["orderDate"]?></td>
       <td><?php echo$row1["Amount"]?></td>
       </tr>
    <?php

}

?>