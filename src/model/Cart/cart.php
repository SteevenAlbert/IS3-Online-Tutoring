<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

//------------------------------------ Get Cart courses ------------------------------------
$user = $_SESSION['UserID'];
$query1="SELECT c1.title, c2.CourseID FROM courses c1,cartcourses c2 WHERE c2.CourseID=c1.CourseID AND c2.UserID='$user'";
$query2="SELECT SUM(price) FROM courses c1,cartcourses c2 WHERE c2.CourseID=c1.CourseID AND c2.UserID='$user'";
$result1=mysqli_query($conn,$query1);
$result2=mysqli_query($conn,$query2);


if(!$result1)
    echo"fatal error in executing the query <br>";


echo "<table border=1>     
  <th>Course Title</th> 
  <th>Remove from cart</th>";

//------------------------------------ Display Cart Courses ------------------------------------
while($rows = $result1->fetch_array(MYSQLI_ASSOC)){
    ?>
    <tr>
    <td><?php echo$rows["title"]?></td>
    <td><a href=cart.php?id=<?php echo$rows["CourseID"]?>>Remove</a> </td>
    </tr>
 <?php
}

//------------------------------------ Remove course from cart ------------------------------------
function Remove($conn) {
    $get_id = $_GET["id"];
    $user = $_SESSION['username'];
    //delte from cart
    $sql1= "DELETE FROM cartcourses WHERE CourseID=".$get_id;
    $sql2= "DELETE FROM ordercourses WHERE CourseID=".$get_id;
    $result_sql1=mysqli_query($conn,$sql1);
    $result_sql2=mysqli_query($conn,$sql2);
}

if (isset($_GET["id"])) {
    Remove($conn);
}

//------------------------------------ Display total price ------------------------------------
echo "<form action='/IS3-Online-Tutoring/src/actions/learner/enroll.php' method='post'>";

$numberOfCourses = mysqli_num_rows($result1);
echo "<input hidden type = text name = 'amount' value = $numberOfCourses><br>";


while($rows = $result2->fetch_array(MYSQLI_ASSOC)){
    foreach($rows as $row)
      echo "total <input type = text name = 'total' value =".$row." readonly><br>";
}
echo"<br>";

//--------------------------------------- Purchase button ------------------------------------
?>
    <input type="submit" value="Purchase" name="Submit1"><br/><br/>
</form>