<html>
<body>

<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

//------------------------------------ Get user info ------------------------------------
if(isset($_POST["UserName"], $_POST["Password"],$_POST['Fname'],$_POST['LName'], $_POST['Email'], $_POST['Country'],$_POST['BOD'] )) {
    $UserName = $_POST['UserName'];
    $Password = $_POST['Password'];
    $Fname = $_POST['Fname'];
    $LName = $_POST['LName'];
    $Email = $_POST['Email'];
    $PhoneNo = $_POST['PhoneNo'];
    $Country = $_POST['Country'];
    $Birthdate = $_POST['BOD'];
    $UserType = $_POST['UserType'];
    $profileImageName = time() .'_'.$_FILES['profileImage']['name'];
    $TempImageName = $_FILES['profileImage']['tmp_name'];
    $target='/xampp/htdocs/IS3-Online-Tutoring/uploads/profile_pictures/'.$profileImageName;
    $result = move_uploaded_file($TempImageName, $target);
    $hashedPassword =  password_hash($Password, PASSWORD_DEFAULT);

    $fileType=strtolower(pathinfo($target,PATHINFO_EXTENSION));

    $accept=false;

    if($fileType=="jpg" || $fileType=="jpeg" || $fileType=="png"){
        $result = move_uploaded_file($TempImageName, $target);
        $accept=true;
    }
    elseif($_POST['profileImage']==null){
        echo "User didn't upload an image <br>";
    }
    else
    {
        echo "Only JPG, JPEG & PNG files are allowed <br>";      
        $accept=false;
    }

	establishConnection();

    //--------------------------------- Insert new user into database --------------------------------- 
    // Insert Image in Database if move was successful 

   
    //Check That Username doesn't exist in database
    $query = "SELECT * FROM users WHERE Username= '$UserName'";
    if(!$conn->query($query))
        echo mysqli_errno($conn).": " .mysqli_error($conn);

    $result = $conn->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    if($row){
        echo "Username Taken ";
    }else{
        if(filterEmail($Email)){
            $Email= filter_var($Email,FILTER_SANITIZE_EMAIL);
        if($accept){
            echo "Image Uploaded Successfully<br>"; 
            $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
            VALUES ('$UserName', '$hashedPassword', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";
            $query2 = true;
        }else{     
            $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
            VALUES ('$UserName', '$hashedPassword', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";
            trigger_error("user tried to upload wrong file format", E_USER_WARNING);
            $query2 = false;
        }   
        
        if(!$conn->query($query))
        {
            echo mysqli_errno($conn).": " .mysqli_error($conn);
        }  
        else{
        //---------------- Insert user in learners or tutors table with profile picture ----------------
                $getID = "SELECT UserID from users WHERE UserName = '$UserName'";
                $UserID = -1;
                if ($result = $conn->query($getID))
                {
                    $row =  $result->fetch_assoc();
                    $UserID = $row['UserID'];
                } 
                else
                    echo $getID;

                if ($query2)
                {
                    if($UserType=="Learner")
                    $query2 = "INSERT INTO learners (UserID, profile_picture) VALUES ('$UserID','$profileImageName')"; 
                    else
                    $query2 = "INSERT INTO tutors (UserID, profile_picture) VALUES ('$UserID','$profileImageName')";
                }
                else{
                    if($UserType=="Learner")
                    $query2 = "INSERT INTO learners (UserID) VALUES ('$UserID')";
                    else
                    $query2 = "INSERT INTO tutors (UserID) VALUES ('$UserID')";
                }

                if (!$conn->query($query2))
                    echo mysqli_errno($conn).": " .mysqli_error($conn);
                else
                {
                    echo "REGISTERED"; 
                    echo "<br>";
                    echo "<a href=/IS3-Online-Tutoring/src/public/home.php>CONTINUE</a>";
                    header("Location:/IS3-Online-Tutoring/src/public/home.php");
                }
            }
        }
    }
}else
    echo "Required Data is Not Complete";

?>

</body>
</html>