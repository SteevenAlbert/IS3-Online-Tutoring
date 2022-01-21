<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$CourseID=$_POST['CourseID'];
$UserID= $_POST['UserID'];

        $message1="Course already in cart";
        $checkInCart= "SELECT CourseID FROM cartcourses WHERE UserID='".$UserID."' AND CourseID=".$CourseID;
        $result_checkCart = mysqli_query($conn,$checkInCart);
        
        if (!$result_checkCart){
            throw new Exception($checkInCart); 
        }
        
        $row1 = mysqli_num_rows($result_checkCart);
        if($row1!=0){
            echo $message1;
        }
        else
        {
            //check wether the learner already enrolled in this course
            $message2="You are already enrolled in this course";
            $checkInEnroll= "SELECT CourseID FROM enroll WHERE UserID='$UserID' AND CourseID=".$CourseID;
            $result_checkEnroll = mysqli_query($conn,$checkInEnroll);
            if (!$result_checkEnroll){
                throw new Exception($checkInEnroll); 
            }
        
            $row2 = mysqli_num_rows($result_checkEnroll);
            if($row2!=0){
                echo $message2;
            }
            else{
                $insertCartQuery= "INSERT INTO cartcourses (UserID,CourseID) 
                VALUES ('".$UserID."','".$CourseID."')";
        
                $result_insertCart = mysqli_query($conn,$insertCartQuery);
                if (!$result_insertCart){
                    throw new Exception($insertCartQuery); 
                }else{
                    echo "Success";
                }
            }
        
        } 

?>