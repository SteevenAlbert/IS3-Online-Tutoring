<html>
<head> <title>"IS3 Online Tutoring</title></head>

<body>
    <?php include_once "Menu.php"; ?>
    <form action='login.php' method='post'>
        User Name: <input type="text" name ="UserName" required><br><br>
        Password: &nbsp;&nbsp;   <input type="password"  name = "Password" required>
        <br><br>
        <input type='submit' value="Login">
    </form>
    Not a member?
    <a href="RegisterForm.php">REGISTER HERE</a>
    <br>
    Register as a tutor
    <a href="TutorRegisterForm.php">TUTOR REGISTERATION</a>
</body>
</html>