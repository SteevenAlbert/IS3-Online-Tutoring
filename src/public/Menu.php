<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vquery/5.0.1/v.min.js"></script>
<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/menu.css" type="text/css">

<html>
	<body>				
		<?php
        include_once "is3library.php";
        $root = getRoot();
            //------------------------------ Existing User ------------------------------ 
            if (isset($_SESSION['username'])){
				if($_SESSION['UserType']=="Learner"){
                    ?>
                        <nav class="navbar navbar-custom ">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="/<?php echo $root ?>/src/public/home.php">IS3 Tutoring</a>
                            </div>
                            <ul class="nav col-s-4 navbar-nav">
                                <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/categories.php"> Categories</a> </li>
                                <li>
                                <form class = "navbar-form " action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">
                                        <input class= "search-box" type = 'text' placeholder = 'Search' name = 'search' required>  
                                    </div>       
                                </form> 
                                </li>
                            </ul> 

                            <ul class="nav navbar-nav navbar-right">
                                <li> <a href="/<?php echo $root ?>/src/model/Cart/cart.php"><img class="navbar-icons" src="\<?php echo $root ?>\resources\images\icons\cart.png"></a></li> 
                                <li> <a href="/<?php echo $root ?>/src/view/ViewNotifications.php"><img class="navbar-icons" src="\<?php echo $root ?>\resources\images\icons\notification.png"></a></li>       
                                <li> <a href="/<?php echo $root ?>/src/view/viewEnrolledCourses.php"><button class="button2"><span>My Courses</span></button></a> </li>
                                <li>
                                    <div class="dropdown dropdown-custom">
                                        <img class="dropdown-toggle dropdown-toggle-custom" src="/<?php echo $root?>/uploads/profile_pictures/<?php echo $_SESSION['PP'] ?>" data-toggle="dropdown" class="img-responsive">
                                        <ul class="dropdown-menu dropdown-menu-custom" role="menu" aria-labelledby="imageDropdown">
                                            <h3> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName'] ?> </h3>
                                            <li role="presentation" class="divider"></li>
                                         
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/model/user/editProfile.php">Edit Profile</a></li>       
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/actions/learner/contactUs.php">Contact Us</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/public/logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <?php

                }else if($_SESSION['UserType']=="Tutor")
                { ?>
                    <nav class="navbar navbar-custom ">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="/<?php echo $root ?>/src/public/home.php">IS3 Tutoring</a>
                            </div>
                            <ul class="nav col-s-4 navbar-nav">
                                <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/categories.php"> Categories</a> </li>
                                <li>
                                <form class = "navbar-form " action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">
                                        <input class= "search-box" type = 'text' placeholder = 'Search' name = 'search' required>  
                                    </div>       
                                </form> 
                                </li>
                            </ul> 
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item"> <a href="/<?php echo $root ?>/src/view/viewTutorCourses.php">My Courses</a> </li>
                                <li> <a href="/<?php echo $root ?>/src/model/course/addCourse.php"><button class="button"><span>Add Course</span></button></a> </li>
                                <li>
                                    <div class="dropdown dropdown-custom">
                                        <img class="dropdown-toggle dropdown-toggle-custom" src="/<?php echo $root?>/uploads/profile_pictures/<?php echo $_SESSION['PP'] ?>" alt="dropdown image" data-toggle="dropdown" class="img-responsive">
                                        <ul class="dropdown-menu dropdown-menu-custom" role="menu" aria-labelledby="imageDropdown">
                                            <h3> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName'] ?> </h3>
                                            <li role="presentation" class="divider"></li> 
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/model/user/editProfile.php">Edit Profile</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sent Notifications</a></li>         
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/public/logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                <?php }
                else if($_SESSION['UserType']=="Administrator")
                { /*
                    echo"<a href=/$root/src/public/home.php>Home</a>  &nbsp; &nbsp;";
					echo"<a href=/$root/src/public/categories.php> Categories</a> &nbsp; &nbsp; ";
                    echo "<a href=/$root/src/view/viewPendingCourses.php>Pending Courses</a> &nbsp; &nbsp;";
                    echo "<a href=/$root/src/view/viewApprovedCourses.php>View All Courses</a> &nbsp; &nbsp;";
                   
                   
           */
                    ?>
                    <nav class="navbar navbar-custom ">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="/<?php echo $root ?>/src/public/home.php">IS3 Tutoring</a>
                            </div>
                            <ul class="nav col-s-4 navbar-nav">
                                <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/categories.php"> Categories</a> </li>
                                <li>
                                <form class = "navbar-form " action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">
                                        <input class= "search-box" type = 'text' placeholder = 'Search' name = 'search' required>  
                                    </div>       
                                </form> 
                                </li>
                            </ul> 
                            <ul class="nav navbar-nav navbar-right">
                                <li> <a href="/<?php echo $root ?>/src/view/viewPendingCourses.php">Pending Courses</a> </li>
                                <li> <a href="/<?php echo $root ?>/src/view/viewAdminMessagesList.php">Messages</a> </li>
                                <li> <a href="/<?php echo $root ?>/src/view/viewStatistics.php">Statistics</a> </li>
                                <li> <a href="/<?php echo $root ?>/src/view/viewOrders.php">Orders</a> </li>
                             
                                <li>
                                    <div class="dropdown">
                                            <button class="btn btn-custom btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" >   
                                                <i class="fa fa-th-list fa-lg" aria-hidden="true"></i>
                                            </button>
                                      
                                        <ul class="dropdown-menu dropdown-menu-custom" role="menu" aria-labelledby="imageDropdown">
                                            <h3> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName'] ?> </h3>
                                            <li role="presentation" class="divider"></li>  
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/model/user/editProfile.php">Edit Profile</a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/model/Course/addCourse.php">Add Course</a></li>   
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/view/viewApprovedCourses.php">View Approved Courses</a></li>
                 
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/model/User/Adminstrator/createAdministrator.php">Create Adminstrator</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/view/ViewAdministrators.php">View Adminstrators</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/view/ViewLearners.php">View Learners</a></li>
                                           
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/public/logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>




                <?php }
                else if($_SESSION['UserType']=="Auditor")
                { /*
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
                */?>
                 <nav class="navbar navbar-custom ">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="/<?php echo $root ?>/src/public/home.php">IS3 Tutoring</a>
                            </div>
                            <ul class="nav col-s-4 navbar-nav">
                                <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/categories.php"> Categories</a> </li>
                                <li>
                                <form class = "navbar-form " action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">
                                        <input class= "search-box" type = 'text' placeholder = 'Search' name = 'search' required>  
                                    </div>       
                                </form> 
                                </li>
                            </ul> 
                            <ul class="nav navbar-nav navbar-right">
                          
                                <li> <a href="/<?php echo $root ?>/src/view/viewAuditorMessagesList.php">Messages</a> </li>
                             
                                <li>
                                    <div class="dropdown">
                                            <button class="btn btn-custom btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" >   
                                                <i class="fa fa-th-list fa-lg" aria-hidden="true"></i>
                                            </button>
                                      
                                        <ul class="dropdown-menu dropdown-menu-custom" role="menu" aria-labelledby="imageDropdown">
                                            <h3> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName'] ?> </h3>
                                            <li role="presentation" class="divider"></li>  
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/model/user/editProfile.php">Edit Profile</a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/<?php echo $root ?>/src/public/logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

            



            <?php }
            }
            //------------------------------ Guest ------------------------------ 
            else
            {
                ?>
                <nav class="navbar navbar-custom ">
                 <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/<?php echo $root ?>/src/public/home.php">IS3 Tutoring</a>
                    </div>
                    <ul class="nav col-s-4 navbar-nav">
                        <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/categories.php"> Categories</a> </li>
                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/home.php">Featured</a> </li>
                        <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/RegisterForm.php?id=tutor">Teach on IS3</a> </li>
                        <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/loginForm.php">Sign in</a> </li>
                       <li> <a href="/<?php echo $root ?>/src/public/RegisterForm.php?id=learner"><button class="button"><span>Sign Up </span></button></a> </li>
                       
                   </ul>
                    <form class = "navbar-form " action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                        <div class="form-group">
                            <input class= "search-box" type = 'text' placeholder = 'Search' name = 'search' required>  
                        </div>
                                 
                    </form>    
                   
               </div>
            </nav>
           <?php } ?>
	</body>
</html>