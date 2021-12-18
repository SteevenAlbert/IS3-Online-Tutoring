<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();

$user = $_SESSION['username'];
//$get_id = $_GET["id"];

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Submit1"])){

    echo "<h3>courses</h3><br>";
    $sql="SELECT ID FROM cartcourses c where c.username='$user'";
    $sql_delete1="DELETE FROM cart WHERE username='$user'";
    $sql_delete2="DELETE FROM cartcourses WHERE username='$user'";
         //insert into orders
         $query3= "INSERT INTO orders (UserName)
         SELECT UserName FROM learners WHERE UserName='$user'";
         $result3 = mysqli_query($conn,$query3);

    $result_sql=$conn->query($sql);
    $result_delete1=$conn->query($sql_delete1);
    $result_delete2=$conn->query($sql_delete2);
    $counter=0;
    while($rows = $result_sql->fetch_array(MYSQLI_ASSOC)){
        foreach($rows as $row){
        //   $ID=$row[$counter];
        //   echo"ID: ".$row;
          $query1="INSERT INTO enroll (UserName,ID,EnrollDate,Done) VALUES ('$user',$row,NOW(),0)";
          $result1=mysqli_query($conn,$query1);
          $query4= "INSERT INTO ordercourses (orderID,CourseID)
           SELECT o.orderID,c.ID
           FROM courses c, orders o WHERE c.ID =$row and o.orderID=LAST_INSERT_ID();";
         $result4 = mysqli_query($conn,$query4);
        //   $counter++;
        }
    }

    
    // if(!$result2)
    //     echo"failed to execute query 2";
    $query2="SELECT Title FROM courses c, enroll e where e.ID=c.ID AND e.username='$user'";
    $result2=mysqli_query($conn,$query2);
    while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
        foreach($rows as $row){
            echo "Course name <input type=text name=title value=\"".$row."\" readonly><br><br>";
        }
         
    }


     
 
}
else if(!isset($_POST["Submit1"])){
    $query2="SELECT Title FROM courses c, enroll e where e.ID=c.ID AND e.username='$user'";
    $result2=mysqli_query($conn,$query2);

    while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
        foreach($rows as $row)
          echo "Course name <input type = text name = title value=\"".$row."\" readonly><br><br>";
    }
}
?>