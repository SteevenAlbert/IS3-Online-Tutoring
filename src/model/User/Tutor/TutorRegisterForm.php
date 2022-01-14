<html>
<head>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../../../CSS/registerForm.css">

    <title>Registeration</title>
</head>
<body >
    <?php include_once "../../../public/Menu.php"; ?>

    <script type="text/javascript" language="JavaScript">
function checkMatchingPassword(Form) {
    if (Form.Password.value != Form.Password2.value)
    {
        alert('Those Passwords don\'t match!');
        return false;
    } else {
        return true;
    }
}
</script> 
<img id="tutorsImage" src="../../../../uploads/backgroundImages/tutorsImage.png" alt="tutorsImage" width="800" height="800">
<div id="centerForm">
    <div class="container">
    <div class="row ">
        <div class="col-1g-3 "></div>
        <div class="col-lg-6 ">
            <div id="register">
            <h1 class="text-center" style="color:black;">TUTOR REGISTER</h1>



<!------------------------------ User info form ------------------------------>
<form class="form-group text-left" method ="post" action = "/<?php echo $root ?>/src/model/User/Register.php" onsubmit="return checkMatchingPassword(this);">
    <div class="row">
        <div class="col-lg-6">
        <label style="color:black;">Name: </label>
        <input type="text" name='Fname' id="Fname" placeholder="First Name" class="form-control" required><i class="fas fa-user icon-color"></i> <br><br>
        </div>

        <!-- Last Name -->
        <div class="col-lg-6">
        <label></label>
        <input type="text" name='LName' id="Lname" placeholder="Last Name" class="form-control fa fa-envelope icon">
        </div>

        
        <div class="col-lg-12">
        <label style="color:black;"> Email:</label> 
        <input type="text" name='Email' id="Email" placeholder="Smith@email.com" class="form-control" required><i class="fas fa-envelope emailIcon-color"></i>  <br><br>
        </div>

        <div class="col-lg-12">
        <label style="color:black;"> Username: </label>
        <input type='text' name='UserName' id="UserName" placeholder="Smith@123" class="form-control" required><i class="fas fa-user emailIcon-color"></i>  
        </div></div><br>

        <!-- PASSWORD WITH VALIDATION -->
        <div class="row">
        <div class="col-lg-6">
        <label style="color:black;">Password: </label>
        <input type="Password" name='Password' id="Password" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control"
               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><i class="fas fa-lock icon-color"></i> <br><br>
        </div>
        <br>
        <!-- Re-Enter Password -->
        <div class="col-lg-6">
        <label></label>
        <input type="Password" name='Password2' id="Password2" placeholder="Re-Enter Password" class="form-control" required><br><br>
        </div>

        <div class="col-lg-6">
        <label style="color:black;"> Phone Number:</label>  
        <input type="text" name='PhoneNo' id="PhoneNo" class="form-control"><i class="fas fa-mobile-alt icon-color"></i><br><br>
        </div>

        <div class="col-lg-6">
        <label style="color:black;"> Birth Date:</label>   
        <input type="date" name='BOD' id="BOD"  min="1920-01-01" max="2021-12-31" class="form-control">    <br><br>
        </div>

        <!-- ADDING COUNTRIES USING A LOOP OVER AN ARRAY -->
        <div class="col-lg-6">
        <label style="color:black;"> Country: &nbsp;&nbsp;</label>   
        <select name='Country' class="form-control">
        <?php
           $countries = array("","Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        for($i=0; $i<count($countries); $i++){?>
         <option><?php echo $countries[$i]?> </option>
        <?php } ?>    
        </select>
        </div> </div>
       
        <input type="hidden" name="UserType" value="Tutor">

        <br>
        <label style="color:black;">I Agree to Terms and Conditions</label> <input type='checkbox' name='agree'  required>
        <br>

        <input type='submit' id="submit" value="Register" class="btn btn-primary btn-block btn-lg">
        </div>
        </div>
        </div>
    </form>

  

</body>
</html>