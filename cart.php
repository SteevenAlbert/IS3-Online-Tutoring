<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";
establishConnection();

$user = $_SESSION['username'];
$query1="SELECT c1.title, c2.ID FROM courses c1,cartcourses c2 WHERE c2.id=c1.id AND c2.username='$user'";
$query2="SELECT SUM(price) FROM courses c1,cartcourses c2 WHERE c2.id=c1.id AND c2.username='$user'";
$result1=mysqli_query($conn,$query1);
$result2=mysqli_query($conn,$query2);


if(!$result1)
    echo"fatal error in executing the query 3<br>";


echo "<table border=1>
      
  <th>Course Title</th> 
  <th>Remove from cart</th>";
 while($rows = $result1->fetch_array(MYSQLI_ASSOC)){

    ?>
    <tr>
    <td><?php echo$rows["title"]?></td>
    <td><a href=cart.php?id=<?php echo$rows["ID"]?>>Remove</a> </td>
    </tr>
 <?php
}

function Remove($conn) {
    $get_id = $_GET["id"];
    $user = $_SESSION['username'];
    //delte from cart
    $sql1= "DELETE FROM cartcourses WHERE ID=".$get_id;
    $sql2= "DELETE FROM ordercourses WHERE courseID=".$get_id;
    $result_sql1=mysqli_query($conn,$sql1);
    $result_sql2=mysqli_query($conn,$sql2);
}

if (isset($_GET["id"])) {
    Remove($conn);
}

while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
    foreach($rows as $row)
      echo "total <input type = text name = title value =".$row." readonly><br>";
}
echo"<br>";

?>
<form action="enrolledCourses.php" method="post">
<input type="submit" value="Purchase" name="Submit1"><br/><br/>
</form>