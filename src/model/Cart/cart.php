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
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isLearner();

//------------------------------------ Get Cart courses ------------------------------------
$user = $_SESSION['UserID'];
$query1="SELECT c1.title, c2.CourseID FROM courses c1,cartcourses c2 WHERE c2.CourseID=c1.CourseID AND c2.UserID='$user'";
$query2="SELECT SUM(price) FROM courses c1,cartcourses c2 WHERE c2.CourseID=c1.CourseID AND c2.UserID='$user'";
$result1=mysqli_query($conn,$query1);
$result2=mysqli_query($conn,$query2);
try{
    if (!$result1){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}


try{
    if (!$result2){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

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
    try{
        if (!$result_sql1){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }

    try{
        if (!$result_sql2){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
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