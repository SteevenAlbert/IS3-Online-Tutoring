<?php include_once "Menu.php"; ?>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<html>
<head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../CSS/registerForm.css">

<script>
        $(document).ready(function(){
        $("#submit").click(function(){
            var username = $("#UserName").val().trim();
            var password = $("#Password").val().trim();

            if( username != "" && password != "" ){
                $.ajax({
                    url:'login.php',
                    type:'post',
                    data:{username:username,password:password},
                    success:function(response){
                        var msg = response;
                        $("#message").html(response);
                        if(response==="success"){
                            window.location = "home.php";
                        }
                    }
                });
            }
        });
    });
</script>

<title>"IS3 Online Tutoring</title>

</head>

<body>
<h1>LOGIN</h1>
    <!------------------------------- Get login info ------------------------------>
    <!-- User Name: <input type="text" name ="UserName" id="UserName" required><br><br>
    Password: &nbsp;&nbsp;   <input type="password"  name = "Password" id="Password" required><br>
    <div id="message"></div>
    <br><br>
    <input type='submit' value="Login" id="submit" ><br> -->
    
    <img id="loginImage" src="../../uploads/backgroundImages/loginImage.png" alt="loginImage" width="550" height="550">
    <div id="centerLoginForm">
    <div id="register">
    <div class="row">
		<form class="form-group text-left">
			<div class="col-lg-25" style="margin-bottom:3%">
				<label style="color:black;">Username</label>
				<input type="text" name ="UserName" id="UserName" placeholder="Username" class="form-control" required><i class="fas fa-user icon-color"></i>
			</div>
        </form>
   	</div>

    <div class="row">
		<form class="form-group text-left">
			<div class="col-lg-13" style="margin-bottom:15%">
				<label style="color:black;">Password</label>
				<input type="password"  name = "Password" id="Password" placeholder="Password" class="form-control" required><i class="fas fa-lock icon-color"></i> 
                <div id="message"></div>
			</div>
		</form>
   	</div>

        <input type='submit' value="Login" id="submit" class="form-control" style="margin-bottom:5%;color:white">

        <a href="RegisterForm.php?id=learner" style="margin-bottom:3%">Create an account?</a><br>
        <a href="RegisterForm.php?id=tutor">Tutor Register</a> 

        <!-- Not a member?
        /IS3-Online-Tutoring/src/model/User/Tutor/TutorRegisterForm.php
        <a href="RegisterForm.php">REGISTER HERE</a>
        <br>
        Register as a tutor
        <a href="TutorRegisterForm.php">TUTOR REGISTERATION</a> -->
</div>
</div>

    
    
</body>
</html>
