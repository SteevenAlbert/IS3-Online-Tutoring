<?php
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";


    function filterEmail($email){
        
        $sanitizeEmail = filter_var($email,FILTER_SANITIZE_EMAIL);

        if(!filter_var($sanitizeEmail , FILTER_VALIDATE_EMAIL )=== false && $email==$sanitizeEmail)
        {
            echo "Valid Email"."<br>";
            return true;
        }
        else{
            echo "Please Enter a valid Email"."<br>";
            return false;
        }
    }

    function filterLink($url){
        $sanitizeURL = filter_var($url,FILTER_SANITIZE_URL);

        if(!filter_var($url , FILTER_VALIDATE_URL ,(FILTER_FLAG_PATH_REQUIRED || FILTER_FLAG_QUERY_REQUIRED))=== false)
        {
        echo "Valid URL <br>";
        return true;
        }
        else{
            echo "Please enter a valid URL <br>";
            return false;
        }
    }

    
?>