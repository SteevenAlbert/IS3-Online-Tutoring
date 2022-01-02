<link rel="stylesheet" href="chatCSS.css">
<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

//-------------------------------------------- Set read to true --------------------------------------------
$query = "UPDATE messages SET isRead = 1 WHERE fromUserID ='".$_GET['id']."'";
    $result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");

//-------------------------------------------- Send message --------------------------------------------
if (isset($_POST['submit']))
{
    $query = "INSERT INTO messages(fromUserID, toUserID, text, date) VALUES ('".$_SESSION['UserID']."','".$_GET['id']."','".$_POST['message']."', now())";
    $result = $conn->query($query);
    if (!$result)
        die ("Query error. $query");
}

//-------------------------------------------- Get messages history --------------------------------------------
$query = "SELECT * FROM messages WHERE fromUserID = '".$_GET['id']."' OR toUserID = '".$_GET['id']."'";
$result = $conn->query($query);
if (!$result)
    die ("Query error. $query");


while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    if ($row["fromUserID"]== $_SESSION['UserID']){
        echo "<b> You: </b> <br>";
    }
    else
        echo "<b>".getUsername($row["fromUserID"]).": </b> <br>";

    if ($row['text'] != NULL)
        echo $row["text"];
        ///LOOP TO ADD WHITESPACE
        for($i=0; $i<30;$i++){
           // White Space
            ?>&nbsp; <?php
        }

//--------------------------------------------Auditor Reply on Admin --------------------------------------------
    $auditorQuery="SELECT * FROM messages WHERE parentMessageID='".$row["messageID"]."' ";
    $auditorResult = $conn->query($auditorQuery);
    if (!$auditorResult)
        die ("Query error. $auditorQuery");
    else{
        while($auditorRow = $auditorResult->fetch_array(MYSQLI_ASSOC)){
        ?>
        <div id="auditorReply"> 
            <?php
                echo "<b> Auditor: ".$auditorRow['text']."</b>" ;
            ?>
            </div>
        <?php
        }
    }
    
    echo "<br>";
    if ($row['link'] != NULL)
        echo "<a href='".$row['link'] ."'>". $row['link']."</a> <br>";

    if ($row['file'] != NULL)
        echo "<img src = 'messagesFiles/".$row['file'] ."' width = 300> <br>";

    echo date('H:i:s d-m-Y ', strtotime($row['date']))."<br><br><br>";
    echo "<hr>";
}

//-------------------------------------------- Message input --------------------------------------------
echo "<form action ='' method = 'post'>";
echo "<textarea name='message' rows='3' cols='100'> </textarea> &nbsp";
echo "<input type=submit name='submit'> ";


?>