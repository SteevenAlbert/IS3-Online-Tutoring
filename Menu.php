<html>
	
	<body>		
		
			<?php
            if (isset($_SESSION['username'])){
				if($_SESSION['UserType']=="Learner"){
                    echo "Welcome Back, ".$_SESSION['FirstName']."!";
                    echo"<a href='home.php'>Home</a>  &nbsp; &nbsp;";
					echo"Categories  &nbsp;&nbsp; ";
                    echo "<a href=ViewCourses.php>View All Courses</a> &nbsp; &nbsp;";
                    echo "<a href='enrolledCourses.php'>View Enrolled Courses</a>  &nbsp; &nbsp;";
                    echo"<a href='cart.php'>Cart</a>  &nbsp; &nbsp;"; 
                    echo "Edit Profile &nbsp; &nbsp;";
                    echo "<a href=contactUs.php>Contact us</a> &nbsp; &nbsp;";
                    echo "<a href=logout.php>Logout</a> &nbsp; &nbsp;";
                    echo"<form> <input type = 'text' placeholder = 'Search' name = 'search'> 
                    <input type = 'submit' value = 'Go'>  </form>";
                    
                }else if($_SESSION['UserType']=="Tutor")
                { 
                    echo "Welcome Back, ".$_SESSION['FirstName']."! &nbsp; &nbsp;";
                    echo"<a href='home.php'>Home</a>  &nbsp; &nbsp;";
					echo"Categories  &nbsp;&nbsp; ";
                    echo "<a href=ViewCourses.php>View All Courses</a> &nbsp; &nbsp;";
                    echo "<a href=addCourse.php>Add Course</a> &nbsp; &nbsp;";
                    echo "View Enrolled Courses &nbsp; &nbsp;";
                    echo "Edit Profile &nbsp; &nbsp;";
                    echo "<a href=logout.php>Logout</a> &nbsp; &nbsp;";
                    echo"<form> <input type = 'text' placeholder = 'Search' name = 'search'> 
                    <input type = 'submit' value = 'Go'>  </form>";
                }
                else if($_SESSION['UserType']=="administrator")
                { 
                    echo "Welcome Back, ".$_SESSION['FirstName']."! &nbsp; &nbsp;";
                    echo"<a href='home.php'>Home</a>  &nbsp; &nbsp;";
					echo"Categories  &nbsp;&nbsp; ";
                    echo "<a href=ViewCourses.php>View All Courses</a> &nbsp; &nbsp;";
                    echo "<a href=addCourse.php>Add Course</a> &nbsp; &nbsp;";
                    echo "<a href=createAdministrator.php> Create Administrator</a> &nbsp; &nbsp;";
                    echo "<a href=ViewAdministrators.php>View Administrators</a> &nbsp; &nbsp;";
                    echo "<a href=ViewLearners.php>View Learners</a> &nbsp; &nbsp;";
                    echo "<a href=learnersMessagesList.php>Messages</a> &nbsp; &nbsp;";
                    echo "<a href=logout.php>Logout</a> &nbsp; &nbsp;";
                    echo"<form> <input type = 'text' placeholder = 'Search' name = 'search'> 
                    <input type = 'submit' value = 'Go'>  </form>";
                }
            }
            else
            {
                echo "Welcome  &nbsp; &nbsp;"; 
                echo"<a href='home.php'>Home</a>  &nbsp; &nbsp;";
                echo"Categories  &nbsp;&nbsp; ";
                echo"<a href='TutorRegisterForm.php'>Register as a tutor</a>  &nbsp; &nbsp;";
                echo"<a href='loginForm.php'>Sign in</a>  &nbsp; &nbsp; ";  
                echo"<a href='RegisterForm.php'>Sign Up</a>  &nbsp; &nbsp; "; 
                echo"<form> <input type = 'text' placeholder = 'Search' name = 'search'> 
                <input type = 'submit' value = 'Go'>  </form>";
                    
            }
			?>
	
		<br><br>
	</body>
</html>