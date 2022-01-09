<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

//-------------------------------------------- Show all unread messages (latest first) --------------------------------------------
echo "Unread chats: ";
$query = "SELECT DISTINCT m.fromUserID from messages as m, users as u
where m.fromUserID = u.UserID
AND u.UserType = 'Administrator'
AND m.isReadAuditor IS NULL ORDER BY m.date DESC";
$result = $conn->query($query);
if (!$result)
    die ("Query error. $query");

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
if (!$result)
    die ("Query error. $query");

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td> <a href = /IS3-Online-Tutoring/src/actions/auditor/chooseAdminMessages.php?admin=".$row['fromUserID'].">".getUsername($row['fromUserID'])."</a> </td>";
	echo "</tr>";
}
echo "</table>";


?>