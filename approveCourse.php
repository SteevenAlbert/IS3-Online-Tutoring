<link rel="stylesheet" href="ratings.css" type="text/css">
<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

$getCoursesQuery = "SELECT * FROM courses where Approved='1'";

$result = $conn->query($getCoursesQuery);

if (!$result)
 die ("Query error. $getUserQuery");



 
 else if($_SESSION["UserType"]=="Learner"){
    echo "<table border=1 >
            <th>Code</th> 
            <th>Title</th> 
            <th>Description</th> 
            <th>Hours</th>  
            <th>Level</th>  
            <th>Price</th>  
            <th>Instructor</th>
            <th>Rating</th>
            </tr>";
            
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $averageRating=5;
        $getReviewsQuery = "SELECT * FROM ratings WHERE courseID=".$row["ID"];
        $reviews = $conn->query($getReviewsQuery);
        if (!$reviews)
        die ("Query error. $getReviewsQuery");
        $reviewCount=0;
        $reviewsTotal=0;
        while($review= $reviews->fetch_array(MYSQLI_ASSOC)){
        $reviewCount +=1; 
        $reviewsTotal+= $review['rating'];
    }
    if($reviewCount)
    $averageRating = round($reviewsTotal / $reviewCount, 1)

        ?>
        <tr>
        <td> <a href=courseDetails.php?id=<?php echo $row['ID'] ?> > <?php echo$row["Code"]?></a> </td>
        <td><?php echo$row["Title"]?> </td>
        <td><?php echo$row["Description"]?> </td>
        <td><?php echo$row["Hours"]?> </td>
        <td><?php echo$row["Level"]?></td>
        <td><?php echo$row["Price"]?></td>
        <td><?php echo$row["CreatedBy"]?></td>
        <td> <?php echo $averageRating."/5  ($reviewCount reviews)"?> </td>
        <td><a href=approveCourse.php?id=<?php echo $row['ID']?>>Add To Cart</a> 
        </tr>

    <?php
    }
    echo "</table>";
    }else if($_SESSION["UserType"]=="Tutor" && empty($_GET["id"]) ){
        echo "<table border=1 >
            <th>Code</th> 
            <th>Title</th> 
            <th>Description</th> 
            <th>Hours</th>  
            <th>Level</th>  
            <th>Price</th>  
            <th>Instructor</th>

             </tr>";
            while($row = $result->fetch_assoc()) {
                ?>
                
                 <tr>
                 <td><?php echo$row["Code"]?></td>
                 <td><?php echo$row["Title"]?> </td>
                 <td><?php echo$row["Description"]?> </td>
                 <td><?php echo$row["Hours"]?> </td>
                 <td><?php echo$row["Level"]?></td>
                 <td><?php echo$row["Price"]?></td>
                 <td><?php echo$row["CreatedBy"]?></td>
                 </tr>
    <?php
    }
    echo "</table>";
    }
    else if($_SESSION["UserType"]=="Administrator"){
        echo "<table border=1 >
            <th>Code</th> 
            <th>Title</th> 
            <th>Description</th> 
            <th>Hours</th>  
            <th>Level</th>  
            <th>Price</th>  
            <th>Instructor</th> 
            <th>Categorie</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Approve</th></tr>";
        echo "<form method = 'post' action = ''>";
            while($row = $result->fetch_assoc()) {
                
                ?>
                
                 <tr>
                 <td><?php echo$row["Code"]?></td>
                 <td><?php echo$row["Title"]?> </td>
                 <td><?php echo$row["Description"]?> </td>
                 <td><?php echo$row["Hours"]?> </td>
                 <td><?php echo$row["Level"]?></td>
                 <td><?php echo$row["Price"]?></td>
                 <td><?php echo$row["CreatedBy"]?></td>
                 <td><?php echo$row["Categories"]?></td>
                 <td> <a href=editCourse.php?id=<?php echo $row['ID'] ?> > Edit</a></td>
                 <td> <a href=deleteCourse.php?id=<?php echo $row['ID'] ?> >Delete</a></td>
                 <td> <input type = "checkbox" value = <?php echo$row["Code"]?> name = "courses[]"></td>
                 </tr>
    <?php
            }
    }else if($_SESSION["UserType"]=="Tutor" && $_GET['id']=1){
        echo "<table border=1 >
            <th>Code</th> 
            <th>Title</th> 
            <th>Description</th> 
            <th>Hours</th>  
            <th>Level</th>  
            <th>Price</th>
            <th>Content</th>  
            <th>Edit</th>
            <th>Delete</th>
            </tr>";
            
        echo "<form method = 'post' action = 'approveCourse.php'>";
            
            while($row = $result->fetch_assoc()) {
                if($row["CreatedBy"]==$_SESSION["username"]){
                ?>
                 <tr>
                 <td> <a href=courseDetails.php?id=<?php echo $row['ID'] ?> > <?php echo$row["Code"]?></a> </td>
                 <td><?php echo$row["Title"]?> </td>
                 <td><?php echo$row["Description"]?> </td>
                 <td><?php echo$row["Hours"]?> </td>
                 <td><?php echo$row["Level"]?></td>
                 <td><?php echo$row["Price"]?></td>
                 <td> <a href=addCourseContent.php?id=<?php echo $row['ID'] ?> > Add Content</a></td>
                 <td> <a href=editCourse.php?id=<?php echo $row['ID'] ?> > Edit</a></td>
                 <td> <a href=deleteCourse.php?id=<?php echo $row['ID'] ?> >Delete</a></td>
                 </tr>
  <?php  }
  }
}
    echo "</table>";
    
   
    
    function myFunction($conn) {
        $x = $_GET["id"];
        $user = $_SESSION['username'];
        $query1= "insert into cart (UserName) values ('$user')";
        $query2= "insert into cartcourses (UserName, ID ) values ('$user','$x')";
    
        $result1 = mysqli_query($conn,$query1);
        $result2 = mysqli_query($conn,$query2);
        if(!$result1 && !$result2){
            echo"cannot execute query";
        }
    }
    if (isset($_GET['id'])) {
        myFunction($conn);
    }
    
?>