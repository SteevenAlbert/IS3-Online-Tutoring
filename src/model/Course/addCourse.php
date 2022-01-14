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

isAdminOrTutor();

 ?>

<!doctype html>
<html>

<head>
<title>Add Course</title>
</head>

<h1>Tutor</h1>
<h3>Add Courses</h3>

	<!-------------------------------------- Course Info -------------------------------------->
	<form  method ="POST" action="applyAddCourse.php">
		
		Code:<br> <input type='text' name='code'><br>
		Title:<br> <input type='text' name='title'><br>
		Description:<br> <textarea rows=4 cols=20  name=description></textarea><br>
		Hours:<br> <input type='text' name='hours'><br>
		
		<!-- Select Level -->
		Level:<br>
			<select name='level'>
			<?php
			$levels=array("Beginner","Intermediate","Hard");
			for($i=0;$i<count($levels);$i++){
				echo "<option>$levels[$i]</option>";
				}
			?>
			</select><br>
		
		Categorie:<br> <input type='text' name='categorie'><br>
		Price:<br> <input type='text' name='price'><br><br>

		<!--Created by current user -->
		Created By:
		<input hidden type='text' name='createdBy' value= <?php  echo $_SESSION['UserID']?>>
		<?php echo $_SESSION['username']?> <br><br>


	<a href="applyAddCourse.php">
	  <button>Save Course</button>
	</a>
	</form>
</body>
</html>