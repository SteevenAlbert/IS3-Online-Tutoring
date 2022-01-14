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

isAdmin();

// Set read to true
//-------------------------------------------- Set read to true --------------------------------------------
$query = "UPDATE messages SET isRead = 1 WHERE fromUserID ='".$_GET['id']."'";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
    echo"Message:", $e->getMessage();  
}

// Send message
//-------------------------------------------- Send message --------------------------------------------
if (isset($_POST['submit']))
{
    $text_msg = $conn->real_escape_string($_POST['message']);
    $query = "INSERT INTO messages(fromUserID, toUserID, text, date) VALUES ('".$_SESSION['UserID']."','".$_GET['id']."','".$text_msg."', now())";
    $result = $conn->query($query);
    try{
        if (!$result){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
}

// Get messages history
//-------------------------------------------- Get messages history --------------------------------------------
$query = "SELECT * FROM messages WHERE fromUserID = '".$_GET['id']."' OR toUserID = '".$_GET['id']."'";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}


while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    if ($row["fromUserID"]== $_SESSION['UserID'])
        echo "<b> You: </b> <br>";
    else
        echo "<b>".getUsername($row["fromUserID"]).": </b> <br>";

    if ($row['text'] != NULL)
        echo $row["text"]."<br>";
    if ($row['link'] != NULL)
        echo "<a href='".$row['link'] ."'>". $row['link']."</a> <br>";
    if ($row['file'] != NULL)
        echo "<img src = '/IS3-Online-Tutoring/uploads/messagesFiles/".$row['file'] ."' width = 300> <br>";
    echo date('H:i:s d-m-Y ', strtotime($row['date']))."<br> <br>";
}

// Message input
//-------------------------------------------- Message input --------------------------------------------
echo "<form action ='' method = 'post'>";
echo "<textarea name='message' rows='3' cols='100'> </textarea> &nbsp";
echo "<input type=submit name='submit'> ";
?>