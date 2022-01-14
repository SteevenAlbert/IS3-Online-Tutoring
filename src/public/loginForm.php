<html>
<head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
    <?php include_once "Menu.php"; ?>
    
    <!------------------------------- Get login info ------------------------------>
    User Name: <input type="text" name ="UserName" id="UserName" required><br><br>
    Password: &nbsp;&nbsp;   <input type="password"  name = "Password" id="Password" required><br>
    <div id="message"></div>
    <br><br>
    <input type='submit' value="Login" id="submit" ><br>
    
    
    Not a member?
    <a href="RegisterForm.php?learner">REGISTER HERE</a>
    
    <br>
    Register as a tutor
    <a href="RegisterForm.php?tutor">TUTOR REGISTERATION</a>

</body>
</html>
