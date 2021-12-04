<html>
<body>

<?php
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

$conn = new mysqli("localhost","root","","is3 online tutoring");
if($conn->connect_error)
    die("Fatal Error - cannot connect to the Database");

    //Insert Image in Database if move was successful 
    if($result){
        echo "Image Uploaded Successfully\n"; 
        $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType, profile_picture)
        VALUES ('$UserName', '$Password', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType','$profileImageName')";
    }else{
         echo "Image Upload Failed\n";
        $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
        VALUES ('$UserName', '$Password', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";
    }   
    
    
if($UserType == "Learner"){
    $query2 = "INSERT INTO learners (Username) VALUES ('$UserName')";
}else{
    $query2 = "INSERT INTO tutors (Username) VALUES ('$UserName')";
}



if(!$conn->query($query) || !$conn->query($query2))
    echo mysqli_errno($conn).": " .mysqli_error($conn);
else{
    echo "REGISTERED"; 
    echo "<br>";
    echo "<a href=home.php>CONTINUE</a>";
}

}else
echo "Required Data is Not Complete";

?>

</body>
</html>