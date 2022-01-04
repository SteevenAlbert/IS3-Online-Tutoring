<html>
	<body>				
		<?php
        include_once "is3library.php";
        $root = getRoot();
            //------------------------------ Existing User ------------------------------ 
            if (isset($_SESSION['username'])){
				if($_SESSION['UserType']=="Learner"){
                
                    echo"<a href=/$root/src/public/home.php>Home</a>  &nbsp; &nbsp;";
                    echo"<a href=/$root/src/public/categories.php> Categories</a> &nbsp; &nbsp; ";
                    echo "<a href=/$root/src/view/viewApprovedCourses.php>View All Courses</a> &nbsp; &nbsp;";
                    echo "<a href='/$root/src/view/viewEnrolledCourses.php'>View Enrolled Courses</a>  &nbsp; &nbsp;";
                    echo"<a href='/$root/src/model/Cart/cart.php'>Cart</a>  &nbsp; &nbsp;"; 
                    echo "<a href=/$root/src/model/User/editProfile.php>Edit Profile</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/actions/learner/contactUs.php>Contact us</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewNotifications.php>Notifications</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/public/logout.php>Logout</a> &nbsp; &nbsp;";
                    echo"<form action = 'courseSearch.php' method = 'post'> 
                    <input type = 'text' placeholder = 'Search' name = 'search' required> 
                    <input type = 'submit' value = 'Go'>  </form>";
                }else if($_SESSION['UserType']=="Tutor")
                { 
                    echo"<a href=/$root/src/public/home.php>Home</a>  &nbsp; &nbsp;";
					echo"<a href=/$root/src/public/categories.php> Categories</a> &nbsp; &nbsp; ";
                    echo "<a href=/$root/src/view/viewTutorCourses.php>View My Courses</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewApprovedCourses.php>View All Courses</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/Course/addCourse.php>Add Course</a> &nbsp; &nbsp;";
                    // echo "View Enrolled Courses &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/User/editProfile.php>Edit Profile</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/public/logout.php>Logout</a> &nbsp; &nbsp;";
                    echo"<form action = '/$root/src/actions/courseSearch.php' method = 'post'> 
                    <input type = 'text' placeholder = 'Search' name = 'search' required> 
                    <input type = 'submit' value = 'Go'>  </form>";
                }
                else if($_SESSION['UserType']=="Administrator")
                { 
                    echo"<a href=/$root/src/public/home.php>Home</a>  &nbsp; &nbsp;";
					echo"<a href=/$root/src/public/categories.php> Categories</a> &nbsp; &nbsp; ";
                    echo "<a href=/$root/src/view/viewPendingCourses.php>Pending Courses</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewApprovedCourses.php>View All Courses</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/Course/addCourse.php>Add Course</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/User/Adminstrator/createAdministrator.php> Create Administrator</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/ViewAdministrators.php>View Administrators</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/ViewLearners.php>View Learners</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewOrders.php>View Orders</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewAdminMessagesList.php>Messages</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/User/editProfile.php>Edit Profile</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/public/logout.php>Logout</a> &nbsp; &nbsp;";
                    echo"<form action = '/$root/src/actions/courseSearch.php' method = 'post'> 
                    <input type = 'text' name = 'search' placeholder = 'Search' required> 
                    <input type = 'submit' value = 'Go'>  </form>";
                }
                else if($_SESSION['UserType']=="Auditor")
                { 
                    echo "Welcome Back, ".$_SESSION['FirstName']."! &nbsp; &nbsp;";
                    echo"<a href=/$root/src/public/home.php>Home</a>  &nbsp; &nbsp;";
					echo"<a href=/$root/src/public/categories.php> Categories</a> &nbsp; &nbsp; ";
                    echo "<a href=/$root/src/view/viewPendingCourses.php>Pending Courses</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewApprovedCourses.php>View All Courses</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/Course/addCourse.php>Add Course</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/User/Adminstrator/createAdministrator.php> Create Administrator</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/ViewAdministrators.php>View Administrators</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/ViewLearners.php>View Learners</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewOrders.php>View Orders</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewAuditorMessagesList.php>Messages</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/model/User/editProfile.php>Edit Profile</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/public/logout.php>Logout</a> &nbsp; &nbsp;";
                    echo"<form action = '/$root/src/actions/courseSearch.php' method = 'post'> 
                    <input type = 'text' name = 'search' placeholder = 'Search' required> 
                    <input type = 'submit' value = 'Go'>  </form>";
                }
            }
            //------------------------------ Guest ------------------------------ 
            else
            {

                echo "Welcome  &nbsp; &nbsp;"; 
                echo"<a href=/$root/src/public/home.php>Home</a>  &nbsp; &nbsp;";
                echo"<a href=/$root/src/public/categories.php> Categories</a> &nbsp; &nbsp; ";
                echo"<a href=/$root/src/model/User/Tutor/TutorRegisterForm.php>Register as a tutor</a>  &nbsp; &nbsp;";
                echo"<a href=/$root/src/public/loginForm.php>Sign in</a>  &nbsp; &nbsp; ";  
                echo"<a href=/$root/src/public/RegisterForm.php>Sign Up</a>  &nbsp; &nbsp; "; 
                echo"<form action = '/$root/src/actions/courseSearch.php' method = 'post'> 
                <input type = 'text' placeholder = 'Search' name = 'search'required> 
                <input type = 'submit' value = 'Go'>  </form>";                   
            }
		?>
	
		<br><br>
	</body>
</html>