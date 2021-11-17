<?php

if(isset($_POST['submit'])){


    echo "<pre>", print_r($_FILES['profileImage']), "</pre>";   
echo "<pre>", print_r($_FILES['profileImage']['name']), "</pre>"; 
$profileImageName = time() .'_'.$_FILES['profileImage']['name'];
$TempImageName = $_FILES['profileImage']['tmp_name'];



$target='images/'. $profileImageName;
$result = move_uploaded_file($TempImageName, $target);
if($result){
    echo "Image Uploaded Successfully";
}else{
    echo "Image Upload Failed";

}


}


?>
 