<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

// Show all unread messages (latest first)
echo "Unread chats: ";
$query = "SELECT DISTINCT fromUsername FROM messages WHERE toUsername IS NULL AND isRead = 0 ORDER BY date DESC";
$result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");

echo mysqli_num_rows($result);

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td> <a href = learnerChat.php?id=".$row['fromUsername'].">".$row['fromUsername']."</a> </td>";
	echo "</tr>";
}
echo "</table>";

echo "<hr> Read chats";

// Show all read messages 
$query = "SELECT DISTINCT m1.fromUsername FROM messages as m1 WHERE toUsername IS NULL 
AND NOT EXISTS (SELECT m2.fromUsername FROM messages as m2 WHERE m2.isRead = 0 AND m2.fromUsername = m1.fromUsername) ORDER BY date DESC";


$result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");

echo "<table border = 1> <tr> <th> Learner </th> </tr>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td> <a href = learnerChat.php?id=".$row['fromUsername'].">".$row['fromUsername']."</a> </td>";
	echo "</tr>";
}
echo "</table>";


?>