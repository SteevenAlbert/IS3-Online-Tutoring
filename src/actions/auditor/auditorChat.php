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

isAuditor();
//-------------------------------------------- Set read to true --------------------------------------------
$query = "UPDATE messages SET isReadAuditor = 1 WHERE fromUserID ='".$_GET['learner']."' OR (fromUserID = '".$_GET['admin']."' AND toUserID = '".$_GET['learner']."')";
    $result = $conn->query($query);
    if (!$result){
        throw new Exception($query); 
    }

//-------------------------------------------- Get messages history --------------------------------------------
    $query="SELECT DISTINCT m.* , u.UserID , u.UserType ,u.FirstName
            FROM messages m 
            JOIN users u ON (m.fromUserID ='".$_GET['learner']."' OR m.toUserID = '".$_GET['learner']."') AND (u.UserID=m.fromUserID)";
    
    $result = $conn->query($query);
    if (!$result){
        throw new Exception($query); 
    }
                    

    $query2="SELECT UserID FROM users WHERE UserType='Auditor' ";
    $result2 = $conn->query($query2);
    if (!$result2){
        throw new Exception($query2); 
    }

    $target = getProfilePicture($_GET['learner']);
    $day ="";
?>

<body class = 'chat-page'>
<div class = 'main-content col-lg-6'>


<div class="row chat-header ">
    <div class = "chat-about">
    <img class = "chat-header-img"src=<?php echo $target ?> alt="avatar">
    <label> <?php echo getUsername($_GET['learner']);?> </label>
</div> 
</div>

<?php ?>



<div class = 'msgs'>

<?php

    while($row = $result->fetch_array(MYSQLI_ASSOC)){

        echo "<div class = 'row text-center'>";

        if (date('d-m-Y ', strtotime($row['date'])) != $day)
        {
            echo "<label>".date('d-m-Y ', strtotime($row['date']))."</label>";
        }

        $day = date('d-m-Y ', strtotime($row['date']));
        echo "</div>";

        echo "<div class = 'row col-lg-12'>";
        

        if ($row["UserType"]== 'Learner')
        {
            echo "<div class = 'incoming-msg gray text-left col-lg-9'>";
            echo "<b>".$row["FirstName"]." (Learner)</b> <br>";
        }
        else if ($row["UserType"]== 'Administrator' && $row['fromUserID'] == $_GET['admin']){
            echo "<div class = 'incoming-msg text-left col-lg-9'>";
            echo "<b>".$row["FirstName"]."(Admin)</b> <br>";
            $messageID=$row['messageID'];
        }
        else if ($row["UserType"] == 'Administrator')
        {
            echo "<div class = 'incoming-msg gray text-left col-lg-9'>";
            echo "<b>".$row["FirstName"]."(Admin)</b> <br>";
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

        if ($row["UserType"]== 'Administrator' && $row['fromUserID'] == $_GET['admin']){
            ?>
            <div class = "col-lg-3">
            <form method="post" action="">
                 <button name='reply' class='btn btn-primary icon-btn reply-btn' id='reply' value='<?php echo $row['messageID'] ?>' ><i class="fas fa-comment"></i></button>
            </form>
            </div>
            <?php
        }
        
        echo "</div>";
    }
    echo "</div>";

//---------------------------------------------------------- Click on reply button -----------------------------------------
if (isset($_POST['reply']))
{
    echo "<form class='form-inline' action ='' method = 'post' enctype = 'multipart/form-data'>";
    echo "<input type = 'text' class='input-field form-control' placeholder = 'Type your message...' name='message'>";
    echo "<input type = text hidden name='replyTo' value =".$_POST['reply'].">";
    echo "<button type=submit name='submitReply' class='btn btn-primary icon-btn'> <i class='fas fa-paper-plane'></i></button> ";
}

//---------------------------------------------------------- Send reply message to Admin ---------------------------------------------
if(isset($_POST['submitReply'])){
    if($_POST['message']){
        $replyQuery = "INSERT INTO messages(fromUserID, toUserID, text, isRead, date,parentMessageID) 
        VALUES ('".$_SESSION['UserID']."','".$_GET['admin']."','".$_POST['message']."',0, now(),'".$_POST['replyTo']."')";
            $replyResult = $conn->query($replyQuery);
            if (!$replyResult){
                throw new Exception($replyQuery); 
            }
    }
}


?>

</div>

</body>