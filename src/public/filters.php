<?php
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";


    function filterEmail(&$email){
        $oldEmail = $email;
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        
        if(!filter_var($email , FILTER_VALIDATE_EMAIL) === false && $email===$oldEmail)
        {
            return true;
        }
        else{
            return false;
        }
    }

    function filterLink(&$url){
        $oldUrl = $url;
        $url = filter_var($url,FILTER_SANITIZE_URL);

        if(!filter_var($url , FILTER_VALIDATE_URL ,(FILTER_FLAG_PATH_REQUIRED || FILTER_FLAG_QUERY_REQUIRED))=== false && $url===$oldUrl)
        {
            return true;
        }
        else{
            return false;
        }
    }

    function filterString(&$str){
        $oldStr = $str;
        $str = filter_var($str,FILTER_SANITIZE_STRING);
        
        if($oldStr===$str)
        {
            return true;
        }
        else{
            return false;
        }

    }

    
?>