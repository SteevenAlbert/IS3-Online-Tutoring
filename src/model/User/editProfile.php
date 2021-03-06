<?php 
session_start();
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/filters.php";
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Profile</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../../CSS/editProfile.css">

<script>
    /*------------- Check Username validity --------------------*/
    function UserNameCheck(str) {    
        if (str.length==0) {
            document.getElementById("usernameMessage").innerHTML="";
            return;
        }
        var currentUsername = "<?php echo $_SESSION['username'];?>";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("usernameMessage").innerHTML=this.responseText;
                if(this.responseText!="Available"){
                    if(str!=currentUsername)  {
                      document.getElementById("submit").disabled = true;        
                    }else{
                        document.getElementById("usernameMessage").innerHTML="";
                    }       
                }else{
                    document.getElementById("submit").disabled = false;
                }
            }
        }
        xmlhttp.open("GET","/<?php echo $root?>/lib/ajax/checkUsername.php?un="+str,true);
        xmlhttp.send();
    }
    /*------------- Image Upload --------------------*/
    function triggerClick() {
        document.querySelector('#profileImage').click();
    }
    function editImage(e) {
        if (e.files[0]) {
          var reader = new FileReader();
            reader.onload = function(e) {
              document.querySelector('#editProfileDisplay').setAttribute('src', e.target.result);
              }
          reader.readAsDataURL (e.files[0]);
        }
     }
</script>

</head>

<body>

<?php
establishConnection();

if(empty($_SESSION['UserID']))
{
    exit();
}

//--------------------------------------- Update User ---------------------------------------
if(isset($_POST['submit'])){
    $UserName = $_POST['UserName'];
    $Fname = $_POST['Fname'];
    $LName = $_POST['LName'];
    $Email = $_POST['Email'];
    $PhoneNo = $_POST['PhoneNo'];
    $Country = $_POST['Country'];
    $BirthDate = $_POST['BOD'];

    filterString($UserName); 
    filterEmail($Email);
    filterString($Fname); 
    filterString($LName);
    filterString($PhoneNo);
    filterString($Country);
    filterString($Birthdate);

    $query = "UPDATE users 
            SET  UserName = '$UserName', FirstName = '$Fname',
            LastName = '$LName', Email = '$Email', PhoneNumber='$PhoneNo', 
            Country= '$Country', BirthDate = '$BirthDate'
            WHERE UserID='".$_SESSION['UserID'] ."' ";

    $result = $conn->query($query);
    if (!$result)
        throw new Exception($query);
    
     
        ?> <?php
        ?></div><?php
        $_SESSION['username'] = $UserName;
        $_SESSION['FirstName'] = $Fname;
        $_SESSION['LastName'] = $LName;
        $_SESSION['Email'] = $Email;
        $_SESSION['PhoneNo'] = $PhoneNo;
        $_SESSION['Country'] = $Country;
        $_SESSION['Birthdate'] = $BirthDate;

    if($_SESSION['UserType']=="Learner" || $_SESSION['UserType']=="Tutor"){
        // Update Profile Picture
        if($_FILES["pp"]["size"]!=0){
            // Check if it already exists and update it if it does exist
            $fileName = time() .'_'.$_FILES['pp']['name'];
            $TempImageName = $_FILES['pp']['tmp_name'];
            $target='/xampp/htdocs/IS3-Online-Tutoring/uploads/profile_pictures/'.$fileName;
            $UserID = $_SESSION['UserID'];
            
            $query = "SELECT * FROM learners WHERE UserID ='$UserID'";
            $result = $conn->query($query);
            if (!$result)
                throw new Exception($query);

            if(!empty($row = $result->fetch_array(MYSQLI_ASSOC))){


                $fileType=strtolower(pathinfo($target,PATHINFO_EXTENSION));
                    $accept=false;
                if($fileType=="jpg" || $fileType=="jpeg" || $fileType=="png"){
                    
                    $result = move_uploaded_file($TempImageName, $target);
                    $accept=true;
                    $deleteTarget='/xampp/htdocs/IS3-Online-Tutoring/uploads/profile_pictures/'.$row['profile_picture'];
                    $query = "UPDATE learners SET profile_picture='$fileName' WHERE UserID = '$UserID'";
                    try{
                        if(!$conn->query($query))
                        throw new Exception("Error Occured");
                    }
                    catch(Exception $e){  
                        echo"Message:", $e->getMessage();  
                    }
        
                        // echo "Profile Picture Updated\n";
                        ?> <div class="alert alert-success" role="alert"> Updated Successfully</div> <?php
                        ?></div><?php
                        echo "<br>";
                        ?><?php
                        if($_SESSION['PP']!="default.png"){
                        unlink($deleteTarget);
                        }
                        move_uploaded_file($TempImageName, $target);
                        $_SESSION['PP'] = $fileName;
                }
                else
                {
                    trigger_error("user tried to upload wrong file format", E_USER_WARNING);
                    ?> <div class="alert alert-danger" role="alert"> update failed</div> <?php
                    ?></div><?php    
                    $accept=false;
                }
            }
        }
    }
}
?>

