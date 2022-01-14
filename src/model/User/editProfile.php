<?php 
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Profile</title>
</head>

<body>

<?php
establishConnection();

//--------------------------------------- Update User ---------------------------------------
if(isset($_POST['submit'])){
    $UserName = $_POST['UserName'];
    $Fname = $_POST['Fname'];
    $LName = $_POST['LName'];
    $Email = $_POST['Email'];
    $PhoneNo = $_POST['PhoneNo'];
    $Country = $_POST['Country'];
    $BirthDate = $_POST['BOD'];

    $query = "UPDATE users 
            SET  UserName = '$UserName', FirstName = '$Fname',
            LastName = '$LName', Email = '$Email', PhoneNumber='$PhoneNo', 
            Country= '$Country', BirthDate = '$BirthDate'
            WHERE UserID='".$_SESSION['UserID'] ."' ";

    $result = $conn->query($query);
    try{
       if (!$result)
          throw new Exception("Error Occured");
    }
    catch(Exception $e){  
        echo"Message:", $e->getMessage();  
     }
     
        echo "Updated Successfully";
        $_SESSION['username'] = $UserName;
        $_SESSION['FirstName'] = $Fname;
        $_SESSION['LastName'] = $LName;
        $_SESSION['Email'] = $Email;
        $_SESSION['PhoneNo'] = $PhoneNo;
        $_SESSION['Country'] = $Country;
        $_SESSION['Birthdate'] = $BirthDate;

    // if ($_SESSION['UserType'] == 'Learner')

    // Update Profile Picture
    if($_FILES["pp"]["size"]!=0){
        
        // Check if it already exists and update it if it does exist
        $fileName = time() .'_'.$_FILES['pp']['name'];
        $TempImageName = $_FILES['pp']['tmp_name'];
        $target='/xampp/htdocs/IS3-Online-Tutoring/uploads/profile_pictures/'.$fileName;
        $UserID = $_SESSION['UserID'];
        $query = "SELECT * FROM learners WHERE UserID ='$UserID'";
        $result = $conn->query($query);
        try{
            if (!$result)
               throw new Exception("Error Occured");
         }
         catch(Exception $e){  
             echo"Message:", $e->getMessage();  
          }
       
  
        if(!empty($row = $result->fetch_array(MYSQLI_ASSOC))){
            $deleteTarget='/xampp/htdocs/IS3-Online-Tutoring/uploads/profile_pictures/'.$row['profile_picture'];
            $query = "UPDATE learners SET profile_picture='$fileName' WHERE UserID = '$UserID'";
            try{
                if(!$conn->query($query))
                   throw new Exception("Error Occured");
             }
             catch(Exception $e){  
                 echo"Message:", $e->getMessage();  
              }
        
            
                echo "Profile Picture Updated\n"; 
                echo "<br>";
                echo "<a href=home.php>CONTINUE</a>";
                unlink($deleteTarget);
                move_uploaded_file($TempImageName, $target);
                $_SESSION['PP'] = $fileName;
            
        }
    }
}
?>

<?php	
    // Update session
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $FirstName = $_SESSION['FirstName'];
    $LastName = $_SESSION['LastName'];
    $Email = $_SESSION['Email'];
    $PhoneNo = $_SESSION['PhoneNo'];
    $Country = $_SESSION['Country'];
    $BirthDate = $_SESSION['BirthDate'];
    if($_SESSION['UserType']=="Learner" && $_SESSION['UserType']=="Tutor"){
      $PP = $_SESSION['PP'];
      $target ="/IS3-Online-Tutoring/uploads/profile_pictures/".$_SESSION['PP'];
    }
?>	

<form method ="POST" action = "" enctype="multipart/form-data" >
    
    <!--------------------------------------- Display Profile Picture --------------------------------------->
    <?php if($_SESSION['UserType']=="Learner" && $_SESSION['UserType']=="Tutor"){?>
    <h3> Change Profile Picture </h3>
    <img  style="width:auto; height:200px" src=<?php echo $target ?>>

    <input type = 'file' name='pp' id='pp'><br><br>
    <?php } ?>

    <!--------------------------------------- Display personal info --------------------------------------->
    <h3> Edit Personal Info </h3>
    User Name: 
    <input type='text' name='UserName' id="UserName" value=<?php echo $username?> >   

    First Name: 
    <input type="text" name='Fname' id="Fname" placeholder="Bob" value = <?php echo $FirstName ?> required>

    &nbsp; &nbsp; &nbsp;  &nbsp;&nbsp; Last Name: 
    <input type="text" name='LName' id="Lname" placeholder="Smith" value = <?php echo $LastName ?>>        <br><br>

    Email:   &nbsp; &nbsp; &nbsp; &nbsp; 
    <input type="text" name='Email' id="Email" placeholder="Smith@email.com" value = <?php echo $Email ?>>  

    &nbsp;
    Phone Number: 
    <input type="text" name='PhoneNo' id="PhoneNo" value = <?php echo $PhoneNo ?>>    <br><br>

    Birth Date:   
    <input type="date" name='BOD' id="BOD"  min="1920-01-01" max="2021-12-31" value = <?php echo $BirthDate ?> >    <br><br>

    <!-- ADDING COUNTRIES USING A LOOP OVER AN ARRAY -->
    Country:    &nbsp;   &nbsp;
    <select name='Country'>
    <option value=<?php echo $Country ?> selected><?php echo $Country ?></option>  
    <?php
    $countries = array("","Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    for($i=0; $i<count($countries); $i++){?>
        <option><?php echo $countries[$i]?> </option>
    <?php } 
    ?> 
    </select>   

    <br><br>
    I Agree to Terms and Conditions <input type='checkbox' name='agree' required>
    <br><br>

    <input type="submit" name ="submit" value = "Update">
</form>



<br>
<a href="/IS3-Online-Tutoring/src/actions/requestReset.php"> Change Password </a>
</body>
</html>

