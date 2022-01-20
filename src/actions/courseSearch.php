<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

$search = $_POST['search'];
header("Location: /IS3-Online-Tutoring/src/view/viewApprovedCourses.php?search=$search" );


?>