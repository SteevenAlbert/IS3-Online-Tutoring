<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();

$user = $_SESSION['username'];
$query1="SELECT title FROM courses c1,cartcourses c2 WHERE c2.id=c1.id AND c2.username='$user'";
$query2="SELECT SUM(price) FROM courses c1,cartcourses c2 WHERE c2.id=c1.id AND c2.username='$user'";
$result1=mysqli_query($conn,$query1);
$result2=mysqli_query($conn,$query2);
// $result3 = $conn->query($query3);
    // $query ="SELECT UserName FROM cart WHERE UserName=".$user;
    // $result = mysqli_query($conn,$query);

if(!$result1)
    echo"fatal error in executing the query 3<br>";
$count=1;
while($rows = $result1->fetch_array(MYSQLI_ASSOC)){

    foreach($rows as $row)
    echo "course ".$count." <input type = text name = title value =".$row." readonly><br>";
        echo"<br>";
        $count++;
}
while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
    foreach($rows as $row)
      echo "total <input type = text name = title value =".$row." readonly><br>";
}
echo"<br>";
?>
<input type="submit"  name="click">