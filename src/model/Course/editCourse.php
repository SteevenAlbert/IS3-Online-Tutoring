
<?php 
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
 ?>
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
<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/addCourse.css" type="text/css">


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Courses</title>
</head>

<body>


<div class="container">
<div class="ImagePanel">
		<img src="/IS3-Online-Tutoring/uploads/backgroundImages/addCourseImage.jpg">
	</div>
	<div class="FormPanel">
		<h1>Edit Course</h1>
		<?php
		$query = "SELECT * FROM courses WHERE CourseID =" .$_GET["id"];
        $results = $conn-> query($query);
		
		if(!$results)
        die("Fatal error in executing the edit");
		
		 while($row = $results->fetch_array(MYSQLI_ASSOC)) {
			$ID=$row["CourseID"]; 
			$code=$row["Code"];
			$Title=$row["Title"];
			$Description=$row["Description"];
			$Hours=$row["Hours"];
			$Level=$row["Level"];
			$Price=$row["Price"];
			$category=$row['Categories'];
			$CreatedBy=$row["CreatedBy"];
		?>
		<form  method ="POST" action="applyEditCourse.php">
			<div class="row">
				<div class="col-lg-6">
					<label style="color:black;">Code:</label>
					<input type="text" name='code' id="code" value = "<?php echo $code ?>" placeholder="eg. EC204" class="form-control" required>
				</div>
				<div class="col-lg-6" style="margin-bottom:3%">
					<label>Title</label>
					<input type="text" name='title' id="title" value = "<?php echo $Title ?>" placeholder="eg. Economics" class="form-control" required>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label for="description">Description:</label>
							<textarea class="form-control" rows="5"  name="description" id="description"><?php echo $Description ?></textarea>
						</div>
					</div>
				</div>

			<div class="row">
				<div class="col-lg-6">
					<label>Hours:</label>
					<input type="text" name='hours' id="hours" value ="<?php echo $Hours ?>" placeholder="36" class="form-control" required>
				</div>
				<div class="col-lg-6" style="margin-bottom:3%">
				<label for="level">Level:</label>
				<select name='level' value ="<?php echo $Level ?>" class="form-control" data-role="select-dropdown">
				<?php
					$levels=array("Beginner","Intermediate","Hard");
					for($i=0;$i<count($levels);$i++){
						echo "<option>$levels[$i]</option>";
						}
				?>
				</select>
				</div>
			</div>
			<?php echo "<input type = text hidden name='CourseID' value = $ID><br>";?>
			<div class="row">
			<div class="col-lg-8">
					<div class="form-group">
						<label for="category">category:</label>
						<input type='text' class="form-control"  value ="<?php echo $category ?>"name='category' required>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label for="price">Price:</label>
						<input type='text' class="form-control" name='price'  value ="<?php echo $Price ?>" required>
					</div>
				</div>
			</div>
			<a href="applyEditCourse.php">
				<button class="button button-custom">Update Course</button>
			</a>
		</form>
		<a href="applyDeleteCourse.php?id=<?php echo $ID ?>">
			<button class="button button-custom2">Delete Course</button>
		</a>
	</div>
</div>
		
<?php } ?>
	
</body>
</html>