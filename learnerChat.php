<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

// Set read to true
$query = "UPDATE messages SET isRead = 1 WHERE fromUsername ='".$_GET['id']."'";
    $result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");

// Send message
if (isset($_POST['submit']))
{
    $query = "INSERT INTO messages(fromUsername, toUsername, text, date) VALUES ('".$_SESSION['username']."','".$_GET['id']."','".$_POST['message']."', now())";
    $result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");
}

// Get messages history
$query = "SELECT * FROM messages WHERE fromUsername = '".$_GET['id']."' OR toUsername = '".$_GET['id']."'";
$result = $conn->query($query);
if (!$result)
    die ("Query error. $query");


while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    if ($row["fromUsername"]== $_SESSION['username'])
        echo "<b> You: </b> <br>";
    else
        echo "<b>".$row["fromUsername"].": </b> <br>";

    if ($row['text'] != NULL)
        echo $row["text"]."<br>";

    if ($row['link'] != NULL)
        echo "<a href='".$row['link'] ."'>". $row['link']."</a> <br>";

    if ($row['file'] != NULL)
        echo "<img src = 'messagesFiles/".$row['file'] ."' width = 300> <br>";

    echo date('H:i:s d-m-Y ', strtotime($row['date']))."<br> <br>";
}

// Message input
echo "<form action ='' method = 'post'>";
echo "<textarea name='message' rows='3' cols='100'> </textarea> &nbsp";
echo "<input type=submit name='submit'> ";


?>