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

<link rel="stylesheet" href="../../../CSS/chatCSS.css">

<?php
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();

isAuditor();
//-------------------------------------------- Set read to true --------------------------------------------
$query = "UPDATE messages SET isReadAuditor = 1 WHERE fromUserID ='".$_GET['learner']."' OR (fromUserID = '".$_GET['admin']."' AND toUserID = '".$_GET['learner']."')";
    $result = $conn->query($query);
    try{
        if (!$result){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }


//-------------------------------------------- Get messages history --------------------------------------------
    $query="SELECT DISTINCT m.* , u.UserID , u.UserType ,u.FirstName
            FROM messages m 
            JOIN users u ON (m.fromUserID ='".$_GET['learner']."' OR m.toUserID = '".$_GET['learner']."') AND (u.UserID=m.fromUserID)";
    
    $result = $conn->query($query);
    try{
        if (!$result){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }



    $query2="SELECT UserID FROM users WHERE UserType='Auditor' ";
    $result2 = $conn->query($query2);
    try{
        if (!$result2){
            throw new Exception("Error Occured"); 
        }
                    
    }catch(Exception $e){  
       echo"Message:", $e->getMessage();  
    }
    

    while($row = $result->fetch_array(MYSQLI_ASSOC)){

        if ($row["UserType"]== 'Learner')
            echo "<b>".$row["FirstName"]." (Learner)</b> <br>";
        else if ($row["UserType"]== 'Administrator' && $row['fromUserID'] == $_GET['admin']){
            echo "<b>".$row["FirstName"]."(Admin)</b> <br>";
            ?>
            <form method="post" action="">
                 <button name='reply' id='reply' value='<?php echo $row['messageID'] ?>' >Reply</button>
            </form>
            <?php
            $messageID=$row['messageID'];
        }
        else if ($row["UserType"] == 'Administrator')
        {
            echo "<b>".$row["FirstName"]."(Admin)</b> <br>";
        }

        if ($row['text'] != NULL)
            echo $row["text"]."<br>";

        if ($row['link'] != NULL)
            echo "<a href='".$row['link'] ."'>". $row['link']."</a> <br>";
        
        if ($row['file'] != NULL)
            echo "<img src = '/IS3-Online-Tutoring/uploads/messagesFiles/messagesFiles/".$row['file'] ."' width = 300> <br>";
        
            echo date('H:i:s d-m-Y ', strtotime($row['date']))."<br> <br>";
    }


//---------------------------------------------------------- Click on reply button -----------------------------------------
if (isset($_POST['reply']))
{
    echo "<form action ='' method = 'post' enctype = 'multipart/form-data'>";
    echo "<textarea name='message' rows='3' cols='100'> </textarea> <br><br>";
    echo "<input type = text hidden name='replyTo' value =".$_POST['reply'].">";
    echo "<input type=submit name='submitReply' value='Submit'> ";
}

//---------------------------------------------------------- Send reply message to Admin ---------------------------------------------
if(isset($_POST['submitReply'])){
    if($_POST['message']){
        $replyQuery = "INSERT INTO messages(fromUserID, toUserID, text, isRead, date,parentMessageID) 
        VALUES ('".$_SESSION['UserID']."','".$_GET['admin']."','".$_POST['message']."',0, now(),'".$_POST['replyTo']."')";
            $replyResult = $conn->query($replyQuery);
            try{
                if (!$replyResult){
                    throw new Exception("Error Occured"); 
                }
                            
            }catch(Exception $e){  
               echo"Message:", $e->getMessage();  
            }
    }
}


?>