<?php	
    // Get Current User Data
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $FirstName = $_SESSION['FirstName'];
    $LastName = $_SESSION['LastName'];
    $Email = $_SESSION['Email'];
    $PhoneNo = $_SESSION['PhoneNo'];
    $Country = $_SESSION['Country'];
    $BirthDate = $_SESSION['BirthDate'];
    if($_SESSION['UserType']=="Learner" || $_SESSION['UserType']=="Tutor"){
      $PP = $_SESSION['PP'];
      $target ="/IS3-Online-Tutoring/uploads/profile_pictures/".$_SESSION['PP'];
    }
?>	
<img id="editProfileImage" src="../../../uploads/backgroundImages/editProfileImage.jpg" alt="editProfileImage">
<form class="form-group" method ="POST" action = "" enctype="multipart/form-data" >
    <div id=centerEditForm>
    <!--------------------------------------- Display Profile Picture --------------------------------------->
    <?php if($_SESSION['UserType']=="Learner" || $_SESSION['UserType']=="Tutor"){?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="circular-landscape center-block">
              <img src="<?php echo $target ?>" onclick="triggerClick()" id="editProfileDisplay" width="150" height="150">
            </div>
              <label for="pp" style="color:black;" >Profile Image</image></label>
            <input type="file" name="pp" onchange="editImage(this)" id="pp" style="display:none;" accept=".jpg,.jpeg,.png">
        </div>
    </div>

    <?php } ?>

    <!--------------------------------------- Display personal info --------------------------------------->
    <h3> Edit Personal Info </h3>
        <div class="row">
			<div class="col-lg-6">
                <label style="color:black;">First Name:</label>
                <input type="text" name='Fname' id="Fname" placeholder="Bob" class="form-control" value = <?php echo $FirstName ?> required>
            </div>
            <div class="col-lg-6" style="margin-bottom:2%">
                <label style="color:black;">Last Name:</label>
                <input type="text" name='LName' id="Lname" placeholder="Smith" class="form-control" value = <?php echo $LastName ?>>
            </div>
        </div>

        <div class="row">
			<div class="col-lg-6">
                <label style="color:black;">Username:</label>
                <input type='text' name='UserName' id="UserName" class="form-control" value=<?php echo $username?> onkeyup="UserNameCheck(this.value)" > 
            </div>
        
            <div class="col-lg-6" style="margin-bottom:2%">
                <label style="color:black;">Email:</label>
                <input type="text" name='Email' id="Email" placeholder="Smith@email.com" class="form-control" value = <?php echo $Email ?>>  
            </div>
        </div>    <div id="usernameMessage"></div> <div id="usernameMessage"></div>

        <div class="row">
			<div class="col-lg-6">
                <label style="color:black;">Phone Number:</label>
                <input type="text" name='PhoneNo' id="PhoneNo" class="form-control" pattern="[0-5]{3}[0-9]{8}" value = <?php echo $PhoneNo ?>> 
            </div>
            <div class="col-lg-6" style="margin-bottom:2%">
                <label style="color:black;">Birth Date:</label>
                <input type="date" name='BOD' id="BOD"  min="1920-01-01" max="2021-12-31" class="form-control" value = <?php echo $BirthDate ?> >  
            </div>
        </div>

        <!-- ADDING COUNTRIES USING A LOOP OVER AN ARRAY -->
        <div class="row">
			<div class="col-lg-6" style="margin-bottom:2%">
                <label style="color:black;">Country:</label>
                <select name='Country' class="form-control">
                <option value=<?php echo $Country ?> selected><?php echo $Country ?></option>  
                    <?php
                    $countries = array("","Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                    for($i=0; $i<count($countries); $i++){?>
                    <option><?php echo $countries[$i]?> </option>
                    <?php } 
                    ?> 
                </select>  
            </div>
        </div>

    I Agree to Terms and Conditions <input type='checkbox' name='agree' required>
    <br><br>

    <input type="submit" name ="submit" id="submit" value = "Update" class="btn btn-primary">
    <a href="/IS3-Online-Tutoring/src/actions/requestReset.php"> Change Password </a>
</div>
</form>

</body>
</html>

