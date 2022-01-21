<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$username = $_GET['un'];

$query = "SELECT * FROM users WHERE Username= '$username'";
$result = $conn->query($query);
if(!$result)
    throw new Exception($query);


$row = $result->fetch_array(MYSQLI_ASSOC);

if($row){
    echo "Username Taken ";
}else{
    echo "Available";
}


?>