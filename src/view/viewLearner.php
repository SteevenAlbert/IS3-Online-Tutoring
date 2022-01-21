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


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">


<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
?>
<link rel="stylesheet" href="../../CSS/view.css">
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
establishConnection();
isAdmin();

//------------------------------ Get user info ---------------------------------------
//query for learners(profile picture)
$query = "SELECT u.*, l.profile_picture from users u, learners l where u.UserID = '".$_GET["id"]."' AND u.UserID=l.UserID";
$result = $conn->query($query);

if (!$result){
	throw new Exception($query); 
}

//get Enrolled Courses
$coursesQuery = "SELECT * FROM enroll WHERE UserID='".$_GET['id']."' ";
$enrolledCoursesResult = $conn->query($coursesQuery);

if (!$enrolledCoursesResult){
	throw new Exception($coursesQuery); 
}


//query for admins
$query_admin = "SELECT * from users where UserID = '".$_GET["id"]."'";
$result_admin = $conn->query($query_admin);

if (!$result_admin){
	throw new Exception($query_admin); 
}

//------------------------------ Display user info ---------------------------------------
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
	if ($row['UserType'] == "Learner"){
		$pp = getProfilePicture($row['UserID']);			
		?>
		<container>		
			<div class="leftPanel col-md-6">
				<img id="viewLearnerImage" src="../../uploads/backgroundImages/viewLearnerImage.png" alt="viewLearnerImage" width="600" height="600">
			</div>

			<div class="rightPanel col-md-6">
				<div class="InfoCard center-block text-center ">	
					<div class="row ">
						<div class="circular-landscape center-block">
							<img src=<?php echo $pp ?> class="profileDisplay" alt='avatar'>	
						</div>		
					</div>
				

					<!-- User Details -->		 
						<div class="row">
							<div id="viewAdminData">
								<h1><?php echo "".$row["FirstName"]."" . " ".$row["LastName"].""; ?></h1>
							</div>
						</div>
				
			
					<div class="row">
						<div class="col-lg-6" style="margin-bottom:3%">
							<label>Username</label>
								<div id="viewAdminData">
								<h4>	<?php echo "".$row["Username"].""; ?> 	</h4>
								</div>
						</div>
						<div class="col-lg-6" style="margin-bottom:3%">
							<label>Email</label>
								<div id="viewAdminData">
									<?php echo "".$row["Email"].""; ?>
								</div>
						</div>
					</div>
			
					<div class="row">
						<div class="col-lg-6">
							<label>Number</label>
								<div id="viewAdminData">
									<?php echo "".$row["PhoneNumber"].""; ?>
								</div>
						</div>
						<div class="col-lg-6" style="margin-bottom:3%">
							<label>Country</label>
								<div id="viewAdminData">
									<?php echo "".$row["Country"].""; ?>
								</div>
						</div>
					</div>
			
					<div class="row">
						<div class="col-lg-12" style="margin-bottom:3%">
							<label>Birth Date</label>
								<div id="viewAdminData">
									<?php echo "".$row["BirthDate"].""; ?>
								</div>
						</div>
					</div>

					<h2>Enrolled Courses</h2>
				<?php
					while($row = $enrolledCoursesResult->fetch_array(MYSQLI_ASSOC)){
						$CourseID = $row['CourseID'];

						$getCourseName = "SELECT Title FROM courses where CourseID='$CourseID'";
						$CourseNameResult = $conn->query($getCourseName);
						if (!$CourseNameResult)
							throw new Exception($getCourseName);
						$nameRow = $CourseNameResult->fetch_array(MYSQLI_ASSOC);
						$name = $nameRow['Title'];
						echo "<li class='list-group-item list-group-item-action'> <a  href=viewCourseDetails.php?id=$CourseID> $name </a></li>"; 
					}
				?>
				</div>
	</div>
			<?php
			}
		}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>


</body>
</html>