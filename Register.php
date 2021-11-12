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

Test 
$conn = new mysqli("localhost","root","","is3 online tutoring");
if($conn->connect_error)
    die("Fatal Error - cannot connect to the Database");
    
$query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, PhoneNumber, Country, Birthdate, UserType)
VALUES ('$UserName', '$Password', '$Fname','$LName', '$Email', '$PhoneNo', '$Country', '$Birthdate', '$UserType')";

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
    echo "<a href=Index.html>CONTINUE</a>";
}

}else
echo "Required Data is Not Complete";

?>

</body>
</html>