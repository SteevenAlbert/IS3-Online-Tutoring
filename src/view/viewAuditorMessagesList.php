<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">


<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isAuditor();

//-------------------------------------------- Show all unread messages (latest first) --------------------------------------------
echo "Unread chats: ";
$query = "SELECT DISTINCT m.fromUserID from messages as m, users as u
where m.fromUserID = u.UserID
AND u.UserType = 'Administrator'
AND m.isReadAuditor IS NULL ORDER BY m.date DESC";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

echo mysqli_num_rows($result);

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td> <a href = /IS3-Online-Tutoring/src/actions/auditor/chooseAdminMessages.php?admin=".$row['fromUserID'].">".getUsername($row['fromUserID'])."</a> </td>";
	echo "</tr>";
}
echo "</table>";

echo "<hr> Read chats";

//-------------------------------------------- Show all read messages --------------------------------------------
$query = "SELECT DISTINCT m1.fromUserID from messages as m1, users as u
where m1.fromUserID = u.UserID
AND u.UserType = 'Administrator' 
AND NOT EXISTS (SELECT m2.fromUserID FROM messages as m2 WHERE m2.isReadAuditor IS NULL AND m2.fromUserID = m1.fromUserID) ORDER BY date DESC";


$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td> <a href = /IS3-Online-Tutoring/src/actions/auditor/chooseAdminMessages.php?admin=".$row['fromUserID'].">".getUsername($row['fromUserID'])."</a> </td>";
	echo "</tr>";
}
echo "</table>";


?>