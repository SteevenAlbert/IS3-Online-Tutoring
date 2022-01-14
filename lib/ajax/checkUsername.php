<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$username = $_GET['un'];

$query = "SELECT * FROM users WHERE Username= '$username'";
if(!$conn->query($query))
    echo mysqli_errno($conn).": " .mysqli_error($conn);

$result = $conn->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);

if($row){
    echo "Username Taken ";
}else{
    echo "Available";
}


?>