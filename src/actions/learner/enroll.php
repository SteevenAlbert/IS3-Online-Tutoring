<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$user = $_SESSION['UserID'];
//------------------------------- Get cart courses -------------------------------
$sql="SELECT CourseID FROM cartcourses c where c.UserID='$user'";
$sql_delete2="DELETE FROM cartcourses WHERE UserID='$user'";
     
// Insert into orders
$query3= "INSERT INTO orders (UserID, OrderTime, Amount, Total) 
VALUES ('$user', now(), ".$_POST['amount'].",". $_POST['total'].")";
$result3 = mysqli_query($conn,$query3);

if(!$result3){
    die ("Error. $query3");
  }


$result_sql=$conn->query($sql);
$result_delete2=$conn->query($sql_delete2);
$counter=0;
while($rows = $result_sql->fetch_array(MYSQLI_ASSOC)){   
    foreach($rows as $row){
        $query1="INSERT INTO enroll(UserID,CourseID,EnrollDate,Done) VALUES ('$user',$row,NOW(),0)";
        $result1=mysqli_query($conn,$query1);
        $query4= "INSERT INTO ordercourses (orderID,CourseID)
        SELECT o.orderID,c.CourseID
        FROM courses c, orders o WHERE c.CourseID =$row and o.orderID=LAST_INSERT_ID();";
        $result4 = mysqli_query($conn,$query4);

    }
}

header("Location:/IS3-Online-Tutoring/src/view/viewEnrolledCourses.php");



?>