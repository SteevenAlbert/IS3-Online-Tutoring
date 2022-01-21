<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
?>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../../../CSS/registerForm.css">

<!DOCTYPE html>
<html>
<head>
    <?php isAdmin(); ?>
	<title>Create administrator</title>

	<script>
    $usernameValid = false;
    $passValid=false;
    $passMatch=false;
   /*--------------Username Responsive Check-----------*/
    function UserNameCheck(str) {
        if (str.length==0) {
            document.getElementById("usernameMessage").innerHTML="";
            $usernameValid=false;
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("usernameMessage").innerHTML=this.responseText;
                if(this.responseText!="Available"){
                    $usernameValid=false;      
                }else{
                    $usernameValid=true;
                }
                toggleButton();
            }
        }
        xmlhttp.open("GET","/<?php echo $root?>/lib/ajax/checkUsername.php?un="+str,true);
        xmlhttp.send();
    }
    /*--------------Password Responsive Check-----------*/
    function passCheck() {
        var number = /([0-9])/;
        var alphabets = /([a-zA-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        if ($('#password1').val().length<1){
            $passValid=false;
            return;
        }
        if ($('#password1').val().length > 6 && $('#password1').val().match(number) && $('#password1').val().match(alphabets) && $('#password1').val().match(special_characters)) {
            ShowAlert("Password Valid", "", "success");          
            $passValid=true;
           } else {
            ShowAlert("Not Strong Enough", " Password should include alphabets, numbers and special characters.", "danger");           
            $passValid=false;
        }
        toggleButton()
        checkPassMatch()
    }

     /*--------------Password Match Check-----------*/
     function checkPassMatch(){
        if ($('#password2').val().length==0){
         
            $passMatch=false;
            return;
        }
         if($('#password1').val() == $('#password2').val()){
            ShowAlert2("Passwords Match", "", "success");
      
            $passMatch=true;
         }else{
            ShowAlert2("Passwords Don't Match", "", "danger");
   
            $passMatch=false;
         }
         toggleButton();
     }

     function toggleButton(){
         if($usernameValid==true && $passValid==true && $passMatch==true){
            document.getElementById("submit").disabled = false;
        }else{
            document.getElementById("submit").disabled = true;
        }
     }
     function ShowAlert(msg_title, msg_body, msg_type) {
      var AlertMsg = $('div[role="alert"]');
      $(AlertMsg).find('strong').html(msg_title);
      $(AlertMsg).find('p').html(msg_body);
      $(AlertMsg).removeAttr('class');
      $(AlertMsg).addClass('alert-dismissible');
      $(AlertMsg).addClass('alert alert-' + msg_type);
      $(AlertMsg).show();
  }
  function ShowAlert2(msg_title, msg_body, msg_type) {
      var AlertMsg = $('div[role="alert2"]');
      $(AlertMsg).find('strong').html(msg_title);
      $(AlertMsg).find('p').html(msg_body);
      $(AlertMsg).removeAttr('class');
      $(AlertMsg).addClass('alert-dismissible');
      $(AlertMsg).addClass('alert alert-' + msg_type);
      $(AlertMsg).show();
  }
	 </script>
</head>
<body>

<img id="adminImage" src="../../../../uploads/backgroundImages/adminImage.jpg" alt="adminImage" width="500" height="500">
<div class="container">
	<div id="centerForm">
	<h1 class="text-center" style="color:black;">Create a new administrator </h1>


	<!------------------------------------------ Administrator registration form ---------------------------------------->
	<form class="form-group text-left" method = "post" action = "/IS3-Online-Tutoring/src/model/User/Adminstrator/applyCreateAdministrator.php" onsubmit="return validatePasswords(this);">
													   

            <div class="row">
			    <div class="col-lg-6">
			    	<label style="color:black;">Name:</label>
			    	<input type="text" name='Fname' id="Fname" placeholder="First Name" class="form-control" required>
			    </div>
			    <div class="col-lg-6" style="margin-bottom:3%">
			    	<label><br></label>
			    	<input type="text" name='Lname' id="Lname" placeholder="Last Name" class="form-control">
			    </div>
   		    </div>

            <div class="row">
				<div class="col-lg-12" style="margin-bottom:3%">
					<label style="color:black;">Email:</label>
					<input type="text" name='Email' id="Email" placeholder="Smith@email.com" class="form-control" >
				</div>
   		    </div>

            <div class="row">
				<div class="col-lg-12" style="margin-bottom:3%">
					<label style="color:black;">Username:</label>
					<input type='text' name='UserName' id="UserName" placeholder="smith@123" onkeyup="UserNameCheck(this.value)" class="form-control" required>
                    <div id="usernameMessage"></div> <div id="usernameMessage"></div>
                </div>
   		    </div>

               <div class="row">
				<div class="col-lg-6">
					<label style="color:black;">Password:</label>
					<input type="Password" name='password1' id="password1" placeholder="Enter Password" onkeyup="passCheck(this.value)" class="form-control" required> 
				</div>
				<div class="col-lg-6" style="margin-bottom:3%">
					<label><br></label>
					<input type="Password" name='password2' id="password2" placeholder="Re-Enter Password" onkeyup="checkPassMatch(this.value)" class="form-control" required>
        
				</div>
   		    </div>

               <div class="alert" role="alert" style="display:none;">
                        <strong></strong> 
                        <p></p>
                </div>
                <div class="alert" role="alert2" style="display:none;">
                    <strong></strong> 
                    <p></p>
                </div>

            <div class="row">
				<div class="col-lg-6" style="margin-bottom:3%">
					<label style="color:black;">Phone Number:</label>
                    <input type="text" name='PhoneNo' id="PhoneNo" class="form-control">
				</div>
				<div class="col-lg-6">
					<label>Country:</label>
                    <select name='Country' class="form-control">
        <?php
           $countries = array("","Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        for($i=0; $i<count($countries); $i++){?>
         <option><?php echo $countries[$i]?> </option>
        <?php } ?>    
        </select>
				</div>
   		    </div>  

               <div class="row">
				<div class="col-lg-6" style="margin-bottom:3%">
					<label style="color:black;">Birth Date:</label>
					<input type="date" name='BOD' id="BOD"  min="1920-01-01" max="2021-12-31"  class="form-control">
				</div>
   		    </div> 
               
               <?php  
           
       
            ?>

            <!-- <input type="hidden" name="UserType" value="Learner"> -->
            <label style="color:black;">I Agree to Terms and Conditions</label> <input type='checkbox' name='agree' required>
            <input type='submit' id="submit" value="Register" class="btn btn-primary btn-block btn-lg" disabled>
     
	</div>
	</div>

	</form>	
	
</body>
</html>