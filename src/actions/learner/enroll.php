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


<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isLearner();

$user = $_SESSION['UserID'];
//------------------------------- Get cart courses -------------------------------
$sql="SELECT CourseID FROM cartcourses c where c.UserID='$user'";
$sql_delete2="DELETE FROM cartcourses WHERE UserID='$user'";

// Insert into orders
$query3= "INSERT INTO orders (UserID, OrderTime, Amount, Total) 
VALUES ('$user', now(), ".$_GET['amount'].",". $_GET['total'].")";
$result3 = mysqli_query($conn,$query3);

if (!$result3){
    throw new Exception($query3); 
}

$result_sql=$conn->query($sql);
if (!$result_sql){
    throw new Exception($sql); 
}


$result_delete2=$conn->query($sql_delete2);
if (!$result_sql){
    throw new Exception($sql_delete2); 
}

$counter=0;
while($rows = $result_sql->fetch_array(MYSQLI_ASSOC)){   
    foreach($rows as $row){
        $query1="INSERT INTO enroll(UserID,CourseID,EnrollDate,Done) VALUES ('$user',$row,NOW(),0)";
        $result1=mysqli_query($conn,$query1);

        if (!$result1){
            throw new Exception($query1); 
        }

        $query4= "INSERT INTO ordercourses (orderID,CourseID)
        SELECT o.orderID,c.CourseID
        FROM courses c, orders o WHERE c.CourseID =$row and o.orderID=LAST_INSERT_ID();";
        $result4 = mysqli_query($conn,$query4);
        if (!$result4){
            throw new Exception($query4); 
        }

    }
}

header("Location:/IS3-Online-Tutoring/src/view/viewEnrolledCourses.php");



?>