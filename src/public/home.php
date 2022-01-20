<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@200;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/carousel.css">
<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/ratings.css">
<link rel="stylesheet" href="../../CSS/courses.css" type="text/css">
<link rel="stylesheet" href="/IS3-Online-Tutoring/CSS/home.css" type="text/css">
<?php
session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();
$GLOBALS['conn'] = $conn;

$getCoursesQuery = "SELECT * FROM courses where Approved='1'";
$result = $conn->query($getCoursesQuery);
if (!$result)
    throw new Exception($getCoursesQuery);

?>

<html>
<head>
<title>IS3 Tutoring</title>
<script>

function addToCart(courseID){
        var CourseID = courseID;
        var UserID = <?php echo $_SESSION['UserID'];?>;

        $.ajax({
            url:'/IS3-Online-Tutoring/lib/ajax/addToCart.php',
            type:'post',
            data:{UserID:UserID,CourseID:CourseID},
            success:function(response){
                var msg = response;     
                $("#message").html(response);
                if(response==="Success"){
                    ShowAlert("Congrats!", "Course Added To Cart", "success");
                }else{
                    ShowAlert("Ops!", response, "warning");
                }
            }
        });
    }

    function ShowAlert(msg_title, msg_body, msg_type) {
      var AlertMsg = $('div[role="alert"]');
      $(AlertMsg).find('strong').html(msg_title);
      $(AlertMsg).find('p').html(msg_body);
      $(AlertMsg).removeAttr('class');
      $(AlertMsg).addClass('alert-dismissible');
      $(AlertMsg).addClass('alert alert-' + msg_type);
      $(AlertMsg).show();
  }
</script>

