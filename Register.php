<html>
<body>

<?php
include_once "filters.php";
include_once "is3library.php";
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

    $target='images/'. $profileImageName;
    $result = move_uploaded_file($TempImageName, $target);

	establishConnection();

    //Insert Image in Database if move was successful 
    if(filterEmail($Email)){
        $Email= filter_var($Email,FILTER_SANITIZE_EMAIL);
    if($result){
        echo "Image Uploaded Successfully\n"; 
        $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
        VALUES ('$UserName', '$Password', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";
         $query2 = "INSERT INTO learners (Username, profile_picture) VALUES ('$UserName','$profileImageName')";   
    }else{
        echo "Image Upload Failed\n";
        $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
        VALUES ('$UserName', '$Password', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";
        $query2 = "INSERT INTO tutors (Username) VALUES ('$UserName')";
    }   
    


if(!$conn->query($query) || !$conn->query($query2))
    echo mysqli_errno($conn).": " .mysqli_error($conn);
else{
    echo "REGISTERED"; 
    echo "<br>";
    echo "<a href=home.php>CONTINUE</a>";
}
    }
}else
echo "Required Data is Not Complete";

?>

</body>
</html>