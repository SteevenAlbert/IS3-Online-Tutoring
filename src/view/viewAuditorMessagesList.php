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
?>

<div class = "page-content">

<div class = "side-img col-lg-7">
<img src='/IS3-Online-Tutoring/uploads/backgroundImages/mail-man.png' width = 1000>
</div>

<div id="plist" class="people-list col-lg-4">
    <div class='row title-section'>
        <h3 class='title'>Chats:</h3>
    </div>
    <ul class="list-unstyled chat-list mt-2 mb-0">

<?php
//-------------------------------------------- Show all unread messages (latest first) --------------------------------------------

$query = "SELECT DISTINCT m.fromUserID from messages as m, users as u
where m.fromUserID = u.UserID
AND u.UserType = 'Administrator'
AND m.isReadAuditor IS NULL ORDER BY m.date DESC";
$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}
echo "Unread chats: ";
echo mysqli_num_rows($result);


while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    echo "<a href = /IS3-Online-Tutoring/src/actions/auditor/chooseAdminMessages.php?admin=".$row['fromUserID'].">";
    echo "<li class='clearfix'>";
    echo "<img src='/IS3-Online-Tutoring/uploads/profile_pictures/default.png' alt='avatar'>";
    echo "<div class='about'>";
    echo "<div class='unread-chat'>".getUsername($row['fromUserID'])."</div>";
    echo "</div> </li>";
    echo "</a>";
}


//-------------------------------------------- Show all read messages --------------------------------------------
$query = "SELECT DISTINCT m1.fromUserID from messages as m1, users as u
where m1.fromUserID = u.UserID
AND u.UserType = 'Administrator' 
AND NOT EXISTS (SELECT m2.fromUserID FROM messages as m2 WHERE m2.isReadAuditor IS NULL AND m2.fromUserID = m1.fromUserID) ORDER BY date DESC";


$result = $conn->query($query);
try{
    if (!$result){
        throw new Exception("Error Occured"); 
    }
                
}catch(Exception $e){  
   echo"Message:", $e->getMessage();  
}

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    echo "<a href = /IS3-Online-Tutoring/src/actions/auditor/chooseAdminMessages.php?admin=".$row['fromUserID'].">";
    echo "<li class='clearfix'>";
    echo "<img src='/IS3-Online-Tutoring/uploads/profile_pictures/default.png' alt='avatar'>";
    echo "<div class='about'>";
    echo "<div class='read-chat'>".getUsername($row['fromUserID'])."</div>";
    echo "</div> </li>";
    echo "</a>";

}

?>

</ul>
</div>

</div>