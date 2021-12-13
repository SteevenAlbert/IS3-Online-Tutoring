<html>
<head>
    <title>Registeration</title>
</head>
<body>
    <?php 
    include_once "Menu.php"; 
    include_once "is3library.php"; 
    ?>
    <h1>REGISTER</h1>


    <form method ="post" action = "Register.php" enctype="multipart/form-data" onsubmit="return validatePasswords(this);">


        <label for="profileImage">Profile Image</image> <br>
        <input type="file" name="profileImage" id="profileImage"> <br> <br>

        User Name: 
        <input type='text' name='UserName' id="UserName" required>   
    

        <!-- PASSWORD WITH VALIDATION -->

        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; Password: 
        <input type="Password" name='Password' id="password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>    <br><br>
    
        <!-- LOOP TO ADD WHITESPACE -->
       <?php for($i=0; $i<29;$i++){
           //White Space
            ?>&nbsp; <?php
        }?>

       Re-Enter Password: 
        <input type="Password" name='password2' id="password2" required>    <br><br><br><br>
        
        First Name: 
        <input type="text" name='Fname' id="Fname" placeholder="Bob" required>
      
        &nbsp; &nbsp; &nbsp;  &nbsp;&nbsp; Last Name: 
        <input type="text" name='LName' id="Lname" placeholder="Smith">        <br><br>
      
        Email:   &nbsp; &nbsp; &nbsp; &nbsp; 
        <input type="text" name='Email' id="Email" placeholder="Smith@email.com" >  

        &nbsp;
        Phone Number: 
        <input type="text" name='PhoneNo' id="PhoneNo" >    <br><br>
        
        Birth Date:   
        <input type="date" name='BOD' id="BOD"  min="1920-01-01" max="2021-12-31"  >    <br><br>

        <!-- ADDING COUNTRIES USING A LOOP OVER AN ARRAY -->
        Country:    &nbsp;   &nbsp;
        <select name='Country'>
        <?php
           $countries = array("","Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        for($i=0; $i<count($countries); $i++){?>
         <option><?php echo $countries[$i]?> </option>
        <?php } ?>    
        </select>   

        <input type="hidden" name="UserType" value="Learner">

        <br><br>
        I Agree to Terms and Conditions <input type='checkbox' name='agree' required>
        <br><br>

        <input type='submit' value="Register">
        
    </form>

  

</body>
</html>