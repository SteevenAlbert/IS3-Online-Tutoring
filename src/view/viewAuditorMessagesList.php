<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

//-------------------------------------------- Show all unread messages (latest first) --------------------------------------------
echo "Unread chats: ";
$query = "SELECT DISTINCT fromUserID FROM messages WHERE toUserID IS NULL AND isReadAuditor = 0 ORDER BY date DESC";
$result = $conn->query($query);
if (!$result)
    die ("Query error. $query");

echo mysqli_num_rows($result);

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td> <a href = /IS3-Online-Tutoring/src/actions/auditor/auditorChat.php?id=".$row['fromUserID'].">".getUsername($row['fromUserID'])."</a> </td>";
	echo "</tr>";
}
echo "</table>";

echo "<hr> Read chats";

//-------------------------------------------- Show all read messages --------------------------------------------
$query = "SELECT DISTINCT m1.fromUserID FROM messages as m1 WHERE toUserID IS NULL 
AND NOT EXISTS (SELECT m2.fromUserID FROM messages as m2 WHERE m2.isReadAuditor = 0 AND m2.fromUserID = m1.fromUserID) ORDER BY date DESC";


$result = $conn->query($query);
if (!$result)
    die ("Query error. $query");

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td> <a href = /IS3-Online-Tutoring/src/actions/auditor/auditorChat.php?id=".$row['fromUserID'].">".getUsername($row['fromUserID'])."</a> </td>";
	echo "</tr>";
}
echo "</table>";


?>