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

<html>
<link rel="stylesheet" href="../../../CSS/survey.css">
<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
 establishConnection();

 isLearner();
 ?>

    <h1><div style="font-size:50px;">Please fill this survey</div> </h1>
    <div style="margin-left:280px; font-size:22px;" ><i>1)Strongly Disagree - 5)Strongly Agree</i></div>
 <?php 
    echo "<br>";
//--------------------------------------------- Survey Questions ---------------------------------------------    
    $questions=array(
        "1) Was the course all conducted in English?",
        "2) Was the examples the tutor gave understandable?",
        "3) Did the tutor solve many questions?",
        "4) Was the resources and materials good enough?");
    ?>
    <form method="post" action="">
    <?php   
        $i=0;
        for($i;$i<count($questions);$i++){
            echo"<h4>".$questions[$i]."</h4>";
            ?>
                <div style="margin-left:350px;" >
                     1.<input type="radio" name=<?php echo $i; ?>  value="1" required>
                     2.<input type="radio" name=<?php echo $i; ?>  value="2">
                     3.<input type="radio" name=<?php echo $i; ?>  value="3">
                     4.<input type="radio" name=<?php echo $i; ?>  value="4">
                     5.<input type="radio" name=<?php echo $i; ?>  value="5">
                </div>
            <?php
                    echo "<br><br>";
                 }
    //--------------------------------------------- Message input ---------------------------------------------
             echo "remarks:<br>";
             echo "<textarea name='message' rows='3' cols='100'> </textarea> <br>";
             ?>
             <input type='submit' name='submit'>
    </form>
        <?php

            
           if (isset($_POST['submit']))
           {
               //echo"hello";
               $fromLearnerID=$_SESSION['UserID'];
               $toTutorID=$_GET['TutorID'];
               $courseID=$_GET['CourseID'];
               $text_msg = $conn->real_escape_string($_POST['message']);

               $query = "INSERT INTO survey (fromLearnerID,toTutorID,courseID,question1,question2,question3,question4,remarks)
                VALUES ('".$fromLearnerID."','".$toTutorID."','".$courseID."','".$_POST['0']."','".$_POST['1']."','".$_POST['2']."','".$_POST['3']."','".$text_msg."')";

                $result = $conn->query($query);
                try{
                    if (!$result_sql){
                        throw new Exception("Error Occured"); 
                    }
                                
                }catch(Exception $e){  
                   echo"Message:", $e->getMessage();  
                }
           }


        ?>
</html>