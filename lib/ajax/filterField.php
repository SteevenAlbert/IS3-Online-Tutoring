<?php
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
establishConnection();

if (isset($_GET['email']))
{
    if(filterEmail($_GET['email'])){
        echo "Valid";
    }else{
        echo "Not valid";
    }
}

if (isset($_GET['string']))
{
    if(filterString($_GET['string'])){
        echo "Valid";
    }else{
        echo "Not valid";
    }
}


?>