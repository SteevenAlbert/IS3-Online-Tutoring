<link rel="stylesheet" href="../../CSS/ratings.css" type="text/css">
<?php

session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();

$getCoursesQuery = "SELECT * FROM courses where Approved='1'";
$result = $conn->query($getCoursesQuery);

if (!$result)
    die ("Query error. $getUserQuery");

//------------------------------------ Display Approved courses for Learner ------------------------------------
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
            <th>Add to cart</th>
            </tr>";
           
    // Display overall rating
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $averageRating=5;
        $getReviewsQuery = "SELECT * FROM ratings WHERE CourseID=".$row["CourseID"];
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

    // Display course details
    ?>
    <tr>
    <td> <a href=/IS3-Online-Tutoring/src/view/viewCourseDetails.php?id=<?php echo $row['CourseID'] ?> > <?php echo$row["Code"]?></a> </td>
    <td><?php echo$row["Title"]?> </td>
    <td><?php echo$row["Description"]?> </td>
    <td><?php echo$row["Hours"]?> </td>
    <td><?php echo$row["Level"]?></td>
    <td><?php echo$row["Price"]?></td>
    <td><?php echo$row["CreatedBy"]?></td>
    <td> <?php echo $averageRating."/5  ($reviewCount reviews)"?> </td>
    <td><a href=/IS3-Online-Tutoring/src/view/viewApprovedCourses.php?id=<?php echo $row['CourseID']?>>Add To Cart</a> 
    </tr>

    <?php
    }

    echo "</table>";

}
//------------------------------------ Display Approved courses for tutor ------------------------------------
else if($_SESSION["UserType"]=="Tutor" && empty($_GET["id"]) ){
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

//------------------------------------ Display pending courses to Administrator ------------------------------------
else if($_SESSION["UserType"]=="Administrator" || $_SESSION["UserType"]=="Auditor"){
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
        <th>Delete</th></tr>";
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
        <td> <a href=/IS3-Online-Tutoring/src/model/Course/editCourse.php?id=<?php echo $row['CourseID'] ?> > Edit</a></td>
        <td> <a href=/IS3-Online-Tutoring/src/model/Course/deleteCourse.php?id=<?php echo $row['CourseID'] ?> >Delete</a></td>
        </tr>
<?php
    }
}

//------------------------------------ Display Approved courses of current tutor ------------------------------------
else if($_SESSION["UserType"]=="Tutor" && $_GET['id']=1){
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
        <td> <a href=courseDetails.php?id=<?php echo $row['CourseID'] ?> > <?php echo$row["Code"]?></a> </td>
        <td><?php echo$row["Title"]?> </td>
        <td><?php echo$row["Description"]?> </td>
        <td><?php echo$row["Hours"]?> </td>
        <td><?php echo$row["Level"]?></td>
        <td><?php echo$row["Price"]?></td>
        <td> <a href=addCourseContent.php?id=<?php echo $row['CourseID'] ?> > Add Content</a></td>
        <td> <a href=editCourse.php?id=<?php echo $row['CourseID'] ?> > Edit</a></td>
        <td> <a href=deleteCourse.php?id=<?php echo $row['CourseID'] ?> >Delete</a></td>
        </tr>
    <?php  }
    }
}

echo "</table>";

//------------------------------------ Add course to cart ------------------------------------
function addToCart($conn) {
    
    $insertCartQuery= "INSERT INTO cartcourses (UserID,CourseID) 
    VALUES ('".$_SESSION['UserID']."','".$_GET['id']."')";

    $result_insertCart = mysqli_query($conn,$insertCartQuery);
    if(!$result_insertCart){
        die ("Error. $insertCartQuery");
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
                 <a href=/IS3-Online-Tutoring/src/model/Course/editCourse.php?id=<?php echo $row['CourseID'] ?> > Edit</a></td>
             <td> <a href=/IS3-Online-Tutoring/src/model/Course/deleteCourse.php?id=<?php echo $row['CourseID'] ?> >Delete</a></td>
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
    
if (isset($_GET['id'])) {

    $x = $_GET["id"];
    $user = $_SESSION['UserID'];

    // check wether the course is already in the cart
    $message1="Course already in cart";
    $checkInCart= "SELECT CourseID FROM cartcourses WHERE UserID='$user' AND CourseID=".$x;
    $result_checkCart = mysqli_query($conn,$checkInCart);

    if(!$result_checkCart){
        die ("Error. $checkInCart");
    }

    $row1 = mysqli_num_rows($result_checkCart);
    if($row1!=0){
        echo "<script>alert('$message1');</script>";
    }
    

     //check wether the learner already enrolled in this course
    $message2="You are already enrolled in this course";
    $checkInEnroll= "SELECT CourseID FROM enroll WHERE UserID='$user' AND CourseID=".$x;
    $result_checkEnroll = mysqli_query($conn,$checkInEnroll);
    if(!$result_checkEnroll){
        die ("Error. $checkInEnroll");
    }
    
    $row2 = mysqli_num_rows($result_checkEnroll);
    if($row2!=0){
        echo "<script>alert('$message2');</script>";
    }
    elseif($row2==0){// to do nothing
    }
    
    else{
        addToCart($conn);
    }
}
    if (isset($_GET['id'])) {
        addToCart($conn);
     
    }

}
?>