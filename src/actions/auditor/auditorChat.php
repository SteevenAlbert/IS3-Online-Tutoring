<link rel="stylesheet" href="../../../CSS/chatCSS.css">

<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();
//-------------------------------------------- Set read to true --------------------------------------------
$query = "UPDATE messages SET isReadAuditor = 0 WHERE fromUserID ='".$_GET['id']."'";
    $result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");


//-------------------------------------------- Get messages history --------------------------------------------
    $query="SELECT DISTINCT m.* , u.UserID , u.UserType ,u.FirstName
            FROM messages m 
            JOIN users u ON (m.fromUserID ='".$_GET['id']."' OR m.toUserID = '".$_GET['id']."') AND (u.UserID=m.fromUserID)";
    $result = $conn->query($query);
    if (!$result)
    die ("Query error. $query");

    $query2="SELECT UserID FROM users WHERE UserType='Auditor' ";
    $result2 = $conn->query($query2);
    
//while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){

    while($row = $result->fetch_array(MYSQLI_ASSOC)){

        if ($row["UserType"]== 'Learner')
            echo "<b>".$row["FirstName"]." (Learner)</b> <br>";
        else if ($row["UserType"]== 'Administrator'){
            echo "<b>".$row["FirstName"]."(Admin)</b> <br>";
            ?>
            <form method="post" action="">
                 <button name='reply' id='reply' value='<?php echo $row['messageID'] ?>' >Reply</button>
            </form>
            <?php
            $messageID=$row['messageID'];
        }

        if ($row['text'] != NULL)
            echo $row["text"]."<br>";

        if ($row['link'] != NULL)
            echo "<a href='".$row['link'] ."'>". $row['link']."</a> <br>";
        
        if ($row['file'] != NULL)
            echo "<img src = 'messagesFiles/".$row['file'] ."' width = 300> <br>";
        
            echo date('H:i:s d-m-Y ', strtotime($row['date']))."<br> <br>";
    }
//}   

//---------------------------------------------------------- Click on reply button -----------------------------------------
if (isset($_POST['reply']))
{
    echo "<form action ='' method = 'post' enctype = 'multipart/form-data'>";
    echo "<textarea name='message' rows='3' cols='100'> </textarea> <br><br>";
    // echo "<input type='url' name='link' cols = '100'> &nbsp";
    // echo "<input type='file' name='messageFile' id ='messageFile'> <br>";
    echo "<input type=submit name='submitReply' value='Submit'> ";
}

//---------------------------------------------------------- Send reply message to Admin ---------------------------------------------
if(isset($_POST['submitReply'])){
    if($_POST['message']){
        $replyQuery = "INSERT INTO messages(fromUserID, text, isRead, date,parentMessageID) VALUES ('".$_SESSION['UserID']."','".$_POST['message']."',0, now(),'$messageID')";
            $replyResult = $conn->query($replyQuery);
            if (!$replyResult)
                die ("Query error. $replyQuery");
    }
}


    

?>