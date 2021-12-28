<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();

$user = $_SESSION['UserID'];


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Submit1"])){
    //------------------------------- Get enrolled in cart courses -------------------------------
    echo "<h3>courses</h3><br>";
    $sql="SELECT CourseID FROM cartcourses c where c.UserID='$user'";
    $sql_delete2="DELETE FROM cartcourses WHERE UserID='$user'";
         
    // Insert into orders
    $query3= "INSERT INTO orders (UserID)
    SELECT UserID FROM learners WHERE UserID = $user";
    $result3 = mysqli_query($conn,$query3);
    

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

    //------------------------------- Display enrolled courses -------------------------------
    $query2="SELECT Title FROM courses c, enroll e where e.CourseID=c.CourseID AND e.UserID='$user'";
    $result2=mysqli_query($conn,$query2);
    while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
        foreach($rows as $row){
            echo "Course name <input type=text name=title value=\"".$row."\" readonly><br><br>";
        }
         
    } 
 
}
else if(!isset($_POST["Submit1"])){
    //------------------------------- Display enrolled courses -------------------------------
    $query2="SELECT Title FROM courses c, enroll e where e.CourseID=c.CourseID AND e.UserID='$user'";
    $result2=mysqli_query($conn,$query2);

    while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
        foreach($rows as $row)
            echo "Course name <input type = text name = title value=\"".$row."\" readonly><br><br>";
    }
}
?>