<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	

<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/menu.css" type="text/css">

<html>
<head>
<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","/IS3-Online-Tutoring/src/view/viewSearchResults.php?search="+str,true);
  xmlhttp.send();
}
</script>
</head>
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
                            <li class="nav-item"> <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Categories</a></li>
                  
                            <li col-s-12>
                                <form class = "navbar-form" action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">                   
                                        <div class="input-wrapper">
                                            <div class="fa fa-search"></div>
                                            <input  type = 'text' tabIndex='0' placeholder = 'Search' name = 'search' id = 'searchbar' onkeyup="showResult(this.value)" required>                            
                                            <div class="fa fa-times"></div>
                                        </div>
                                    </div>    
                                    <div id="livesearch"></div>
                                </form> 
                                </li>
                         
                            </ul> 

                            <ul class="nav navbar-nav navbar-right">
                                <li> <a href="/<?php echo $root ?>/src/model/Cart/cart.php"><img class="navbar-icons" src="\<?php echo $root ?>\resources\images\icons\cart.png"></a></li> 
                                <li> <a href="/<?php echo $root ?>/src/view/ViewNotifications.php"><img class="navbar-icons" src="\<?php echo $root ?>\resources\images\icons\notification.png"></a></li>       
                                <li> <a href="/<?php echo $root ?>/src/view/viewEnrolledCourses.php"><button class="button"><span>My Courses</span></button></a> </li>
                                <li>
                                    <div class="dropdown dropdown-custom">
                                        <img class="dropdown-toggle dropdown-toggle-custom" src="/<?php echo $root?>/uploads/profile_pictures/<?php echo $_SESSION['PP'] ?>" data-toggle="dropdown" class="img-responsive">
                                        <ul class="dropdown-menu dropdown-menu-custom" role="menu" aria-labelledby="imageDropdown">
                                            <h3> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName'] ?> </h3>
                                            <p> <?php echo $_SESSION['UserType'] ?> </p>
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
                            <li class="nav-item"> <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Categories</a></li>
                            <li col-s-12>
                                <form class = "navbar-form" action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">                   
                                        <div class="input-wrapper">
                                            <div class="fa fa-search"></div>
                                            <input  type = 'text' tabIndex='0' placeholder = 'Search' name = 'search' id = 'searchbar' onkeyup="showResult(this.value)" required>                            
                                            <div class="fa fa-times"></div>
                                        </div>
                                    </div>    
                                    <div id="livesearch"></div>
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
                                            <p> <?php echo $_SESSION['UserType'] ?> </p>
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
                else if($_SESSION['UserType']=="Administrator")
                { 
                    ?>
                    <nav class="navbar navbar-custom ">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="/<?php echo $root ?>/src/public/home.php">IS3 Tutoring</a>
                            </div>
                            <ul class="nav col-s-4 navbar-nav">
                            <li class="nav-item"> <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Categories</a></li>
                            <li col-s-12>
                                <form class = "navbar-form" action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">                   
                                        <div class="input-wrapper">
                                            <div class="fa fa-search"></div>
                                            <input  type = 'text' tabIndex='0' placeholder = 'Search' name = 'search' id = 'searchbar' onkeyup="showResult(this.value)" required>                            
                                            <div class="fa fa-times"></div>
                                        </div>
                                    </div>    
                                    <div id="livesearch"></div>
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
                                            <p> <?php echo $_SESSION['UserType'] ?> </p>
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
                { ?>
                 <nav class="navbar navbar-custom ">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="/<?php echo $root ?>/src/public/home.php">IS3 Tutoring</a>
                            </div>
                            <ul class="nav col-s-4 navbar-nav">
                            <li class="nav-item"> <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Categories</a></li>
                            <li col-s-12>
                                <form class = "navbar-form" action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">                   
                                        <div class="input-wrapper">
                                            <div class="fa fa-search"></div>
                                            <input  type = 'text' tabIndex='0' placeholder = 'Search' name = 'search' id = 'searchbar' onkeyup="showResult(this.value)" required>                            
                                            <div class="fa fa-times"></div>
                                        </div>
                                    </div>    
                                    <div id="livesearch"></div>
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
                                            <p> <?php echo $_SESSION['UserType'] ?> </p>
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
                        <li class="nav-item"> <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Categories</a></li>
                        <li col-s-12>
                                <form class = "navbar-form" action = "/<?php echo $root ?>/src/actions/courseSearch.php" method = 'post'> 
                                    <div class="form-group">                   
                                        <div class="input-wrapper">
                                            <div class="fa fa-search"></div>
                                            <input  type = 'text' tabIndex='0' placeholder = 'Search' name = 'search' id = 'searchbar' onkeyup="showResult(this.value)" required>                            
                                            <div class="fa fa-times"></div>
                                        </div>
                                    </div>    
                                    <div id="livesearch"></div>
                                </form> 
                                </li>
                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/home.php">Featured</a> </li>
                        <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/RegisterForm.php?id=tutor">Teach on IS3</a> </li>
                        <li class="nav-item"> <a href="/<?php echo $root ?>/src/public/loginForm.php">Sign in</a> </li>
                       <li> <a href="/<?php echo $root ?>/src/public/RegisterForm.php?id=learner"><button class="button"><span>Sign Up </span></button></a> </li>
                       
                   </ul>
                  
                
               </div>
            </nav>
           <?php } ?>
	</body>
</html>

<!-- Show Categories -->
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <?php
    establishConnection();
    $getCategoriesQuery = "SELECT DISTINCT Categories FROM courses WHERE Approved = 1";
    $result = $conn->query($getCategoriesQuery);
    try{
        if (!$result)
            throw new Exception("Error Occured");
    }
    catch(Exception $e){  
        echo"Message:", $e->getMessage();  
    }

    while ($row = $result->fetch_assoc())
    {
        echo "<p><a href = /IS3-Online-Tutoring/src/view/viewApprovedCourses.php?category=".$row['Categories'].">".$row['Categories']."</a> </p>";
    }

    ?>
  </div>
</div>