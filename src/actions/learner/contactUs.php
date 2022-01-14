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

<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/chat.css" type="text/css">

<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
establishConnection();

isLearner();

//--------------------------------------------- Send message ---------------------------------------------
if (isset($_POST['submit']))
{
    $fileName = time() .'_'.$_FILES['messageFile']['name'];
    $fileTempName = $_FILES['messageFile']['tmp_name'];

    $target='/xampp/htdocs/IS3-Online-Tutoring/uploads/messagesFiles/'. $fileName;
    $fileMove = move_uploaded_file($fileTempName, $target);

    // Insert file in Database if move was successful 
    if(!empty($_POST['link'])){
        if(filterLink($_POST['link'])){
            $_POST['link'] = filter_var($_POST['link'],FILTER_SANITIZE_URL);
        }
    }
      $text_msg = $conn->real_escape_string($_POST['message']);
      
        if($fileMove){

            $query = "INSERT INTO messages(fromUserID, text, link, file, isRead, date) VALUES ('".$_SESSION['UserID']."','$text_msg','".$_POST['link']."', '$fileName', 0, now())";
            $result = $conn->query($query);
            try{
                if (!$result){
                    throw new Exception("Error Occured"); 
                }
                            
            }catch(Exception $e){  
               echo"Message:", $e->getMessage();  
            }
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
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}


$day ="";
echo "<body class = 'chat-page'>";
echo "<div class = 'main-content col-lg-6'>";
echo "<div class = 'msgs'>";
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    echo "<div class = 'row text-center'>";

    if (date('d-m-Y ', strtotime($row['date'])) != $day)
    {
        echo "<label>".date('d-m-Y ', strtotime($row['date']))."</label>";
    }

    $day = date('d-m-Y ', strtotime($row['date']));
    echo "</div>";

    
    echo "<div class = 'row'>";
    if ($row["fromUserID"]== $_SESSION['UserID'])
    {
        echo "<div class = 'outgoing-msg text-right'>";
    }
    else
    {
        echo "<div class = 'incoming-msg text-left'>";
    }

    echo "<div class = 'msg-content'>";
    if ($row['text'] != NULL)
        echo $row["text"]."<br>";

    if ($row['link'] != NULL)
        echo "<a href='".$row['link'] ."'>". $row['link']."</a> <br>";
    
    if ($row['file'] != NULL)
        echo "<img src = '/IS3-Online-Tutoring/uploads/messagesFiles/".$row['file'] ."' width = 300> <br>";

    echo "</div>";
    echo "<small class='date text-muted'>".date('H:i', strtotime($row['date']))."</small>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";

//--------------------------------------------- Message input ---------------------------------------------
?>
<form class='form-inline' action ='' method = 'post' enctype = 'multipart/form-data'>

<div class = 'row'>
<input type = 'text' class='input-field form-control' placeholder = 'Type your message...' name='message'>
<button type=submit name='submit' class='btn btn-primary icon-btn'> <i class='fas fa-paper-plane'></i></button>
</div>

<div class = 'row'>
<input type='url' class='input-field form-control' placeholder = 'Enter a url' name='link'>
<input type='file' class="custom-file-input" name='messageFile' id ='messageFile'>
</div>


</form>
</div>

</body>

