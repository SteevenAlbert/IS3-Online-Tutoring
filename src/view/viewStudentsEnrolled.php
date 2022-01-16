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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<link rel="stylesheet" href="../../CSS/view.css">

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

<div class="page-title">
    <h1>Students enrolled in <?php echo getCourseTitle($CourseID)?></h1>
</div>

<table class="table table-hover">
<thead>
<tr>
<th class="text-center">Student</th> 
<th class="text-center">Enroll Date</th> 
<th class="text-center">Rated</th> 
<th class="text-center">Send Survey</th>  
</tr>
</thead>

<tbody>
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
    echo "<td>". getUsername($UserID) ."</td> ";
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
    echo "</tbody>";
    echo "</table>";
?>  
