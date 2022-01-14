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


$adminID = $_GET['admin'];

//-------------------------------- All users who chated with this admin ---------------------------
echo "<b>All chats for:".getUsername($adminID). "</b> <br> <br>";

$query = "SELECT DISTINCT toUserID from messages WHERE fromUserID = '".$adminID ."'";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo "<tr>";
    echo "<td> <a href = /IS3-Online-Tutoring/src/actions/auditor/auditorChat.php?learner=".$row['toUserID']."&admin=".$adminID.">".getUsername($row['toUserID'])."</a> </td>";
	echo "</tr>";

}
echo "</table>";


//-------------------------------- All commented messages for this admin ---------------------------
$query = "SELECT m1.text as Comment, m2.text as Message from messages as m1, messages as m2 
WHERE m1.parentMessageID IS NOT NULL AND m1.toUserID = $adminID
AND m1.parentMessageID = m2.messageID";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}


echo "<br> <br>  <br> <b> All comments </b> <br> <br>";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    echo "<b>Message: </b>".$row['Message']."<br>";
    echo "<b>Comment: </b>".$row['Comment']."<br><br>";
}

?>