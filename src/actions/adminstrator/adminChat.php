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

establishConnection();

isAdmin();

// Set read to true
//-------------------------------------------- Set read to true --------------------------------------------
$query = "UPDATE messages SET isRead = 1 WHERE fromUserID ='".$_GET['id']."'";
$result = $conn->query($query);
if (!$result){
    throw new Exception($query); 
}

// Send message
//-------------------------------------------- Send message --------------------------------------------
if (isset($_POST['submit']))
{
    $text_msg = $conn->real_escape_string($_POST['message']);
    $query = "INSERT INTO messages(fromUserID, toUserID, text, date) VALUES ('".$_SESSION['UserID']."','".$_GET['id']."','".$text_msg."', now())";
    $result = $conn->query($query);
    if (!$result){
        throw new Exception($query); 
    }
}

// Get messages history
//-------------------------------------------- Get messages history --------------------------------------------
$query = "SELECT * FROM messages WHERE fromUserID = '".$_GET['id']."' OR toUserID = '".$_GET['id']."'";
$result = $conn->query($query);
if (!$result){
    throw new Exception($query); 
}

$target = getProfilePicture($_GET['id']);

$day ="";
?>

<body class = 'chat-page'>
<div class = 'main-content col-lg-6'>


<div class="row chat-header ">
    <div class = "chat-about">
    <img class = "chat-header-img"src=<?php echo $target ?> alt="avatar">
    <label> <?php echo getUsername($_GET['id']);?> </label>
</div> 
</div>

<?php ?>

<div class = 'msgs'>

<?php

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
        echo "<b> You </b>";
    }
    else
    {
        echo "<div class = 'incoming-msg text-left'>";
        echo "<b>".getUsername($row["fromUserID"])." </b> <br>";
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

// Message input
//-------------------------------------------- Message input --------------------------------------------
?>

<form class='form-inline' action ='' method = 'post'>

<div class = 'row'>
    <input type = 'text' class='input-field form-control' placeholder = 'Type your message...' name='message'>
    <button type=submit name='submit' class='btn btn-primary icon-btn'> <i class='fas fa-paper-plane'></i></button>
</div>

</form>

</div>

</body>
