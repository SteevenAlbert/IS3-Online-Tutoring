<?php
session_start();
include_once "Menu.php";
include_once "filters.php";
include_once "is3library.php";

establishConnection();

//--------------------------------------------- Send message ---------------------------------------------
if (isset($_POST['submit']))
{
    $fileName = time() .'_'.$_FILES['messageFile']['name'];
    $fileTempName = $_FILES['messageFile']['tmp_name'];

    $target='messagesFiles/'. $fileName;
    $fileMove = move_uploaded_file($fileTempName, $target);

    // Insert file in Database if move was successful 
    if(filterLink($_POST['link'])){
        $_POST['link'] = filter_var($_POST['link'],FILTER_SANITIZE_URL);
    }
<<<<<<< Updated upstream
=======
      $text_msg = $conn->real_escape_string($_POST['message']);
      
>>>>>>> Stashed changes
        if($fileMove){

            $query = "INSERT INTO messages(fromUserID, text, link, file, isRead, date) VALUES ('".$_SESSION['UserID']."','$text_msg','".$_POST['link']."', '$fileName', 0, now())";
            $result = $conn->query($query);
            if (!$result)
                die ("Query error. $query");
        }
        else{
            $query = "INSERT INTO messages(fromUserID, text, link, isRead, date) VALUES ('".$_SESSION['UserID']."','$text_msg','".$_POST['link']."', 0, now())";
            $result = $conn->query($query);
            if (!$result)
                die ("Query error. $query");
        }
    
}

//--------------------------------------------- Messages history ---------------------------------------------
$query = "SELECT * FROM messages WHERE fromUserID = '".$_SESSION['UserID']."' OR toUserID = '".$_SESSION['UserID']."'";
$result = $conn->query($query);
if (!$result)
    die ("Query error. $query");

while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    if ($row["fromUserID"]== $_SESSION['UserID'])
        echo "<b> You: </b> <br>";
    else
        echo "<b> Our team: </b> <br>"; 

    if ($row['text'] != NULL)
        echo $row["text"]."<br>";

    if ($row['link'] != NULL)
        echo "<a href='".$row['link'] ."'>". $row['link']."</a> <br>";
    
    if ($row['file'] != NULL)
        echo "<img src = 'messagesFiles/".$row['file'] ."' width = 300> <br>";

    echo date('H:i:s d-m-Y ', strtotime($row['date']))."<br> <br>";
}

//--------------------------------------------- Message input ---------------------------------------------
echo "<form action ='' method = 'post' enctype = 'multipart/form-data'>";
echo "<textarea name='message' rows='3' cols='100'> </textarea> <br>";
echo "<input type='url' name='link' cols = '100'> &nbsp";
echo "<input type='file' name='messageFile' id ='messageFile'> <br>";
echo "<input type=submit name='submit'> ";

?>