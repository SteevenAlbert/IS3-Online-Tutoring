<html>
<body>

<?php
include_once "filters.php";
include_once "is3library.php";

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

    if ($UserType == 'Learner'){
        $profileImageName = time() .'_'.$_FILES['profileImage']['name'];
        $TempImageName = $_FILES['profileImage']['tmp_name'];

        $target='images/'. $profileImageName;
        $result = move_uploaded_file($TempImageName, $target);
    }
    else
    {
        $result = false;
    }

	establishConnection();

    //--------------------------------- Insert new user into database --------------------------------- 
    // Insert Image in Database if move was successful 
    if(filterEmail($Email)){
        $Email= filter_var($Email,FILTER_SANITIZE_EMAIL);
    if($result){
        echo "Image Uploaded Successfully\n"; 
        $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
        VALUES ('$UserName', '$Password', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";
        $query2 = true;
    }else{
        echo "Image Upload Failed\n";
        $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
        VALUES ('$UserName', '$Password', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";
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
        $query2 = "INSERT INTO learners (UserID, profile_picture) VALUES ('$UserID','$profileImageName')"; 
    }
    else{
        $query2 = "INSERT INTO tutors (UserID) VALUES ('$UserID')";
    }

    if (!$conn->query($query2))
        echo mysqli_errno($conn).": " .mysqli_error($conn);
    else
    {
        echo "REGISTERED"; 
        echo "<br>";
        echo "<a href=home.php>CONTINUE</a>";
    }
   
}
    }
}else
echo "Required Data is Not Complete";

?>

</body>
</html>