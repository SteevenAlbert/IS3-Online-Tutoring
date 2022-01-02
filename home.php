<?php
session_start();
include_once "Menu.php";
if(isset($_SESSION['FirstName']))
    echo "Welcome Back, ".$_SESSION['FirstName']."!";
else
echo "<h2> Welcome </h2>";
echo "<h3> Featured courses </h3>";

?>