</head>
<body>
<div class="container-fluid">
    <div class="Banner">
        <div class="BannerElements">
            <div class="BannerText">
                <?php 
               if(isset($_SESSION['UserType'])){
                    if($_SESSION['UserType']=="Learner"){   ?>
                        <h1> Welcome Back,<br> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName']?> </h1>
                        <h2> Get back to learning! </h2>
                    <?php }else if($_SESSION['UserType']=="Tutor"){?>
                        <h1> Welcome Back,<br> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName']?> </h1>
                        <h2> Let's Teach! </h2>
                    <?php }else if($_SESSION['UserType']=="Adminstrator"){?>
                        <h1> Welcome Back,<br> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName']?> </h1>
                        <h2>  </h2>
                    <?php }else if($_SESSION['UserType']=="Auditor"){?>
                        <h1> Welcome Back,<br> <?php echo $_SESSION['FirstName'] ." ". $_SESSION['LastName']?> </h1>
                        <h2>  </h2>
                    <?php }
                }else{?>
                    <h1> Experienced Tutors,<br> World-class customer service. </h1>
                    <h2> Courses taught by real-world experts from €13.99<br> — through January </h2>
                <?php } 
                ?>
            </div>
            <div class="BannerButtons">
            <?php 
            if(isset($_SESSION['UserType'])){
                if($_SESSION['UserType']=="Learner"){   ?>
                     <a href="/IS3-Online-Tutoring/src/view/viewEnrolledCourses.php"><button class="BannerButton"><span>View My Courses </span></button></a>
                     <a href="/IS3-Online-Tutoring/src/view/viewApprovedCourses.php"><button id="BB2" class="BannerButton"><span>Discover New Courses </span></button></a>                
                     <?php }else if($_SESSION['UserType']=="Tutor"){ ?>
                        <a href="/IS3-Online-Tutoring/src/view/viewTutorCourses.php"><button class="BannerButton"><span>View My Courses </span></button></a>
                    <?php }else if($_SESSION['UserType']=="Adminstrator"){ ?>
                        <a href="/IS3-Online-Tutoring/src/view/viewAdminMessagesList.php"><button class="BannerButton"><span>View Messages</span></button></a>
                        <a href="/IS3-Online-Tutoring/src/view/viewPendingCourses.php"><button class="BannerButton"><span>Approve New Courses </span></button></a>
                    <?php }
                }else{?>
                <a href="/IS3-Online-Tutoring/src/view/viewApprovedCourses.php"><button class="BannerButton"><span>View All Courses </span></button></a>
                <a href="/IS3-Online-Tutoring/src/public/RegisterForm.php?id=learner"><button id="BB2" class="BannerButton"><span>Sign Up </span></button></a>
                <?php } ?>
            </div>
        </div>
        <img src="../../resources/images/homeIllustration.jpg">
    </div>

    <div class="row services">
        <div class="col-xs-3 service">
            <div class="service-icon" id="service1">
                <img src="../../resources/images/icons/service3.png">
            </div>
            <div class="service-text">
                <h3>Private Tutoring</h3>
                <p>Find your very own tutor.</p>
            </div>
        </div>
        <div class="col-xs-3 service">
            <div class="service-icon" id="service2">
                <img src="../../resources/images/icons/service2.png">
            </div>
            <div class="service-text">
                <h3>Best Offers</h3>
                <p>Stay followed to get the best <br>deals on courses.</p>
            </div>
        </div>
        <div class="col-xs-3 service">
            <div class="service-icon"  id="service3">
                <img src="../../resources/images/icons/service3.png">
            </div>
            <div class="service-text">
                <h3>AR/VR Experience</h3>
                <p>Advanced Learning methods</p>
            </div>
        </div>
        <div class="col-xs-3 service">
            <div class="service-icon"  id="service4">
                <img src="../../resources/images/icons/service4.png">
            </div>
            <div class="service-text">
                <h3>On All Platforms</h3>
                <p>Wherever you are, whatever<br> device.</p>
            </div>
        </div>
    </div>
 
    <div class="alert" role="alert" style="display:none;">
        <strong>Warning!</strong> 
        <p>Better check yourself, you're not looking too good.</p>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left">
                <h2 class="heading-section mb-5 pb-md-4">Featured Courses</h2>
            </div>
            <div class="col-md-12">
                <div class="featured-carousel owl-carousel">
                <?php while($row = $result->fetch_array(MYSQLI_ASSOC)){
                        $thumbnail = "/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/".$row["Thumbnail"];
                    ?>
                    <div class="item">
                        <div class="blog-entry">
                            <a href="/IS3-Online-Tutoring/src/view/viewCourseDetails.php?id=<?php echo $row['CourseID']?>" class="block-20 d-flex align-items-start" style="background-image: url(<?php echo $thumbnail ?>);">
                            </div></a>
                            
                            <?php 
                            if(isset($_SESSION['UserType'])){
                                if($_SESSION['UserType']=="Learner"){?>
                                    <button onclick="addToCart(<?php echo $row['CourseID']?>)" id= "AddToCart" class="btn-primary button" ><i class="fas fa-shopping-cart icon"></i>Add To Cart</button></a>
                            <?php } 
                                }else{?>
                                    <a href=/IS3-Online-Tutoring/src/public/loginForm.php><button class="btn-primary button" ><i class="fas fa-shopping-cart icon"></i>Add To Cart</button></a>
                            <?php } ?>
                            <?php displayCourse($row); ?>    
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>





</div>    
<script src="/IS3-Online-Tutoring/js/popper.js"></script>
<script src="/IS3-Online-Tutoring/js/owl.carousel.min.js"></script>
<script src="/IS3-Online-Tutoring/js/carousel.js"></script>
</body>
</html>

<?php
function getRating($row, &$averageRating, &$reviewCount)
{
    $getReviewsQuery = "SELECT * FROM ratings WHERE CourseID=".$row["CourseID"];
    $reviews = $GLOBALS['conn']->query($getReviewsQuery);
    
    if (!$reviews)
        throw new Exception($getReviewsQuery);

    $reviewsTotal=0;
    while($review= $reviews->fetch_array(MYSQLI_ASSOC)){
        $reviewCount +=1; 
        $reviewsTotal+= $review['rating'];
    }

    if($reviewCount)
        $averageRating = round($reviewsTotal / $reviewCount, 1);
}


function displayCourse($row)
{
    $averageRating=5;
    $reviewCount=0;
    
    getRating($row, $averageRating, $reviewCount);

    $thumbnail = "/IS3-Online-Tutoring/resources/CoursesContent/Thumbnails/".$row["Thumbnail"];

    // Display course details
    ?>

        <div class="card-body">
            <h4 class="card-title">
                <a href=/IS3-Online-Tutoring/src/view/viewCourseDetails.php?id=<?php echo $row['CourseID'] ?> > <?php echo $row["Code"]." ".$row["Title"]?></a>
            </h4>
            <p class="card-text">
                <?php echo$row["Description"]?> <br>
                <small class="text-muted">
                    <?php echo$row["Level"]?>
                    <span class="dot"></span>
                    <?php echo$row["Hours"]." total hours"?><br> 
                    <i><?php echo getUsername($row["CreatedBy"])?></i><br> 
                </small>
            </p>
              
           
                <h5 class="card-text">
                    <?php 
                    for ($i = 0; $i <= 5; $i++)
                    {
                        if ($i <= $averageRating)
                            echo "<span class='fa fa-star checked'></span>";
                        else
                            echo "<span class='fa fa-star unchecked'></span>";
                    }
                    echo "<small class='text-muted'> <br><br>($reviewCount reviews)</small>";?>
                </h5>
                <h4 class="card-subtitle">
                    <?php echo"EGP".$row["Price"]?><br>
                </h4>
                </div>

    <?php
    
}

?>