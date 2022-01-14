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

isTutor();

$CourseID = $_GET["id"];
$getEnrolledQuery = "SELECT * FROM enroll WHERE CourseID= '$CourseID'";
    if(!$conn->query($getEnrolledQuery))
        echo mysqli_errno($conn).": " .mysqli_error($conn);

$result = $conn->query($getEnrolledQuery);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
?>
<table border = 1>
<tr>
<th>Student</th> 
<th>Enroll Date</th> 
<th>Rated</th> 
<th>Send Survey</th>  
</tr>

<?php
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $UserID = $row['UserID'];
    $EnrollDate = $row['EnrollDate'];
    
    //Check if user rated course
   $getRatedQuery = "SELECT * FROM Ratings WHERE courseID= '$CourseID' AND UserID = '$UserID'" ;
    if(!$conn->query($getRatedQuery))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
    $return = $conn->query($getRatedQuery);
    try{
        if (!$return){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
    $row2 = $return->fetch_array(MYSQLI_ASSOC);
    
    echo "<tr>";
    echo "<td> $UserID </td> ";
    echo "<td> $EnrollDate </td> ";
    if($row2){       
        echo "<td>Done</td>";
        echo "<td> -------</td>";
    }else{
        echo "<td> x</td>";
        ?><td> <a href="/IS3-Online-Tutoring/src/actions/PushNotification.php?UserID=<?php echo $UserID?>&CourseID=<?php echo $CourseID?>"> Contact</a></td>
        <?php
    } 
 
    echo "</tr>";
}
    echo "</table>";
?>  
